@extends('layouts.style')
<!DOCTYPE html >
<html lang="pt" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        p {
            color: #666;
            line-height: 1.5;
            margin-bottom: 15px;
        }
    </style>
</head>


    <header>
        <!-- Cabeçalho do site -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ url('/admin') }}">
                Plataforma de Gestão de Newsletter</a>
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
        <div id="welcome-section">
           
        </div>
    
    </body>

</html>
