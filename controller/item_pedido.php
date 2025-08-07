<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$pedido_idpedido = $_POST['pedido_idpedido'] ?? 0;
$produto_idproduto = $_POST['produto_idproduto'] ?? 0;
$quantidade = $_POST['quantidade'] ?? null;
$preco_unitario = $_POST['preco_unitario'] ?? null;
$iditem = $_POST['iditem'] ?? 0;

switch ($acao) {
    case 'cadastrar':
        cadastrarItemPedido($pedido_idpedido, $produto_idproduto, $quantidade, $preco_unitario);
        break;
    case 'editar':
        editarItemPedido($pedido_idpedido, $produto_idproduto, $quantidade, $preco_unitario);
        break;
    case 'listar':
        listarItemPedido($pedido_idpedido);
        break;
    case 'deletar':
        deletarItemPedido($iditem);
        break;
}