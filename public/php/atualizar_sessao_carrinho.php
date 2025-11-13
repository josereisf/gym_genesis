<?php
session_start();
require_once __DIR__ . '/../../code/funcao.php'; // ajuste o caminho se necessário

if (!isset($_POST['id']) || !isset($_POST['quantidade'])) {
    http_response_code(400);
    echo json_encode(['erro' => 'Dados inválidos']);
    exit;
}

$id = (int)$_POST['id'];
$qtd = max(1, (int)$_POST['quantidade']);

// Atualiza a quantidade do produto
$_SESSION['carrinho'][$id] = $qtd;

// Recalcula o total da compra
$subtotalCompra = 0;
foreach ($_SESSION['carrinho'] as $produtoId => $quantidade) {
    $resultado = listarProdutos($produtoId);
    if ($resultado && isset($resultado[0]['preco'])) {
        $subtotalCompra += $resultado[0]['preco'] * $quantidade;
    }
}

// Atualiza o valor total na sessão
$_SESSION['compra'] = $subtotalCompra;

echo json_encode([
    'status' => 'ok',
    'compra' => number_format($subtotalCompra, 2, ',', '.')
]);
