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
$idpagamento = $input['idpagamento'] ?? null;
$valor = $input['valor'] ?? null;
$data_pagamento = $input['data_pagamento'] ?? null;
$metodo = $input['metodo'] ?? null;
$status = $input['status'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}
switch ($acao) {
    case 'cadastrar':
        if (!$valor || !$data_pagamento || !$metodo || !$status) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarPagamento($valor, $data_pagamento, $metodo, $status);
        if ($ok) {
            enviarResposta(true, 'Pagamento cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar pagamento');
        }
        $redir;
        break;

    case 'editar':
        if (!$idpagamento || !$valor || !$data_pagamento || !$metodo || !$status) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarPagamento($idpagamento, $valor, $data_pagamento, $metodo, $status);
        if ($ok) {
            enviarResposta(true, 'Pagamento editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar pagamento');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarPagamentos($idpagamento);
        if ($dados) {
            enviarResposta(true, 'Pagamentos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar pagamentos');
        }
        $redir;
        break;

    case 'deletar':
        if (!$idpagamento) {
            enviarResposta(false, 'ID do pagamento não informado');
        }
        $ok = deletarPagamento($idpagamento);
        if ($ok) {
            enviarResposta(true, 'Pagamento deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar pagamento');
        }
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
