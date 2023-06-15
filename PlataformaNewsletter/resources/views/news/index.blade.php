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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body>
    <header>
        <div class="sidebar">
            <ul>
                <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="{{ url('/news/create') }}"><i class="fa fa-pencil"></i> Create news</a></li>
                <li><a href="{{ url('/newsletters') }}"><i class="fa fa-envelope"></i> Newsletter</a></li>
                <li><a href="{{ url('/newsletters/create') }}"><i class="fa fa-plus"></i> Create Newsletter</a></li>
            </ul>
        </div>
      </header>
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
                
                    @csrf
                    
                <div class="card-body">
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="100">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>Título</th>
                                    <th>Conteúdo</th>
                                    <th>Media</th>
                                    <th>Ativo</th>
                                    <th>Editar</th>
                                    <th>Excluir</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($noticia as $noticia)
                                <tr>
                                    <td style="text-align: justify; vertical-align: middle"><a href="/news/show/{{$noticia->id}}">{{$noticia->titulo}}</td>
                                    <td style="text-align: justify; vertical-align: middle">{!! Str::limit($noticia->conteudo, 100) !!}</td>
                                    
                                    <td>
                                        @if ($noticia->images)
                                        @foreach ($noticia->images as $image)
                                        <img src=" {{$image->url}}" alt="{{ $image->nome }}" width="100">
                                        @endforeach
                                    @endif
                                    </td>
                                    <td style="text-align: center; vertical-align: middle">
                                        @if($noticia->ativo == 1)
                                        <b type="radio"  class="text-center" style="color: green; ">Sim</b>
                                        @else
                                        <b  type="radio"  style="color: red; text-aling: center;">Não</b>
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
                        <a href="/news/selecionar" class="btn btn-primary">Notícias</a>
                       
                </div>
            </div>
        </div>
    </div>
    </body>


        
    
</html>