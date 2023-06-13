@extends('layouts.style')
@section('content')
    <style>
        /* Estilos personalizados */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            line-height: 1.6;
        }

        .carousel {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .carousel-inner {
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .carousel-item {
            width: 100%;
            height: 100%;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .carousel-item.active {
            display: flex;
        }

        .carousel-item img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .carousel-indicators {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .carousel-indicators li {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ccc;
            margin: 0 4px;
            cursor: pointer;
        }

        .carousel-indicators li.active {
            background-color: #333;
        }
    </style>
<style>
        /* Estilos personalizados */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            line-height: 1.6;
        }

        .carousel {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .carousel-inner {
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .carousel-item {
            width: 100%;
            height: 100%;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .carousel-item.active {
            display: flex;
        }

        .carousel-item img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .carousel-indicators {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .carousel-indicators li {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ccc;
            margin: 0 4px;
            cursor: pointer;
        }

        .carousel-indicators li.active {
            background-color: #333;
        }
    </style>


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
        @if($noticia->images()->count() > 0)
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($noticia->images as $key => $image)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($noticia->images as $key => $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset($image->url) }}" class="d-block w-75" alt="Imagem {{ $key }}">
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
    @endif
        <p>{!! ($noticia->conteudo) !!}</p>
       
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
