<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Noticias </title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <!-- Cabeçalho do site -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="{{ url('/dashboard') }}"> <i class="fa-solid fa-newspaper"></i> Newslletter</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{ url('/dashboard') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/news') }}">News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/news/create') }}"> Create News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/newsletters') }}">Newslletter</a>
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
      <button type="submit" class="btn btn-primary">Criar Newsletter</button>
  </form>
  
</div>





</html>
