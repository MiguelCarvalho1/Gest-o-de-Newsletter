
@extends('layouts.style')
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Criar Newsletter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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

            // Pesquisa por Tag
            $('#tag').on('keyup', function(){
                var tag = $(this).val().toLowerCase();
                $('#dataTable tbody tr').filter(function(){
                    $(this).toggle($(this).find('td:eq(2)').text().toLowerCase().indexOf(tag) > -1)
                });
            });

            // Manipular envio do formulário
            document.getElementById("newsletterForm").addEventListener("submit", function(e) {
                e.preventDefault();

                const checkboxes = document.getElementsByName("selectedNews[]");
                const selectedNewsIds = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                document.getElementById("selectedNews").value = selectedNewsIds.join(",");
                this.submit();
            });
        });
    </script>
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
</head>
<body>

    <div class="container-fluid">
        <h1>Criar Newsletters</h1>
        <br>
        <form action="{{ '/newsletters/create' }}" method="POST" id="newsletterForm">
            @csrf
            <div class="form-group">
                <label for="titulo">Título da Newsletter:</label>
                <input type="text" class="form-control" name="titulo" id="titulo">
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo da Newsletter:</label>
                <textarea class="form-control" name="conteudo" id="conteudo" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="tags">Tags:</label>
                <input type="text" class="form-control" name="tags" id="tags" placeholder="Digite as tags separadas por vírgula">
            </div>
            <input type="hidden" name="selectedNews" id="selectedNews" value="">
            <input type="hidden" name="data_envio" value="{{ date('Y-m-d H:i:s') }}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"onclick="return confirm('Tem certeza que quer criar a newsletter?')"></i> Criar Newsletter</button>
        </form>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Selecionar</th>
                        <th>Título</th>
                        <th>Tags</th>
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
                                    @foreach($noticia->tags as $tag)
                                    <span class="badge badge-secondary">{{ $tag->nome }}</span>
                                    @endforeach
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
</body>
</html>
