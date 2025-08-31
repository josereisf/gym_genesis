<?php

require_once __DIR__ . '/../funcao.php';
$senha = '123';
$email = '123@yahoo.com';
$tipo = 1;
$idusuario= 1;

if (!is_null(editarUsuario($senha, $email, $tipo, $idusuario))){
    echo "funcionou";
}

