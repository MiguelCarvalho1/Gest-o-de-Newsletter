@extends('layouts.style_show')

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8">
<link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<header>
    <!-- Cabeçalho do site -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('/admin') }}">Plataforma de Gestão de Newsletter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/newsletters') }}">Newsletters</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/news') }}">Notícias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/tags') }}">Tags</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/registos') }}">Registos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/news/create') }}">Criar Noticias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/news/selecionar') }}">Criar Newsletter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/tags/criar') }}"> Criar Tags</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/assinante') }}">Assinantes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                Sair
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<body>
    <div class="container">
        <h1 class="title">{{ $noticia->titulo }}</h1>
        <div>
            @foreach($noticia->tags as $tag)
                <span class="badge badge-secondary">{{ $tag->nome }}</span>
            @endforeach
        </div>
        @if($noticia->images()->count() > 1)
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($noticia->images as $key => $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset($image->url) }}" class="d-block w-100" alt="Imagem {{ $key }}">
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
        @elseif($noticia->images()->count() == 1)
        <div>
            <img src="{{ asset($noticia->images[0]->url) }}" class="image" alt="Imagem">
        </div>
        @endif
        <div class="content">{!! ($noticia->conteudo) !!}</div>
        <div class="footer">
            <p>Publicado em {{ $noticia->created_at->format('d/m/Y') }}</p>
            <p>Autor: {{ $noticia->user->name }}</p>
        </div>
        <button type="button" onclick="goToHomePage()" class="btn btn-primary">Voltar para Noticias</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        function goToHomePage() {
            window.location.href = "/news";
        }
        </script>
</body>
</html>
