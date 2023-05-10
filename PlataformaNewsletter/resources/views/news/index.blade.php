
@section('title', 'News')



<div class="row">
    @if(session("msg"))
    <p class="msg" style="background-color: #d4edda;
                                            color: #155724;
                                            border: 1px solid #c3e6cb;
                                            width: 100%;
                                            margin-bottom: 0;
                                            text-align: center;
                                            padding: 10px;
                                            margin:10px;">
        {{session('msg')}}
    </p>
    @endif
</div>

<h1>Notícias</h1>
<div class="card-body">
    <div>
        <button class="btn btn-primary" style="margin-top:-5px; margin-left:10px"><a href="/dashboard" class="text-white">Voltar</a></button>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead style="text-align: center;">
                <tr>
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
                    <td style="text-align: justify; vertical-align: middle"><a href="/noticia/editar/{{$noticia->id}}">{{$noticia->titulo}}</td>
                    <td style="text-align: justify; vertical-align: middle">{{ Str::limit($noticia-> conteudo, 100) }}</td>
                    
                    <td style="text-align: center; vertical-align: middle"><img src="/img/noticia/{{$noticia->media}}" style="width: 75px;"></img></td>
                    
                    <td style="text-align: center; vertical-align: middle">
                        
                        @if($noticia->ativo == 1)
                        <b type="radio"  class="text-center" style="color: green; ">Sim</b>
                        @else
                        <b  type="radio"  style="color: red; text-aling: center;">Não</b>
                        @endif
                    </td>
                    <td style="text-align: center; vertical-align: middle">
                        <button class="btn bg-warning text-white" style="width:40px; heigth: 40px; margin:2px"><a href="/noticia/editar/{{$noticia->titulo}}" style="color:white"><i class="fa fa-edit"></i></a></button>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
