<?php

require_once __DIR__ . '/../funcao.php';
$senha = '123456';
$email = 'pablo.todrigues1@estudante.ifgoiano.edu.br';
$tipo = 1;
$idusuario= 42;

if (!is_null(editarUsuario($senha, $email, $tipo, $idusuario))){
    echo "funcionou";
}

