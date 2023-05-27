


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>News</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px 25px;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    padding-bottom: 15px;
    color: #fff;
    padding: 16px 30px;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}
.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}
.table-title .btn {
    color: #566787;
    float: right;
    font-size: 13px;
    background: #fff;
    border: none;
    min-width: 50px;
    border-radius: 2px;
    border: none;
    outline: none !important;
    margin-left: 10px;
}
.table-title .btn:hover, .table-title .btn:focus {
    color: #566787;
    background: #f2f2f2;
}
.table-title .btn i {
    float: left;
    font-size: 21px;
    margin-right: 5px;
}
.table-title .btn span {
    float: left;
    margin-top: 2px;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}
table.table tr th:first-child {
    width: 60px;
}
table.table tr th:last-child {
    width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}	
table.table td:last-child i {
    opacity: 0.9;
    font-size: 22px;
    margin: 0 5px;
}
table.table td a {
    font-weight: bold;
    color: #566787;
    display: inline-block;
    text-decoration: none;
}
table.table td a:hover {
    color: #2196F3;
}
table.table td a.settings {
    color: #2196F3;
}
table.table td a.delete {
    color: #F44336;
}
table.table td i {
    font-size: 19px;
}
table.table .avatar {
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 10px;
}
.status {
    font-size: 30px;
    margin: 2px 2px 0 0;
    display: inline-block;
    vertical-align: middle;
    line-height: 10px;
}
.text-success {
    color: #10c469;
}
.text-info {
    color: #62c9e8;
}
.text-warning {
    color: #FFC107;
}
.text-danger {
    color: #ff5b5b;
}
.pagination {
    float: right;
    margin: 0 0 5px;
}
.pagination li a {
    border: none;
    font-size: 13px;
    min-width: 30px;
    min-height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 2px !important;
    text-align: center;
    padding: 0 6px;
}
.pagination li a:hover {
    color: #666;
}	
.pagination li.active a, .pagination li.active a.page-link {
    background: #03A9F4;
}
.pagination li.active a:hover {        
    background: #0397d6;
}
.pagination li.disabled i {
    color: #ccc;
}
.pagination li i {
    font-size: 16px;
    padding-top: 6px
}
.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}
</style>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body>
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
                <a class="nav-link" href="{{ url('/news/create') }}">Create news</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/newsletters') }}">Newslletter</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/newsletters/create') }}"> Create Newslletter</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8">
                    </div>
                    
                </div>
            </div>
            <h1>Notícias</h1>
            <div class="card-body">
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="100">
                        <thead style="text-align: center;">
                            <tr>
                                <th>Selecionar</th>
                                <th>Titulo</th>
                                <th>Conteúdo</th>
                                <th>Media</th>
                                <th>Ativo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($noticia as $noticia)
                            <tr>
                                <td style="text-align: center; vertical-align: middle">
                                    <input type="checkbox" id="checkbox{{$noticia->id}}">
                                </td>
                                <td style="text-align: justify; vertical-align: middle"><a href="/news/editar/{{$noticia->id}}">{{$noticia->titulo}}</td>
                                <td style="text-align: justify; vertical-align: middle">{!! Str::limit($noticia->conteudo, 100) !!}</td>
                                
                                <td style="text-align: center; vertical-align: middle"><img src="/img/noticia/{{$noticia->media}}" style="width: 75px;"></img></td>
                                
                                <td style="text-align: center; vertical-align: middle">
                                    
                                    @if($noticia->ativo == 1)
                                    <b type="radio"  class="text-center" style="color: green; ">Sim</b>
                                    @else
                                    <b  type="radio"  style="color: red; text-aling: center;">Não</b>
                                    @endif
                                </td>
                                <td style="text-align: center; vertical-align: middle">
                                    <button class="btn bg-warning text-white" style="width:40px; heigth: 40px; margin:2px">
                                        <a href="/news/editar/{{$noticia->id}}" style="color:white">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </button>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button id="createNewsletterBtn" class="btn btn-primary">Criar Newsletter</button>
                </div>
            </div>
        </div>
    </div>
</div>     
</body>
<script>

    // Aqui você pode enviar os IDs das notícias selecionadas para o servidor
        // para processá-los e criar a newsletter.
        $(document).ready(function() {
  $('#createNewsletterBtn').click(function() {
    var selectedNews = [];
    $('input[type="checkbox"]:checked').each(function() {
      var newsId = $(this).attr('id').replace('checkbox', '');
      selectedNews.push(newsId);
    });
    $.ajax({
      url: '/newsletters/create',
      method: 'POST',
      data: { newsIds: selectedNews },
      success: function(response) {
        alert('A newsletter foi criada com sucesso!');
      },
      error: function(error) {
        alert('Ocorreu um erro ao criar a newsletter. Por favor, tente novamente mais tarde.');
      }
    });
  });
});
    </script>
    
</html>