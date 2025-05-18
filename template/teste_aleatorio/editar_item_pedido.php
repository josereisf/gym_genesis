<?php
header('Content-Type: application/json');
require_once '../../code/funcao.php'; // ajuste caminho conforme seu projeto

$dados = json_decode(file_get_contents('php://input'), true);

$pedido_idpedido = $dados['pedido_idpedido'] ?? null;
$produto_idproduto = $dados['produto_idproduto'] ?? null;
$campo = $dados['campo'] ?? null;
$novo_valor = $dados['novo_valor'] ?? null;

if (!$pedido_idpedido || !$produto_idproduto || !$campo || $novo_valor === null) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit;
}

$camposPermitidos = ['quantidade', 'preco_unitario'];
if (!in_array($campo, $camposPermitidos)) {
    echo json_encode(['success' => false, 'message' => 'Campo inválido']);
    exit;
}

// Aqui só para teste vamos fingir que atualizou com sucesso
// Você pode colocar o código para atualizar no banco aqui

echo json_encode(['success' => true]);
