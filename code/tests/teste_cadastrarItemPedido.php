<?php
require_once __DIR__ . '/../funcao.php';


$id_pedido = 1;
$id_produto = 2;
$quantidade = 3;
$preco_unitario = 10.00;

$resposta = cadastrarItemPedido($id_pedido, $id_produto, $quantidade, $preco_unitario);

if ($resposta) {
    echo "Teste de cadastro de item de pedido aprovado.";
} else {
    echo "Teste de cadastro de item de pedido reprovado.";
}
