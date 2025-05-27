<?php

require_once('../funcao.php');
$nome = 'jao1';
$senha = '123';
$email = '1223@yahoo.com';
$cpf = '12321';
$data_nasc = '0512-10-07';
$telefone = '11122';
$foto_perfil = 'js';
$numero_matricula = 22133;
$tipo = 1;

if (!is_null(cadastrarUsuario($nome, $senha, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo))){
    echo "funcionou";
}

