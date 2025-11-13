<?php 
require_once __DIR__ . '/../code/funcao.php';
session_start();
$idusuario = $_SESSION['id'];
$valor = $_SESSION['compra'];
$data_pagamento = $_POST['data_pagamento'] ?? date('Y-m-d H:i:s');
$metodo = $_POST['tipo'];
$status = $_POST['status'] ?? "sucesso";

$pagamento_id = cadastrarPagamento($valor, $data_pagamento, $metodo, $status);

$bandeira_cartao = $_POST['bandeira_cartao'] ?? null;
$ultimos_digitos = $_POST['ultimos_digitos'] ?? null;
$codigo_pix = $_POST['codigo_pix'] ?? null;
$linha_digitavel_boleto = $_POST['linha_digitavel_boleto'] ?? null;

cadastrarPagamentoDetalhe($pagamento_id, $metodo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto);

$items = $_SESSION['carrinho'];
foreach ($items AS $id => $quantidade) {
    $preco_unitario = listarProdutos($produto_id);

    cadastrarItemPedido($pagamento_id, $id, $preco_unitario[0]['preco'], $quantidade);
}
?>