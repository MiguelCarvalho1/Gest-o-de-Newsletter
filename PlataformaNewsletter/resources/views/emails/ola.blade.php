<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Template Moderno</title>
    <style>
        body {
            background-color: #F4F4F4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            background-color: #192A56;
            color: #FFFFFF;
            padding: 10px;
        }

        .header h1 {
            margin: 0;
            padding: 0;
        }

        .news-card {
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            list-style: none; /* Remove o ponto no lado esquerdo dos cards */
        }

        .news-card h5 {
            margin-top: 0;
        }

        .news-card p {
            margin-bottom: 0;
        }

        .news-card img {
            width: 100%;
            margin-bottom: 10px;
        }

        .news-card .content {
            max-height: 150px;
            overflow: hidden;
        }

        .news-card .read-more-btn {
            color: blue;
            cursor: pointer;
        }

        .news-card:first-child {
            margin-top: 0;
        }

        .center-text {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Newsletter</h1>
        </div>

        <div class="center-text">
            <h1>Olá!</h1>
            <p>{{ $titulo }}</p>
            <p>{{ $conteudo }}</p>
        </div>
        
        <h2>Notícias:</h2>
        <ul class="list-unstyled">
        @foreach ($news as $new)
            <li class="mb-4">
                <div class="card news-card">
                    @if ($new->images->count() > 0)
                        <img src="{{ $message->embed($new->images[0]->url) }}" alt="{{ $new->images[0]->descricao }}">
                    @endif
                    <div class="content">
                        <h5 class="card-title text-primary">{{ $new->titulo }}</h5>
                        <p class="card-text font-italic">
                            @php
                                $content = strlen($new->conteudo) > 250 ? substr($new->conteudo, 0, 250) . '...' : $new->conteudo;
                            @endphp
                            {!! nl2br($content) !!}
                        </p>
                        @if (strlen($new->conteudo) > 250)
                            <button class="read-more-btn" onclick="showFullContent(this)">Ler mais</button>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    </div>
    <script>
        // Função para exibir o conteúdo completo quando o botão "Ler mais" é clicado
        function showFullContent(button) {
            button.parentNode.getElementsByClassName('card-text')[0].innerHTML = "{!! nl2br($new->conteudo) !!}";
            button.style.display = 'none';
        }
    </script>
</body>
</html>
