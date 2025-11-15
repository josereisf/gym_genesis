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
$tipo = $input['tipo'] ?? null;
$horario = $input['horario'] ?? null;
$iddieta = $input['dieta_id'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$iddieta || !$tipo || !$horario) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarRefeicao($iddieta, $tipo, $horario);
        if ($ok) {
            enviarResposta(true, 'Refeição cadastrada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar refeição');
        }
        $redir;
        break;

    case 'editar':
        if (!$idrefeicao || !$iddieta || !$tipo || !$horario) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarRefeicao($idrefeicao, $iddieta, $tipo, $horario);
        if ($ok) {
            enviarResposta(true, 'Refeição editada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar refeição');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarRefeicoes($idrefeicao);
        if ($dados) {
            enviarResposta(true, 'Refeições listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar refeições');
        }
        $redir;
        break;

    case 'deletar':
        if (!$idrefeicao) {
            enviarResposta(false, 'ID da refeição não informado');
        }
        $ok = deletarRefeicao($idrefeicao);
        if ($ok) {
            enviarResposta(true, 'Refeição deletada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar refeição');
        }
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
