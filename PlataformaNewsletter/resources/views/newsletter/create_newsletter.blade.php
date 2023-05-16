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
    <header>
        <!-- Cabeçalho do site -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="{{ url('/dashboard') }}"> <i class="fa-solid fa-newspaper"></i> Newslletter</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{ url('/dashboard') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/news') }}">News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/news/create') }}"> Create News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/newsletter') }}">Newslletter</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    <div>
    <h1>Criar Newslletter</h1>
</div>
</body>

<script>
  $(document).ready(function(){
    $('#createNewsletterBtn').click(function(){
      var selectedNews = [];
      $('input[type="checkbox"]:checked').each(function(){
        var newsId = $(this).attr('id').replace('checkbox', '');
        selectedNews.push(newsId);
      });
      .ajax({
        url: '/newsletter/create',
          method: 'POST',
        data: { newsIds: selectedNews },
        success: function(response) {
      //     // Ação de sucesso
        },
        error: function(error) {
      //     // Ação de erro
          }
      });;
      
      // Aqui você pode enviar os IDs das notícias selecionadas para o servidor
      // para processá-los e criar a newsletter.
      // Você pode usar uma chamada AJAX para enviar os dados para o servidor.
      // Exemplo:
      // $.ajax({
      //   url: '/newsletter/create',
      //   method: 'POST',
      //   data: { newsIds: selectedNews },
      //   success: function(response) {
      //     // Ação de sucesso
      //   },
      //   error: function(error) {
      //     // Ação de erro
      //   }
      // });
    });
  });
  </script>
  


</html>
