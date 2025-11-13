<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idavaliacao = $input['idavaliacao'] ?? null;
$peso = $input['peso'] ?? null;
$altura = $input['altura'] ?? null;
$imc = $input['imc'] ?? null;
$percentual_gordura = $input['percentual_gordura'] ?? null;
$data_avaliacao = $input['data_avaliacao'] ?? null;
$idusuario = $input['usuario_id'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$peso || !$altura || !$imc || !$percentual_gordura || !$data_avaliacao || !$idusuario) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarAvaliacaoFisica($peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $idusuario);
        if ($ok) {
            enviarResposta(true, 'Avaliação física cadastrada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar avaliação física');
        }
        break;

    case 'editar':
        if (!$idavaliacao || !$peso || !$altura || !$imc || !$percentual_gordura || !$data_avaliacao || !$idusuario) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarAvaliacaoFisica($idavaliacao, $peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $idusuario);
        if ($ok) {
            enviarResposta(true, 'Avaliação física editada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar avaliação física');
        }
        break;

    case 'listar':
        $dados = listarAvaliacaoFisica($idavaliacao);
        if ($dados) {
            enviarResposta(true, 'Avaliações físicas listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar avaliações físicas');
        }
        break;

    case 'deletar':
        if (!$idavaliacao) {
            enviarResposta(false, 'ID da avaliação não informado');
        }
        $ok = deletarAvaliacaoFisica($idavaliacao);
        if ($ok) {
            enviarResposta(true, 'Avaliação física deletada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar avaliação física');
        }
        break;
}
