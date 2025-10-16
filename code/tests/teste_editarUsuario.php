<?php

require_once __DIR__ . '/../funcao.php';
$senha = '123456';
$email = 'lucas.silva@ex.com';
$tipo = 1;
$idusuario= 1;

if (!is_null(editarUsuario($senha, $email, $tipo, $idusuario))){
    echo "funcionou";
}

