<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idpagamento = $input['idpagamento'] ?? null;
$usuario_idusuario = $input['usuario_idusuario'] ?? null;
$valor = $input['valor'] ?? null;
$data_pagamento = $input['data_pagamento'] ?? null;
$metodo = $input['metodo'] ?? null;
$status = $input['status'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$usuario_idusuario || !$valor || !$data_pagamento || !$metodo || !$status) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarPagamento($usuario_idusuario, $valor, $data_pagamento, $metodo, $status);
        if ($ok) {
            enviarResposta(true, 'Pagamento cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar pagamento');
        }
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
        break;

    case 'listar':
        $dados = listarPagamentos($idpagamento);
        if ($dados) {
            enviarResposta(true, 'Pagamentos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar pagamentos');
        }
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
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
