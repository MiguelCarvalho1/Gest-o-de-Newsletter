@extends('layouts.style')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>News</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
    body {
        overflow-x: hidden;
    }

    .container-fluid {
        padding-right: 0;
        padding-left: 0;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }

    .table-wrapper {
        min-width: 100%;
        overflow: hidden;
    }

    .table-title {
        padding-bottom: 15px;
        background-color: #e2e2e2;
    }

    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }

    .card-body {
        padding: 0;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }
</style>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body>
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
                <a class="nav-link" href="{{ url('/news') }}">News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/news/create') }}">Create news</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/newsletters/create') }}"> Create Newslletter</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>Newsletters</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="text-align: center;">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Conteudo</th>
                                <th>Data de Criação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($newsletters as $newsletter)
                            <tr>
                                <td>{{ $newsletter->id }}</td>
                                <td>{{ $newsletter->titulo }}</td>
                                <td>{{ $newsletter->conteudo }}</td>
                                <td>{{ $newsletter->created_at->format('d/m/Y') }}</td>
                                <td style="text-align: center;">
                                    <a href="/newsletter/{{ $newsletter->id }}" class="btn btn-primary">Ver</a>
                                    <a href="/newsletter/{{ $newsletter->id }}/edit" class="btn btn-success">Editar</a>
                                    <form action="/newsletter/{{ $newsletter->id }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                    
                                    <a href="{{ url('/enviar-email') }}">Enviar E-mail</a>


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
</body>
</html>

