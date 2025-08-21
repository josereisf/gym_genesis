<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$iditem = $input['iditem'] ?? null;
$pedido_idpedido = $input['pedido_idpedido'] ?? null;
$produto_idproduto = $input['produto_idproduto'] ?? null;
$quantidade = $input['quantidade'] ?? null;
$preco_unitario = $input['preco_unitario'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$pedido_idpedido || !$produto_idproduto || !$quantidade || !$preco_unitario) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarItemPedido($pedido_idpedido, $produto_idproduto, $quantidade, $preco_unitario);
        if ($ok) {
            enviarResposta(true, 'Item do pedido cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar item do pedido');
        }
        break;

    case 'editar':
        if (!$iditem || !$pedido_idpedido || !$produto_idproduto || !$quantidade || !$preco_unitario) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarItemPedido($pedido_idpedido, $produto_idproduto, $quantidade, $preco_unitario);
        if ($ok) {
            enviarResposta(true, 'Item do pedido editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar item do pedido');
        }
        break;

    case 'listar':
        $dados = listarItemPedido($pedido_idpedido);
        if ($dados) {
            enviarResposta(true, 'Itens do pedido listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar itens do pedido');
        }
        break;

    case 'deletar':
        if (!$iditem) {
            enviarResposta(false, 'ID do item não informado');
        }
        $ok = deletarItemPedido($iditem);
        if ($ok) {
            enviarResposta(true, 'Item do pedido deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar item do pedido');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
