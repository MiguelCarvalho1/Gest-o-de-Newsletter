<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assinante</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"/>
    <!-- Styles -->
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Inscreva-se</h2>
        <form action="/assinantes" method="POST">
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
                <input type="submit" value="Subscribe" class="submit-btn">
            </div>
        </form>
    </div>
</body>
</html>

