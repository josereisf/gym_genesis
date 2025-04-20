<?php

require_once('../funcao.php');

$idfuncionario = 2;

if (!is_null(deletarFuncionario($idfuncionario))){
    echo 'funcionou';
}