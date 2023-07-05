@extends('layouts.style')
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Newsletters</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('#dataTable').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Mostrar _MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    }
                }
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

    <div class="container-fluid">
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
                                    <th>Título</th>
                                    <th>Conteúdo</th>
                                    <th>Data de Criação</th>
                                    <th>Tags</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($newsletters as $newsletter)
                                <tr>
                                    <td>{{ $newsletter->titulo }}</td>
                                    <td>{{ $newsletter->conteudo }}</td>
                                    <td>{{ $newsletter->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @foreach($newsletter->tags as $tag)
                                            <span class="badge badge-primary">{{ $tag->nome }}</span>
                                        @endforeach
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="/newsletters/{{ $newsletter->id }}" class="btn btn-primary"onclick="return confirm('Tem certeza que quer ver a newsletter?')">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="/newsletters/edit/{{ $newsletter->id }}" class="btn btn-warning"onclick="return confirm('Tem certeza que quer editar a newsletter?')">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="/newsletters/{{ $newsletter->id }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"onclick="return confirm('Tem certeza que quer eliminar a newsletter?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('enviar.newsletter', ['newsletterId' => $newsletter->id]) }}" method="POST">
                                       @csrf
                                        <button type="submit"onclick="return confirm('Tem certeza que deseja enviar?')">Enviar Email</button>
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
