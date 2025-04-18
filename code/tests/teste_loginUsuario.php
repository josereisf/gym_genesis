<?php

require_once('../funcao.php');

$email = '1223@yahoo.com';
$senha = '123';

if (!is_null($resul = loginUsuario($email, $senha))){
    echo $resul;
}