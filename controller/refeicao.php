<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
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
        break;

    case 'listar':
        $dados = listarRefeicoes($idrefeicao);
        if ($dados) {
            enviarResposta(true, 'Refeições listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar refeições');
        }
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
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
