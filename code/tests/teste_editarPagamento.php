<?php


require_once __DIR__ . '/../funcao.php';


$idpagamento = 1;
$valor = 2.99;
$data_pagamento = '2031-03-05 12:12:12';
$metodo = 'cartao';
$status = "sucesso";

if (!empty(editarPagamento($idpagamento, $valor, $data_pagamento, $metodo, $status))) {
    echo "funcionou";
}
