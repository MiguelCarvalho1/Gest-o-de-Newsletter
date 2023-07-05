<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Noticias </title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
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
    <div>
    <h1>Criar Newslletter</h1>
</div>
</body>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Newsletter</h1>
    
    <form action="/newsletters" method="POST">
      @csrf
      <div class="form-group">
          <label for="title">Título da Newsletter:</label>
          <input type="text" name="title" id="title" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="content">Conteúdo da Newsletter:</label>
          <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
      </div>
      <div class="form-group">
          <label>Notícias Selecionadas:</label>
          <div class="checkbox-list">
              @foreach($selectedNews as $news)
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="selectedNewsIds[]" value="{{ $news->id }}" checked>
                  <label class="form-check-label">{{ $news->title }}</label>
              </div>
              @endforeach
          </div>
      </div>
      <button type="submit" class="btn btn-primary"onclick="return confirm('Tem certeza que deseja criar a newsletter?')">Criar Newsletter</button>
  </form>
  
</div>





</html>
