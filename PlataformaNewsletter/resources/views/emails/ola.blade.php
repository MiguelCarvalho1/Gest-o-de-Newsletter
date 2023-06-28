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
    </style>
</head>
<body>
    <h1>Olá!</h1>
    <p>Aqui está o título da newsletter: {{ $titulo }}</p>
    <p>Conteúdo: {{ $conteudo }}</p>
    
    <h2>Notícias:</h2>
    <ul>
        @foreach ($news as $new)
            <li>
                <strong>{{ $new->titulo }}</strong><br>
                {!! nl2br($new->conteudo) !!}
            </li>
        @endforeach
    </ul>
</body>
</html>
