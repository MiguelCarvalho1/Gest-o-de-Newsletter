@extends('layouts.style')
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registos</title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

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
        <div class="container-fluid">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h2>Registos</h2>
                            </div>
                            <div class="col-sm-4 text-right menu-superior">
                                <div class="btn-group" role="group">
                                    <!-- Exportar para PDF -->
                                    <a href="{{ route('registos.export.pdf') }}" class="btn btn-danger">
                                        <i class="fa fa-file-pdf"></i> Exportar PDF
                                    </a>
                                    <!-- Exportar para XLSX -->
                                    <a href="{{ route('registos.export.xlsx') }}" class="btn btn-success btn-exportar">
                                        <i class="fa fa-file-excel"></i> Exportar XLSX
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-fluid">
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="100">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>Utilizador</th>
                                        <th>Newsletters Criadas</th>
                                        <th>Notícias Criadas</th>
                                        <th>Newsletters Enviadas</th>
                                        <th>Newsletters Recebidas</th>
                                        <th>Tags Utilizadas (Notícias)</th>
                                        <th>Tags Utilizadas (Newsletters)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros as $registro)
                                        <tr>
                                            <td>{{ $registro->user->name }}</td>
                                            <td>{{ $registro->newsletter_count }}</td>
                                            <td>{{ $registro->news_count }}</td>
                                            <td>{{ $registro->newsletter_enviadas }}</td>
                                            <td>{{ $registro->newsletter_recebidas }}</td>
                                            <td>{{ $registro->tags_utilizadas_noticias }}</td>
                                            <td>{{ $registro->tags_utilizadas_newsletters }}</td>
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
