<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AssinanteController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\EmailController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

 /*Noticia*/
 Route::get('/news/create',[NewsController::class, 'create'] )->middleware('auth');
 Route::post('/news', [NewsController::class, 'store'])->middleware('auth');
 Route::get('/news', [NewsController::class, 'index'])->middleware('auth');
 Route::get('/news/selecionar', [NewsController::class, 'selecionar_news'])->middleware('auth');
 Route::post('/news/select', [NewsController::class, 'select'])->middleware('auth');

 Route::get('/', [NewsController::class, 'home']);
 Route::get('/show/{id}', [NewsController::class, 'show_home']);
 Route::get('/news/show/{id}', [NewsController::class, 'show'])->middleware('auth');
 Route::get('/news/editar/{id}', [NewsController::class, 'editar_noticia'])->middleware('auth');
 Route::post('/news/atualizar/{id}', [NewsController::class, 'atualizar_noticia'])->middleware('auth');
 Route::delete('/news/{id}', [NewsController::class, 'destroy'])->middleware('auth');
 Route::get('/news/data', [NewsController::class, 'getData'])->middleware('auth');


Route::get('/assinantes_create', [AssinanteController::class, 'create']);
;



//rota assinantes pagina inicial
Route::get('/assinantes', [AssinanteController::class, 'index']);


Route::post('/assinantes_create', [AssinanteController::class, 'store']);

Route::post('/assinantes', [AssinanteController::class, 'store']);

Route::get('/admin/assinante', [AssinanteController::class, 'index'])->middleware('auth');
Route::get('/assinantes/{id}/edit', [AssinanteController::class, 'edit'])->name('assinantes.edit');
Route::put('/assinantes/{id}', [AssinanteController::class, 'update'])->name('assinantes.update');

Route::delete('/admin/assinante/{id}', [AssinanteController::class, 'destroy'])->middleware('auth');
Route::delete('/admin/assinante', [AssinanteController::class, 'remover'])->middleware('auth');







 
// Newsletter
Route::get('/newsletters', [NewsletterController::class, 'index'])->middleware('auth');
Route::post('/newsletters/create', [NewsletterController::class, 'create'])->middleware('auth');
Route::get('/newsletters/{id}', [NewsletterController::class, 'show'])->middleware('auth');
Route::get('/newsletters/edit/{id}', [NewsletterController::class, 'edit'])->middleware('auth');
Route::put('/newsletters/update/{id}', [NewsletterController::class, 'update'])->middleware('auth');
Route::delete('/newsletters/{id}', [NewsletterController::class, 'destroy'])->middleware('auth');



// Tags
Route::get('/tags', [TagController::class, 'index'])->middleware('auth');
Route::get('/tags/criar', [TagController::class, 'showCreateForm'])->middleware('auth');
Route::post('/tags', [TagController::class, 'store'])->middleware('auth');
Route::get('/tags/edit/{id}', [TagController::class, 'edit'])->middleware('auth');
Route::put('/tags/{id}', [TagController::class, 'update'])->middleware('auth');
Route::delete('/tags/{id}', [TagController::class, 'destroy'])->middleware('auth');



Route::post('/enviar-email', [EmailController::class, 'enviarEmail'])->name('enviar.newsletter');


$mailHost = env('MAIL_HOST');
$mailPort = env('MAIL_PORT');

Route::get('/email-verification', function () use ($mailHost, $mailPort) {
    // Verifica se as configurações do servidor de e-mail estão definidas corretamente
    if (!empty($mailHost) && !empty($mailPort)) {
        // Tente estabelecer uma conexão com o servidor de e-mail
        $connection = @fsockopen($mailHost, $mailPort, $errno, $errstr, 5);

        if ($connection) {
            echo 'Conexão com o servidor de e-mail estabelecida com sucesso.';
            fclose($connection);
            
            return view('email-verification', ['result' => 'Conexão com o servidor de e-mail estabelecida com sucesso.']);
        } else {
            echo 'Não foi possível estabelecer uma conexão com o servidor de e-mail.';
        }
    } else {
        echo 'As configurações do servidor de e-mail não estão definidas corretamente no arquivo .env.';
    }
});


//Exportar 
Route::get('tags/export/{format}', [TagController::class, 'export'])->name('tags.export');
Route::get('news/export/pdf/{id}', [NewsController::class, 'exportPdf'])->name('news.exportPdf');
Route::get('news/export/xlsx', [NewsController::class, 'exportXlsx'])->name('news.exportXlsx');

