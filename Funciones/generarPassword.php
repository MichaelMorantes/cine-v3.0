<?php
    $opciones = [
        'cost' => 12,
    ];
    $pass = $_GET["pass"];
    $passwordHashed = password_hash($pass, PASSWORD_BCRYPT, $opciones);

    echo $passwordHashed;
?>
