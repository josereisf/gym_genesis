<?php

require_once __DIR__ . '/../funcao.php';

$idfuncionario = 2;

if (!is_null(deletarFuncionario($idfuncionario))){
    echo 'funcionou';
}