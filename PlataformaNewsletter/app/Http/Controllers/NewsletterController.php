<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;
use App\Models\News;

use League\OAuth2\Client\Provider\Google;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class NewsletterController extends Controller
{


    
        public function index()
        {
            $newsletters = Newsletter::all();
            
            
            return view('/newsletters/index', ['newsletters' => $newsletters]);
            
        }
      
        public function create(Request $request)
        {
            $newsIds = explode(',', $request->input('selectedNews'));
            $titulo = $request->input('titulo');
            $conteudo = $request->input('conteudo');
            $dataEnvio = $request->input('data_envio');
        
            // Obter os dados das notícias correspondentes
            $news = News::whereIn('id', $newsIds)->get();
        
            // Crie a newsletter com base nos IDs das notícias selecionadas, título e conteúdo
            $newsletter = new Newsletter();
            $newsletter->titulo = $titulo;
        
            // Substitua '[NOME_ASSINANTE]' pelo nome e concelho do assinante
            $assinante = DB::table('assinantes')
                ->join('codiPostal', 'assinantes.id_codiPostal', '=', 'codiPostal.id')
                ->inRandomOrder()
                ->select('assinantes.nome', 'codiPostal.concelho')
                ->first();
        
            if ($assinante) {
                $nomeAssinante = $assinante->nome;
                $concelhoAssinante = $assinante->concelho;
        
                // Substitua '[NOME_ASSINANTE]' pelo nome do assinante
                $conteudoComNome = preg_replace('/\[NOME\]/', $nomeAssinante, $conteudo);
        
                // Substitua '[CONCELHO_ASSINANTE]' pelo concelho do assinante
                $conteudoComConcelho = preg_replace('/\[CONCELHO\]/', $concelhoAssinante, $conteudoComNome);
        
                $newsletter->conteudo = $conteudoComConcelho;
            } else {
                $newsletter->conteudo = $conteudo;
            }
        
            $newsletter->data_envio = $dataEnvio;
        
            $newsletter->save();
        
            // Vincule as notícias selecionadas à newsletter
            $newsletter->news()->attach($newsIds);
        
            // Execute outras ações necessárias, como enviar a newsletter por e-mail
        
            return redirect('/newsletters')->with('success', 'A newsletter foi criada com sucesso!');
        }

 public function enviarEmail()
    {
        $user = Auth::user(); // Ou qualquer lógica para obter o usuário atual

        $provider = new Google([
            'clientId' => config('services.gmail.client_id'),
            'clientSecret' => config('services.gmail.client_secret'),
            'redirectUri' => config('services.gmail.redirect_uri'),
        ]);

        // Se o usuário não tem um token de acesso, redirecione para a página de autorização do Google
        if (!$user->gmail_access_token) {
            $authUrl = $provider->getAuthorizationUrl();
            return redirect($authUrl);
        }

        // Se você já tem o token de acesso, configure-o para o provedor do OAuth2
        $accessToken = $user->gmail_access_token;
        $provider->setAccessToken($accessToken);

        // Se o token expirou, atualize-o usando o refreshToken
        if ($provider->isAccessTokenExpired()) {
            $newAccessToken = $provider->getAccessToken('refresh_token', [
                'refresh_token' => $user->gmail_refresh_token,
            ]);

            // Atualize o token de acesso no modelo do usuário ou onde quer que você o esteja armazenando
            $user->gmail_access_token = $newAccessToken->getToken();
            $user->save();
        }

        // Configure o transporte do SwiftMailer com as credenciais do Gmail
        $transport = new \Swift_SmtpTransport('smtp.gmail.com', 587, 'tls');
        $transport->setUsername($user->email);
        $transport->setPassword('SUA_SENHA_ESPECIFICA_DE_APLICATIVO');
        $transport->setAuthMode('LOGIN');

        // Crie o objeto Mailer com o transporte configurado
        $mailer = new \Swift_Mailer($transport);

        // Configure o remetente do e-mail
        $from = ['address' => config('mail.from.address'), 'name' => config('mail.from.name')];

        // Configure o destinatário, assunto e conteúdo do e-mail
        $to = ['address' => 'exemplo@example.com', 'name' => 'Destinatário'];
        $subject = 'Assunto do e-mail';
        $content = 'Conteúdo do e-mail';

        // Crie a mensagem de e-mail
        $message = (new \Swift_Message($subject))
            ->setFrom($from)
            ->setTo($to)
            ->setBody($content);

        // Envie o e-mail usando o objeto Mailer
        $result = $mailer->send($message);

        if ($result) {
            // E-mail enviado com sucesso
        } else {
            // Erro ao enviar o e-mail
        }
    }

// enviar email 
public function enviarEmailNewsletter()
{
    $user = Auth::user(); // Ou qualquer lógica para obter o usuário atual

    $provider = new Google([
        'clientId' => config('services.gmail.client_id'),
        'clientSecret' => config('services.gmail.client_secret'),
        'redirectUri' => config('services.gmail.redirect_uri'),
    ]);

    // Se o usuário não tem um token de acesso, redirecione para a página de autorização do Google
    if (!$user->gmail_access_token) {
        $authUrl = $provider->getAuthorizationUrl();
        return redirect($authUrl);
    }

    // Se você já tem o token de acesso, configure-o para o provedor do OAuth2
    $accessToken = $user->gmail_access_token;
    $provider->setAccessToken($accessToken);

    // Se o token expirou, atualize-o usando o refreshToken
    if ($provider->isAccessTokenExpired()) {
        $newAccessToken = $provider->getAccessToken('refresh_token', [
            'refresh_token' => $user->gmail_refresh_token,
        ]);

        // Atualize o token de acesso no modelo do usuário ou onde quer que você o esteja armazenando
        $user->gmail_access_token = $newAccessToken->getToken();
        $user->save();
    }

    // Configure o transporte do SwiftMailer com as credenciais do Gmail
    $transport = new \Swift_SmtpTransport('smtp.gmail.com', 587, 'tls');
    $transport->setUsername($user->email);
    $transport->setPassword($accessToken);
    $transport->setAuthMode('LOGIN');

    // Crie o objeto Mailer com o transporte configurado
    $mailer = new \Swift_Mailer($transport);

    // Configure o remetente do e-mail
    $from = ['address' => config('mail.from.address'), 'name' => config('mail.from.name')];

    // Obtenha todas as newsletters
    $newsletters = Newsletter::all();

    foreach ($newsletters as $newsletter) {
        $conteudo = $newsletter->conteudo;

        // Obtenha todos os assinantes
        $assinantes = Assinante::all();

        foreach ($assinantes as $assinante) {
            // Lógica para enviar a newsletter para cada assinante
            // Exemplo: Enviar um e-mail para o assinante com o conteúdo da newsletter
            // Você pode usar pacotes como o Laravel Mail para enviar e-mails

            // Exemplo básico de envio de e-mail
            \Mail::raw($conteudo, function ($message) use ($assinante) {
                $message->to($assinante->email)
                    ->subject('Nova newsletter');
            });
        }

public function show($id)
    {
        $newsletter = Newsletter::findOrFail($id);

        return view('/newsletters/show_newsletter', compact('newsletter'));
    }

    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $noticia = News::all();
        return view('newsletters.edit_newsletter', compact('newsletter', 'noticia'));
    }

    public function update(Request $request, $id)
{
    // Obter a newsletter com o ID fornecido
    $newsletter = Newsletter::findOrFail($id);

    // Obter os dados do formulário de edição
    $titulo = $request->input('titulo');
    $conteudo = $request->input('conteudo');
    $dataEnvio = $request->input('data_envio');
    $selectedNews = $request->input('selectedNews');
    $newsIds = is_array($selectedNews) ? implode(',', $selectedNews) : $selectedNews;
    $newsIds = explode(',', $newsIds);

    // Atualizar os campos da newsletter
    $newsletter->titulo = $titulo;
    // Substitua '[NOME_ASSINANTE]' pelo nome e concelho do assinante
    $newsletter->conteudo = preg_replace_callback('/\[NOME_ASSINANTE\]/', function ($matches) {
        // Obtenha o nome e o concelho do assinante a partir das tabelas 'assinantes' e 'codiPostal'
        $assinante = DB::table('assinantes')
            ->join('codiPostal', 'assinantes.id_codiPostal', '=', 'codiPostal.id')
            ->inRandomOrder()
            ->select('assinantes.nome', 'codiPostal.concelho')
            ->first();

        if ($assinante) {
            return $assinante->nome . ' - ' . $assinante->concelho;
        } else {
            return '';
        }
    }, $conteudo);

    $newsletter->data_envio = $dataEnvio;

    $newsletter->save();

    // Remover as notícias vinculadas existentes
    $newsletter->news()->detach();

    // Vincular as novas notícias selecionadas à newsletter
    $newsletter->news()->attach($newsIds);

    return redirect('/newsletters')->with('success', 'A newsletter foi atualizada com sucesso!');
}
public function destroy($id)
{
    // Find the newsletter with the given ID
    $newsletter = Newsletter::findOrFail($id);

    // Detach the related news
    $newsletter->news()->detach();

    // Delete the newsletter
    $newsletter->delete();

    return redirect('/newsletters')->with('success', 'A newsletter foi excluída com sucesso!');
}

public function enviarNewsletters()
    {
        // Obtenha todas as newsletters a serem enviadas
        $newsletters = Newsletter::all();

        // Para cada newsletter
        foreach ($newsletters as $newsletter) {
            // Obtenha os assinantes dessa newsletter
            $assinantes = $newsletter->assinantes;

            // Para cada assinante
            foreach ($assinantes as $assinante) {
                $nomeAssinante = $assinante->nome;

                // Obtenha o conteúdo da newsletter
                $conteudoNewsletter = $newsletter->conteudo;

                // Faça a substituição da variável com o nome do assinante
                $conteudoPersonalizado = str_replace('[NOME_ASSINANTE]', $nomeAssinante, $conteudoNewsletter);

                // Envie a newsletter para o assinante com o conteúdo personalizado
                // ...
            }
        }
    }

    }

    // E-mail enviado com sucesso para todos os assinantes
}
}


    
?>