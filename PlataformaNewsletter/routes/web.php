<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AssinanteController;
use App\Http\Controllers\NewsletterController;



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
 Route::get('/', [NewsController::class, 'home']);
 Route::get('/news/editar/{id}', [NewsController::class, 'editar_noticia'])->middleware('auth');
 Route::post('/news/atualizar/{id}', [NewsController::class, 'atualizar_noticia'])->middleware('auth');

Route::get('/admin/assinantes', [AssinanteController::class, 'index'])->name('assinantes.index');
Route::get('/assinantes_create', [AssinanteController::class, 'create']);
Route::post('/assinantes', [AssinanteController::class, 'store']);
Route::get('/assinantes/{id}', [AssinanteController::class, 'show'])->name('assinantes.show');
Route::get('/assinantes/{id}/edit', [AssinanteController::class, 'edit'])->name('assinantes.edit');
Route::put('/assinantes/{id}', [AssinanteController::class, 'update'])->name('assinantes.update');
Route::delete('/assinantes/{id}', [AssinanteController::class, 'destroy'])->name('assinantes.destroy');

 
// Newsletter
Route::get('/newsletters', [NewsletterController::class, 'index'])->middleware('auth');
Route::post('/newsletters/create', [NewsletterController::class, 'create'])->name('newsletters.create')->middleware('auth');