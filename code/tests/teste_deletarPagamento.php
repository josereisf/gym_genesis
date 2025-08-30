<?php


require_once __DIR__ . '/../funcao.php';


$idpagamento = 2;

if (!empty(deletarPagamento($idpagamento))) {
    echo "funcionou";
}
