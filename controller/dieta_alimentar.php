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
$idrefeicao = $input['idrefeicao'] ?? null;
$idalimento = $input['alimento_id'] ?? null;
$quantidade = $input['quantidade'] ?? null;
$observacao = $input['observacao'] ?? null;
$iddieta = $input['dieta_id'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$idrefeicao || !$idalimento || !$quantidade) {
            enviarResposta(false, 'Refeição, alimento e quantidade são obrigatórios');
        }
        $ok = cadastrarDietaAlimentar($idrefeicao, $idalimento, $quantidade, $observacao);
        if ($ok) {
            enviarResposta(true, 'Dieta alimentar cadastrada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar dieta alimentar');
        }
        $redir;
        break;

    case 'editar':
        if (!$idrefeicao || !$idalimento || !$quantidade) {
            enviarResposta(false, 'Refeição, alimento e quantidade são obrigatórios');
        }
        $ok = editarDietaAlimentar($idalimento, $idrefeicao, $quantidade, $observacao);
        if ($ok) {
            enviarResposta(true, 'Dieta alimentar editada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar dieta alimentar');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarDietaAlimentar($iddieta, $idalimento);
        if ($dados) {
            enviarResposta(true, 'Dietas alimentares listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar dietas alimentares');
        }
        $redir;
        break;

    case 'deletar':
        if (!$iddieta || !$idalimento) {
            enviarResposta(false, 'ID da dieta e alimento são obrigatórios');
        }
        $ok = deletarDietaAlimentar($iddieta, $idalimento);
        if ($ok) {
            enviarResposta(true, 'Dieta alimentar deletada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar dieta alimentar');
        }
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
