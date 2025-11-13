<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
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
        break;

    case 'listar':
         $dados = listarDietaAlimentar($iddieta, $idalimento);
         if ($dados) {
             enviarResposta(true, 'Dietas alimentares listadas com sucesso', $dados);
         } else {
             enviarResposta(false, 'Erro ao listar dietas alimentares');
         }
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
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
