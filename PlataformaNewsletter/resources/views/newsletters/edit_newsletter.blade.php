@section('title', "Editar Newsletter")
@extends('layouts.style')
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
    
    <div>
      
</div>
<div class="container-fluid">
    <h2>Editar Newsletter</h2>
  
    <form id="newsletter-form" action="{{ url('/newsletters/update', $newsletter->id) }}" method="POST">
        @csrf
        @method('PUT')
  
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $newsletter->titulo }}" required>
        </div>
  
        <div class="form-group">
            <label for="conteudo">Conteúdo</label>
            <textarea class="form-control" id="conteudo" name="conteudo" rows="5" required>{{ $newsletter->conteudo }}</textarea>
        </div>
  
        <div class="container-xl">
          <div class="table-responsive">
              <div class="table-wrapper">
                  <div class="table-title">
                      <div class="row">
                          <div class="col-sm-8">
                          </div>
                      </div>
                  </div>
                  <h1>Notícias</h1>
                  <div class="card-body">
                      <br>
                      <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="100">
                              <thead style="text-align: center;">
                                  <tr>
                                      <th>Selecionar</th>
                                      <th>Título</th>
                                      <th>Ativo</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($noticia as $noticia)
                                  <tr>
                                      <td style="text-align: center; vertical-align: middle">
                                          <input type="checkbox" name="selectedNews[]" value="{{$noticia->id}}">
                                      </td>
                                      <td style="text-align: justify; vertical-align: middle">
                                          <a href="/news/show/{{$noticia->id}}">{{$noticia->titulo}}</a>
                                      </td>
                                      <td style="text-align: center; vertical-align: middle">
                                          @if($noticia->ativo == 1)
                                          <b type="radio" class="text-center" style="color: green;">Sim</b>
                                          @else
                                          <b type="radio" style="color: red; text-align: center;">Não</b>
                                          @endif
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
        </div>
  
        <div class="form-group">
            <label for="data_envio">Data de Envio</label>
            <input type="date" class="form-control" id="data_envio" name="data_envio" value="{{ $newsletter->data_envio }}" required>
          </div>
      
          <button type="submit" class="btn btn-primary" onclick="return confirm('Tem certeza que deseja editar a newsletter?')">Salvar</button>
          <a href="/newsletters" class="btn btn-secondary">Cancelar</a>
        </form>
    
  
    <script>
      document.getElementById("newsletter-form").addEventListener("submit", function(event) {
        var selectedNews = document.querySelectorAll('input[name="selectedNews[]"]:checked');
        if (selectedNews.length === 0) {
          alert("Selecione pelo menos uma notícia para editar a newsletter.");
          event.preventDefault(); // Impede o envio do formulário se nenhuma notícia estiver selecionada
        }
      });
    </script>
  </div>
</html>
