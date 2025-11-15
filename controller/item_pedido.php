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
$iditem = $input['iditem'] ?? null;
$pedido_id = $input['pedido_id'] ?? null;
$produto_idproduto = $input['produto_id'] ?? null;
$quantidade = $input['quantidade'] ?? null;
$preco_unitario = $input['preco_unitario'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$pedido_id || !$produto_idproduto || !$quantidade || !$preco_unitario) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarItemPedido($pedido_id, $produto_idproduto, $quantidade, $preco_unitario);
        if ($ok) {
            enviarResposta(true, 'Item do pedido cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar item do pedido');
        }
        $redir;
        break;

    case 'editar':
        if (!$iditem || !$pedido_id || !$produto_idproduto || !$quantidade || !$preco_unitario) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarItemPedido($pedido_id, $produto_idproduto, $quantidade, $preco_unitario);
        if ($ok) {
            enviarResposta(true, 'Item do pedido editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar item do pedido');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarItemPedido($pedido_id);
        if ($dados) {
            enviarResposta(true, 'Itens do pedido listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar itens do pedido');
        }
        $redir;
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
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
