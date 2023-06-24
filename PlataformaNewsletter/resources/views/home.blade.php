@extends('layouts.style_home')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                <a class="link" href="{{ url('/assinantes_create') }}">Inscreva-se</a>
            </div>
        @endif
        <main>
            <div class="container mt-4">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-8">
                        @foreach($noticia as $item)
                            @if($item->ativo)
                                <div class="card mb-4 news-card">
                                    <img src="{{ asset($item->images()->first()->url) }}" width="720" class="card-img-top">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><a href="/show/{{ $item->id }}">{{ $item->titulo }}</a></h5>
                                        <p class="card-text">{!! Str::limit($item->conteudo, 100) !!}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>



