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
$idpagamento2 = $input['idpagamento2'] ?? null;
$pagamento_id = $input['pagamento_id'] ?? null;
$tipo = $input['tipo'] ?? null;
$bandeira_cartao = $input['bandeira_cartao'] ?? null;
$ultimos_digitos = $input['ultimos_digitos'] ?? null;
$codigo_pix = $input['codigo_pix'] ?? null;
$linha_digitavel_boleto = $input['linha_digitavel_boleto'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$pagamento_id || !$tipo) {
            enviarResposta(false, 'Pagamento e tipo são obrigatórios');
        }
        $ok = cadastrarPagamentoDetalhe($pagamento_id, $tipo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto);
        if ($ok) {
            enviarResposta(true, 'Detalhe do pagamento cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar detalhe do pagamento');
        }
        $redir;
        break;

    case 'editar':
        if (!$idpagamento2 || !$pagamento_id || !$tipo) {
            enviarResposta(false, 'ID, pagamento e tipo são obrigatórios');
        }
        $ok = editarPagamentoDetalhe($idpagamento2, $pagamento_id, $tipo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto);
        if ($ok) {
            enviarResposta(true, 'Detalhe do pagamento editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar detalhe do pagamento');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarPagamentosDetalhados($idpagamento2);
        if ($dados) {
            enviarResposta(true, 'Detalhes do pagamento listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar detalhes do pagamento');
        }
        $redir;
        break;

    case 'deletar':
        if (!$idpagamento2) {
            enviarResposta(false, 'ID do detalhe do pagamento não informado');
        }
        $ok = deletarPagamentoDetalhe($idpagamento2);
        if ($ok) {
            enviarResposta(true, 'Detalhe do pagamento deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar detalhe do pagamento');
        }
        $redir;
        break;
}
