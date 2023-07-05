<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .container {
        background-color: #fff;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .badge {
        margin-right: 5px;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
    }

    .image {
        max-width: 75%;
        height: auto;
        margin-bottom: 20px;
    }
    .tag {
    display: inline-block;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 5px;
    background-color: #a7a7a7;
    color: #fff;
    margin-right: 5px;
    margin-bottom: 5px;
}

    .content {
        margin-bottom: 20px;
    }

    .footer {
        font-size: 14px;
        color: #666;
    }
</style>
</head>
<body>
    <div class="container">
        <h1 class="title">{{ $noticia->titulo }}</h1>
        <div>
            <div>
                @foreach($noticia->tags as $tag)
                    <span class="tag">{{ $tag->nome }}</span>
                @endforeach
            </div>
        </div>
        <div>
            @if($noticia->images->isNotEmpty())
            @foreach($noticia->images as $image)
                <img src="{{ public_path($image->url) }}" class="image" alt="Imagem">
            @endforeach
        @endif

        <div class="content">{!! ($noticia->conteudo) !!}</div>
        <div class="footer">
            <p>Publicado em {{ $noticia->created_at->format('d/m/Y') }}</p>
            <p>Autor: {{ $noticia->user->name }}</p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

