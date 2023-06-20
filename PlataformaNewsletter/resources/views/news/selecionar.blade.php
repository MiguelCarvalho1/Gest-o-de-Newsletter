@extends('layouts.style')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>News</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Noticias </title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$(document).ready(function(){
    document.getElementById("newsletterForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const checkboxes = document.querySelectorAll("input[name='selectedNews[]']:checked");
        if (checkboxes.length === 0) {
            alert("Selecione pelo menos uma notícia para criar a newsletter.");
            return;
        }

        const selectedNewsIds = Array.from(checkboxes).map(checkbox => checkbox.value);
        document.getElementById("selectedNews").value = selectedNewsIds.join(",");

        this.submit();
    });
});

</script>
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
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"> Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</head>
<body>
    <div class="container-fluid">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                        </div>
                    </div>
                </div>
                <h1>Criar Newsletters</h1>
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
                        <form action="{{ '/newsletters/create' }}" method="POST" id="newsletterForm">
                            @csrf
                            <input type="hidden" name="selectedNews" id="selectedNews" value="">
                            <div class="form-group">
                                <label for="titulo">Título da Newsletter:</label>
                                <input type="text" class="form-control" name="titulo" id="titulo">
                            </div>
                            <div class="form-group">
                                <label for="conteudo">Conteúdo da Newsletter:</label>
                                <textarea class="form-control" name="conteudo" id="conteudo" rows="5"></textarea>
                            </div>
                            <input type="hidden" name="data_envio" value="{{ date('Y-m-d H:i:s') }}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Criar Newsletter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</body>
</html>

