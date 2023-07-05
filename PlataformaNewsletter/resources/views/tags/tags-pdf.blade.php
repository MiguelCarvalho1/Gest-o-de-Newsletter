<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Lista de Tags</title>
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
        <h2 style="text-align: center;">Lista de Tags</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Tag</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->nome }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
