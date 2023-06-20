
@section('title', "Editar Notícias: $noticia->titulo")

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<header>
  <!-- Cabeçalho do site -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/dashboard') }}">Newslletter</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/dashboard') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/newsletters') }}">Newslletters</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/news') }}">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/news/create') }}">Create news</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/news/selecionar') }}"> Create Newslletters</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"> Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
</head>
<body>
    <div>
        <h1>Editar Notícia: {{$noticia->titulo}}</h1>
</div>
<div class="container-fluid">
  <div class="row">
      <div class="col-md-7 offset-3 mt-4">
          <div class="card-body">
              <form action="/news/atualizar/{{$noticia->id}}" method="POST" enctype="multipart/form-data" name="Form" onsubmit="return validateForm()">
                  @csrf
                  <div class="form-group">
                      <label for="titulo">Título: </label>
                      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{$noticia->titulo}}">
                  </div>
                  <div class="form-group">
                    <label for="image">Imagem: </label>
                    <input type="file"  class="form-control-file" id="image" name="images[]" multiple placeholder="Media">
                </div>
                <div class="form-group">
                  <label for="conteudo">Conteúdo: </label>
                  <textarea name="conteudo" id="summernote" class="form-control" placeholder="conteúdo">{!! ($noticia->conteudo) !!}</textarea>
              </div>
                  <div class="form-group">
                      <label for="ativo">Ativo:</label>
                      <select name="ativo" id="ativo" class="from-group">
                          <option value="1" {{ $noticia->ativo ? 'selected' : '' }}>Sim</option>
                          <option value="0" {{ !$noticia->ativo ? 'selected' : '' }}>Não</option>
                      </select>
                  </div>
                  <input type="submit" class="btn btn-primary" value="Atualizar Notícia">
          </div>
              </form>
              
          </div>
      </div>
  </div>
</div>

    </div>
</body>
<script type="text/javascript">
    function validateForm() {
      var titulo = document.forms["Form"]["titulo"].value;
      var corpo = document.forms["Form"]["conteudo"].value;
      if (titulo == null || titulo == "",  
          corpo == null || corpo == "") {
        alert("Por favor, preencha todos os campos obrigatórios (*)");
        return false;
      }
    };
    
  </script>

<script type="text/javascript">
   $(document).ready(function() {
    $('#summernote').summernote({
        callbacks: {
            onImageUpload: function(files) {
                // Lógica para o upload de imagens, se necessário
            },
            onPaste: function(e) {
                // Lógica para colar conteúdo, se necessário
            },
            onKeyup: function(e) {
                // Lógica para detectar teclas pressionadas, se necessário
            },
            onBlur: function(e) {
                // Aqui ocorre a remoção das tags <p>
                var content = $(this).summernote('getText');
                var contentWithoutPTags = content.replace(/<\/?p[^>]*>/g, '');
                $(this).summernote('code', content, , contentWithoutPTags);
            }
        }
    });
});

</script>
<script>
  $(document).ready(function() {
      $('#summernote').summernote();
  });
</script>
</html>
