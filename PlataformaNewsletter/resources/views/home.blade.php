@extends('layouts.style_home')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
<body class="antialiased" >
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
                        @foreach($noticia->sortByDesc('created_at') as $item)
                            @if($item->ativo && $item->images()->first())
                                <div class="card mb-4 news-card">
                                    <img src="{{ asset($item->images()->first()->url) }}" width="720" class="card-img-top">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><a href="/show/{{ $item->id }}">{{ $item->titulo }}</a></h5>
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



