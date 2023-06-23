<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Tags</title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
                <a class="nav-link" href="{{ url('/newsletters') }}">Newsletters</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/news') }}">News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/news/selecionar') }}">Create Newsletter</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    <body>
      <div class="container-fluid">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Lista de Tags</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="100">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)
                                <tr>
                                    <td>{{ $tag->id }}</td>
                                    <td>{{ $tag->nome }}</td>
                                    <td style="text-align: center; vertical-align: middle">
                                        <a href="/tags/edit/{{$tag->id}}" class="btn btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle">
                                        <form action="/tags/{{$tag->id}}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>



