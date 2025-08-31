<?php


require_once __DIR__ . '/../funcao.php';


$idusuario = 1;
$data_pedido = '2003-04-03';
$status = 'enviado';
$idpagamento = 1;

$resultado = listarPedidos($idusuario);

var_dump($resultado);