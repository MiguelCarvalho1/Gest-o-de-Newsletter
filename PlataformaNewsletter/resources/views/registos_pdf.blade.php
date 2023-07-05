<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Registos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">Registos</h2>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="100">
            <thead style="text-align: center;">
                <tr>
                    <th>Utilizador</th>
                    <th>Newsletters Criadas</th>
                    <th>Notícias Criadas</th>
                    <th>Newsletters Enviadas</th>
                    <th>Newsletters Recebidas</th>
                    <th>Tags Utilizadas (Notícias)</th>
                    <th>Tags Utilizadas (Newsletters)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $registro)
                    <tr>
                        <td>{{ $registro->user->name }}</td>
                        <td>{{ $registro->newsletter_count }}</td>
                        <td>{{ $registro->news_count }}</td>
                        <td>{{ $registro->newsletter_enviadas }}</td>
                        <td>{{ $registro->newsletter_recebidas }}</td>
                        <td>{{ $registro->tags_utilizadas_noticias }}</td>
                        <td>{{ $registro->tags_utilizadas_newsletters }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
