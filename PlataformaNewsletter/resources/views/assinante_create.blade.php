<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assinante</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-group .asterisk {
            color: red;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .tag-btn {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            margin: 5px;
            cursor: pointer;
            background-color: #ff0000; /* Cor vermelha */
            color: #fff;
            border: none; /* Remove a borda */
        }
        .tag-btn.tag-selected {
            background-color: #006400; /* Cor verde escuro quando selecionado */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Inscreva-se</h2>
    <form action="/" method="POST" id="subscriptionForm">
        @csrf
        <div class="form-group">
            <label for="email">Email: <span class="asterisk">*</span></label>
            <input type="email" value="" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" value="" name="nome" id="nome">
        </div>
        <div class="form-group">
            <label for="localidade">Endereço:</label>
            <input type="text" value="" maxlength="70" name="localidade" id="localidade">
        </div>
        <div class="form-group">
            <label for="concelho">Concelho</label>
            <input type="text" value="" maxlength="70" name="concelho" id="concelho">
        </div>
        <div class="form-group">
            <label for="pais">Pais</label>
            <input type="text" value="" maxlength="70" name="pais" id="pais">
        </div>
        <div class="form-group">
            <label for="codiPostal">Código Postal</label>
            <input type="text" value="" maxlength="10" name="codiPostal" id="codiPostal">
        </div>
        <div class="form-group">
    <h3>Suas Preferências</h3>
    <p>Selecione as tags de seu interesse:</p>
    <div class="btn-group-toggle" data-toggle="buttons">
        @foreach($tags as $tag)
            <label class="btn btn-dark">
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->nome }}
            </label>
        @endforeach
    </div>
        </div>
        <div class="form-group">
            <input type="submit" id="submitBtn" value="Inscreva-se" class="submit-btn btn btn-primary">
        </div>
    </form>
</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
    function toggleTagSelection(tag) {
        tag.classList.toggle('tag-selected');
    }

    document.getElementById('subscriptionForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Impedir o envio padrão do formulário

        // Capturar os valores do formulário
        var formData = new FormData(this);

        // Enviar uma requisição AJAX para o controlador responsável pelo processamento
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/assinantes'); // Substitua pelo URL do seu controlador
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}'); // Substitua se necessário
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Exibir a mensagem de sucesso
                var successMessage = document.createElement('div');
                successMessage.innerHTML = 'Inscrito com sucesso!';
                successMessage.style.color = 'green';
                successMessage.style.marginTop = '10px';

                var container = document.getElementsByClassName('container')[0];
                container.appendChild(successMessage);

                // Redirecionar para a página inicial após um atraso
                setTimeout(function() {
                    window.location.href = '/';
                }, 2000); // Redirecionar após 3 segundos (ajuste conforme necessário)
            }
        };

        xhr.send(new URLSearchParams(formData).toString());
    });
</script>
</body>
</html>
