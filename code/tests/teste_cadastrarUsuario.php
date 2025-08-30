<?php

require_once __DIR__ . '/../funcao.php';

$senha = '123';
$email = '1223@yahoo.com';
$tipo = 1;

if (!is_null(cadastrarUsuario($senha, $email, $tipo))){
    echo "funcionou";
}

