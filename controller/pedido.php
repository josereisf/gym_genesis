<?php
require_once __DIR__ . '/../code/funcao.php';
$tabela = $_REQUEST['entidade'] ?? null;
$acao = $_REQUEST['acao'] ?? null;

// Detectar se é AJAX/fetch enviando JSON
$isJson = isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false;

// Ler inputs
if ($isJson) {
    header('Content-Type: application/json; charset=utf-8');
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
} else {
    $input = $_POST;

    $redir = header("Location: /public/sucesso.php?tabela=$tabela");
}
$idpedido = $input['idpedido'] ?? null;
$usuario_idusuario = $input['usuario_id'] ?? null;
$data_pedido = $input['data_pedido'] ?? null;
$status = $input['status'] ?? null;
$pagamento_id = $input['pagamento_id'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$usuario_idusuario || !$data_pedido || !$status || !$pagamento_id) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarPedido($usuario_idusuario, $data_pedido, $status, $pagamento_id);
        if ($ok) {
            enviarResposta(true, 'Pedido cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar pedido');
        }
        break;

    case 'editar':
        if (!$idpedido || !$usuario_idusuario || !$data_pedido || !$status) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarPedido($idpedido, $usuario_idusuario, $data_pedido, $status);
        if ($ok) {
            enviarResposta(true, 'Pedido editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar pedido');
        }
        break;

    case 'listar':
        $dados = listarPedidos($idpedido);
        if ($dados) {
            enviarResposta(true, 'Pedidos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar pedidos');
        }
        break;

    case 'deletar':
        if (!$idpedido) {
            enviarResposta(false, 'ID do pedido não informado');
        }
        $ok = deletarPedido($idpedido);
        if ($ok) {
            enviarResposta(true, 'Pedido deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar pedido');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
