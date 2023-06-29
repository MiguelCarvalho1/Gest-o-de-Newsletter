<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Olá!</title>
    <style>
        /* Estilos para melhorar a aparência do email */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 10px;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 10px;
        }
        img {
            max-width: 300px;
            height: auto;
            float: left;
            margin-right: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Olá!</h1>
    <p>Aqui está o título da newsletter: {{ $titulo }}</p>
    <p>Conteúdo: {{ $conteudo }}</p>
    
    <h2>Notícias:</h2>
    <ul class="list-unstyled">
    @foreach ($news as $new)
        <li class="mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $new->titulo }}</h5>
                    <p class="card-text font-italic">{!! nl2br($new->conteudo) !!}</p>
                    @if ($new->images->count() > 0)
                        <div class="row">
                            @foreach ($new->images as $image)
                                <div class="col-6">
                                    <img src="{{ $message->embed($image->url) }}" alt="{{ $image->descricao }}" class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>



</body>
</html>
