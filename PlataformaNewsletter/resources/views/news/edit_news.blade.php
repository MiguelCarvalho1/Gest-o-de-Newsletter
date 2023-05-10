
@section('title', 'Editar Notícias . $noticia->titulo')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<h1>Editar Notícia: {{$noticia->titulo}}</h1>
    <div class="col-md-6 offset-md-3">
        <form action="/noticia/atualizar/{{$noticia->id}}" method="POST" enctype="multipart/form-data" name="Form" onsubmit="return validateForm()">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="titulo">Título: *</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
        </div>
        <div class="form-group">
            <label for="media">Media: *</label>
            <input type="file" class="form-control-file" id="media" name="media" placeholder="Media">
        </div>
        <div class="form-group">
            <label for="conteudo">Conteúdo: *</label>
            <textarea name="conteudo" id="summernote" class="form-control" placeholder="conteúdo"></textarea>
        </div>
        <div class="form-group">
            <label for="ativo">Ativo:</label>
            <select name="ativo" id="ativo" class="from-group">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Editar Notícia">
</div>
            
            
</div>
<br>
@endsection

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
    $(document).ready(function() {
        $('#summernote').summernote({
        height: 400
    });
    });
</script>