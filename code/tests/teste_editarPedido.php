<?php


require_once __DIR__ . '/../funcao.php';


$idusuario = 1;
$data_pedido = '2003-04-03';
$status = 'enviado';
$idpagamento = 1;

if (!empty(cadastrarPedido($idusuario, $data_pedido, $status, $idpagamento))) {
    echo "funcionou";
}
