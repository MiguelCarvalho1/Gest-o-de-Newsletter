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
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    var dataTable = $('#dataTable').DataTable({
        "language": {
            "search": "Pesquisar:",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrado de _MAX_ registros totais)"
        },
        "lengthMenu": [5, 10, 25, 50]
    });

    $('#search-input').on('keyup', function() {
        dataTable.search(this.value).draw();
    });
});
</script>
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
<header>
    <!-- Cabeçalho do site -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="{{ url('/dashboard') }}">Newsletter</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('/dashboard') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/newsletters') }}">Newsletters</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/tags') }}">Tags</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/news/create') }}">Create news</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/news/selecionar') }}">Create Newsletter</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/tags/criar') }}">Create Tags</a>
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
                        <h2>Notícias</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="100">
                        <thead style="text-align: center;">
                            <tr>
                                <th>Título</th>
                                <th>Ativo</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($noticia as $noticia)
                            <tr>
                                <td style="text-align: justify; vertical-align: middle"><a href="/news/show/{{$noticia->id}}">{{$noticia->titulo}}</a></td>
                                <td style="text-align: center; vertical-align: middle">
                                    @if($noticia->ativo == 1)
                                    <b type="radio"  class="text-center" style="color: green; ">Sim</b>
                                    @else
                                    <b  type="radio"  style="color: red; text-align: center;">Não</b>
                                    @endif
                                </td>
                                <td style="text-align: center; vertical-align: middle">
                                    <a href="/news/editar/{{$noticia->id}}" class="btn btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td style="text-align: center; vertical-align: middle">
                                    <form action="/news/{{$noticia->id}}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
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
