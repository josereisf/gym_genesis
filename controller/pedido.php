<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idpedido = $_POST['idpedido'] ?? 0;
$usuario_idusuario = $_POST['usuario_idusuario'] ?? null;
$data_pedido = $_POST['data_pedido'] ?? null;
$status = $_POST['status'] ?? null;
$pagamento_idpagamento = $_POST['pagamento_idpagamento'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarPedido($usuario_idusuario, $data_pedido, $status, $pagamento_idpagamento);
        break;
    case 'editar':
        editarPedido($idpedido, $usuario_idusuario, $data_pedido, $status);
        break;
    case 'listar':
        listarPedidos($idpedido);
        break;
    case 'deletar':
        deletarPedido($idpedido);
        break;
}