@section('title', "Editar Newsletter")
@extends('layouts.style')
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<header>
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
            <a class="nav-link" href="{{ url('/news/create') }}">Create news</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/news/selecionar') }}"> Create Newslletters</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</head>
<body>
    
    <div>
      
</div>
<div class="container-fluid">
  <h2>Editar Newsletter</h2>

  <form action="{{ url('/newsletters/update', $newsletter->id) }}" method="POST">
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
        </select>
    </div>
      <div class="form-group">
          <label for="data_envio">Data de Envio</label>
          <input type="date" class="form-control" id="data_envio" name="data_envio" value="{{ $newsletter->data_envio }}" required>
      </div>

      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="/newsletters" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
    </div>
</body>
</html>
