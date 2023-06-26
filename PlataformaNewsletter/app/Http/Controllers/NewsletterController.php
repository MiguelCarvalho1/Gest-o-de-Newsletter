<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\News;
use App\Models\Assinante;

use League\OAuth2\Client\Provider\Google;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

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
 // Se o token expirou, atualize-o usando o token de atualização
 if ($provider->isAccessTokenExpired()) {
    $newAccessToken = $provider->getAccessToken('refresh_token', [
        'refresh_token' => $user->gmail_refresh_token,
    ]);

    // Atualize o token de acesso no banco de dados
    $user->gmail_access_token = $newAccessToken->getToken();
    $user->save();
}

// Crie um cliente HTTP para enviar o email
$client = new Client();

// Obtenha os detalhes do remetente e do destinatário
$remetente = $user->email;
$destinatario = $user->email;

// Obtenha a newsletter a ser enviada
$newsletter = Newsletter::findOrFail($id);

// Prepare o conteúdo do email
$subject = $newsletter->titulo;
$body = $newsletter->conteudo;

// Configurar o corpo da solicitação para enviar o email
$requestBody = [
    'personalizations' => [
        [
            'to' => [
                ['email' => $destinatario],
            ],
        ],
    ],
    'from' => ['email' => $remetente],
    'subject' => $subject,
    'content' => [
        [
            'type' => 'text/html',
            'value' => $body,
        ],
    ],
];

// Enviar o email usando a API do Gmail
$response = $client->post('https://www.googleapis.com/gmail/v1/users/me/messages/send', [
    'headers' => [
        'Authorization' => 'Bearer ' . $provider->getAccessToken(),
        'Content-Type' => 'application/json',
    ],
    'body' => json_encode($requestBody),
]);

// Verificar o status da resposta
if ($response->getStatusCode() === 200) {
    // O email foi enviado com sucesso
    return redirect('/newsletters')->with('success', 'O email foi enviado com sucesso!');
} else {
    // O envio do email falhou
    return redirect('/newsletters')->with('error', 'Falha ao enviar o email.');
}
}
}
