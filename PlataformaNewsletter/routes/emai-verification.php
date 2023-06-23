<?php

$mailHost = env('MAIL_HOST');
$mailPort = env('MAIL_PORT');
Route::get('/email-verification', function () {
// Verifica se as configurações do servidor de e-mail estão definidas corretamente
if (!empty($mailHost) && !empty($mailPort)) {
    // Tente estabelecer uma conexão com o servidor de e-mail
    $connection = @fsockopen($mailHost, $mailPort, $errno, $errstr, 5);

    if ($connection) {
        echo 'Conexão com o servidor de e-mail estabelecida com sucesso.';
        fclose($connection);
    } else {
        echo 'Não foi possível estabelecer uma conexão com o servidor de e-mail.';
    }
} else {
    echo 'As configurações do servidor de e-mail não estão definidas corretamente no arquivo .env.';
}
return view('email-verification', ['result' => 'Conexão com o servidor de e-mail estabelecida com sucesso.']);

});


?>
