<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Noticias </title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
</head>
<body>
    <div>
    <h1>Criar Notícia</h1>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-3 mt-4">
                <div class="card-body">
                    <form action="/noticia" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="titulo">Título: </label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
                        </div>
                        <div class="form-group">
                            <label for="media">Media: </label>
                            <input type="file" class="form-control-file" id="media" name="media" placeholder="Media">
                        </div>
                        <div class="form-group">
                            <label for="conteudo">Conteúdo: </label>
                            <textarea name="conteudo" id="summernote" class="form-control" placeholder="conteúdo"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ativo">Ativo:</label>
                            <select name="ativo" id="ativo" class="from-group">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Criar Notícia">
                </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
        height: 400
    });
    });
</script>
</html>
