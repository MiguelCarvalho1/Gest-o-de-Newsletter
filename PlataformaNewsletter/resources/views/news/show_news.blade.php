@extends('layouts.style')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="{{ url('/news/create') }}"><i class="fa fa-pencil"></i> Create news</a></li>
            <li><a href="{{ url('/newsletters') }}"><i class="fa fa-envelope"></i> Newsletter</a></li>
            <li><a href="{{ url('/newsletters/create') }}"><i class="fa fa-plus"></i> Create Newsletter</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>{{ $noticia->titulo }}</h1>
        <p>{!! ($noticia->conteudo) !!}</p>

        @if ($noticia->images)
            @foreach ($noticia->images as $image)
                <img src="{{ asset('storage/' . $image->url) }}" alt="{{ $image->nome }}" width="100">
            @endforeach
        @endif
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
