<?php


require_once '../funcao.php';

$idpagamento = 2;

if (!empty(deletarPagamento($idpagamento))){
    echo "funcionou";
}