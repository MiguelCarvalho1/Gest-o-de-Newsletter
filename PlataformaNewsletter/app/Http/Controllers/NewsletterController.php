<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\News;
use App\Models\Assinante;

use \Google\Client;
use \Google\Service\Gmail;
use Google\Auth\OAuth2;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::all();
        return view('newsletters.index', ['newsletters' => $newsletters]);
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
    
        $newsletter->news()->detach();

        // Vincular as novas notícias selecionadas à newsletter
        $newsletter->news()->attach($newsIds);
    
        // Execute outras ações necessárias, como enviar a newsletter por e-mail
    
        return redirect('/newsletters')->with('success', 'A newsletter foi criada com sucesso!');
    }
    

    public function show($id)
    {
        $newsletter = Newsletter::findOrFail($id);

        return view('newsletters.show_newsletter', compact('newsletter'));
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
        $newsletter->conteudo = "Olá [NOME_ASSINANTE], $conteudo";
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

    public function enviarEmail($id)
    {
        $user = Auth::user(); // Ou qualquer lógica para obter o usuário atual

        $client = new Client();
        $client->setAuthConfig(config('services.gmail.client_secret'));
        $client->setScopes(['https://www.googleapis.com/auth/gmail.send']);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Se o usuário não tem um token de acesso, redirecione para a página de autorização do Google
        if (!$user->gmail_access_token) {
            $authUrl = $client->createAuthUrl();
            return redirect($authUrl);
        }

        // Se você já tem o token de acesso, configure-o para o provedor do OAuth2
        $accessToken = $user->gmail_access_token;
        $client->setAccessToken($accessToken);

        // Verificar se o token expirou
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($user->gmail_refresh_token);

            // Atualizar o token de acesso no banco de dados
            $newAccessToken = $client->getAccessToken();
            $user->gmail_access_token = $newAccessToken['access_token'];
            $user->save();
        }

        // Criar um cliente do serviço Gmail
        $gmailService = new Gmail($client);

        // Obter os detalhes do remetente e do destinatário
        $remetente = $user->email;
        $destinatario = $user->email;

        // Obter a newsletter a ser enviada
        $newsletter = Newsletter::findOrFail($id);

        // Preparar o conteúdo do email
        $subject = $newsletter->titulo;
        $body = $newsletter->conteudo;

        // Configurar o corpo da solicitação para enviar o email
        $requestBody = new \Google_Service_Gmail_Message();
        $requestBody->setRaw($this->base64UrlEncode($this->createEmail($remetente, $destinatario, $subject, $body)));
        
        // Enviar o email usando a API do Gmail
        $gmailService->users_messages->send('me', $requestBody);

        return redirect('/newsletters')->with('success', 'O email foi enviado com sucesso!');
    }

    // Função auxiliar para criar um objeto \Google_Service_Gmail_Message com os dados do email
    private function createEmail($remetente, $destinatario, $subject, $body)
    {
        $email = new \Google_Service_Gmail_Message();
        $email->setFrom($remetente);
        $email->setTo($destinatario);
        $email->setSubject($subject);
        $email->setTextBody($body);

        return $email;
    }

    // Função auxiliar para codificar o email no formato base64 URL-safe
    private function base64UrlEncode($data)
    {
        $data = str_replace(array('+', '/'), array('-', '_'), base64_encode($data));
        $data = rtrim($data, '=');

        return $data;
    }
}
