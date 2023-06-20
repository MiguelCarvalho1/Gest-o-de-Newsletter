<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>News</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f5f5f5;
    color: #333;
}

.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 40px;
    background-color: #fff;
    border: 1px solid #eaeaea;
    border-radius: 5px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

.title {
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 20px;
}

.image {
    width: 100%;
    margin-bottom: 30px;
}

.content {
    font-size: 16px;
    line-height: 1.8;
}

.footer {
    margin-top: 30px;
    text-align: right;
    font-size: 14px;
    color: #999;
}

.footer a {
    color: #999;
}

.footer a:hover {
    color: #333;
}
</style>
</head>
<body>
    <div class="container">
        <h1 class="title">{{ $noticia->titulo }}</h1>
        @if($noticia->images()->count() > 1)
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($noticia->images as $key => $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset($image->url) }}" class="d-block w-100" alt="Imagem {{ $key }}">
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
        @elseif($noticia->images()->count() == 1)
        <div>
            <img src="{{ asset($noticia->images[0]->url) }}" class="image" alt="Imagem">
        </div>
        @endif
        <div class="content">{!! ($noticia->conteudo) !!}</div>
        <div class="footer">
            <p>Publicado em {{ $noticia->created_at->format('d/m/Y') }}</p>
            <p>Fonte: Nome da Fonte</p>
        </div>
        <button type="button" onclick="goToHomePage()" class="btn btn-secondary">Voltar para a página inicial</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        function goToHomePage() {
            window.location.href = "/";
        }
        </script>
</body>
</html>
