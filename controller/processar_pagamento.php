<?php 
require_once __DIR__ . '/../code/funcao.php';
$idusuario = $_SESSION['id'] ?? null;
$usuario_idusuario = $_POST['usuario_idusuario'] ?? null;
$valor = $_POST['valor'] ?? null;
$data_pagamento = $_POST['data_pagamento'] ?? null;
$metodo = $_POST['metodo'] ?? null;
$status = $_POST['status'] ?? "sucesso";

$pagamento_id = cadastrarPagamento($valor, $data_pagamento, $metodo, $status);

$bandeira_cartao = $_POST['bandeira_cartao'] ?? null;
$ultimos_digitos = $_POST['ultimos_digitos'] ?? null;
$codigo_pix = $_POST['codigo_pix'] ?? null;
$linha_digitavel_boleto = $_POST['linha_digitavel_boleto'] ?? null;

cadastrarPagamentoDetalhe($pagamento_id, $metodo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto);

$items = $_SESSION['carrinho'];
?>