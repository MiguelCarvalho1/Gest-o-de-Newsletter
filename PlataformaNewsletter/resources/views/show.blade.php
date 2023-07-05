@extends('layouts.style_show')
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
</head>
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
        <button type="button" onclick="goToHomePage()" class="btn btn-primary">Voltar para a página inicial</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        function goToHomePage() {
            window.location.href = "/";
        }
        </script>
</body>
</html>
