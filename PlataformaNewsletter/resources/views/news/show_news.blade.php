@extends('layouts.style_show')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Cabeçalho do site -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="{{ url('/dashboard') }}">Newslletter</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('/dashboard') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/newsletters') }}">Newslletters</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/news') }}">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/tags') }}">Tags</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/news/create') }}">Create news</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/news/selecionar') }}"> Create Newslletters</a>
          </li>
        </ul>
      </div>
    </nav>
</head>
<body>
    <div class="container">
        <h1 class="title">{{ $noticia->titulo }}</h1>
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
            <p>Fonte: Nome da Fonte</p>
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
