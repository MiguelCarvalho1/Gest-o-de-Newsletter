

@section('title', "Editar Tag")

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
          <a class="nav-link" href="{{ url('/tags') }}">Tags</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/news/create') }}">Create news</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/news/selecionar') }}"> Create Newslletters</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/tags/criar') }}">Create Tags</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
</head>
<body>
    <div>
        <h1>Editar Tag: {{$tag->name}}</h1>
</div>
<div class="container-fluid">
  <div class="row">
      <div class="col-md-7 offset-3 mt-4">
          <div class="card-body">
              <form action="/tag/update/{{$tag->id}}" method="POST" enctype="multipart/form-data" name="Form" onsubmit="return validateForm()">
                  @csrf
                  <div class="form-group">
                      <label for="nome">Nome da Tag: </label>
                      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ $tag->name }}">
                  </div>
                  <input type="submit" class="btn btn-primary" value="Atualizar Tag">
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
      var nome = document.forms["Form"]["nome"].value;
      if (titulo == null || nome == "",  
          corpo == null || corpo == "") {
        alert("Por favor, preencha todos os campos obrigatórios (*)");
        return false;
      }
    };
    
  </script>



</html>