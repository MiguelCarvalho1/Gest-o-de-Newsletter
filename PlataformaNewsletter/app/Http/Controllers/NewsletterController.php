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
    $newsletter->conteudo = "Olá [NOME_ASSINANTE], $conteudo";
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
    }

    // E-mail enviado com sucesso para todos os assinantes
}
}

?>