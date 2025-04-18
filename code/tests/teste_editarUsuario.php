<?php

require_once('../funcao.php');
$nome = 'jao1';
$senha = '123';
$email = '123@yahoo.com';
$cpf = '123';
$data_nasc = '2512-10-07';
$telefone = '11122';
$foto_perfil = 'js';
$numero_matricula = 22133;
$tipo = 1;
$idusuario= 1;

if (!is_null(editarUsuario($nome, $senha, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo, $idusuario))){
    echo "funcionou";
}

