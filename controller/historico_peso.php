<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idhistorico_peso = $input['idhistorico_peso'] ?? null;
$idusuario = $input['usuario_id'] ?? $input['idusuario'] ??null;
$peso = $input['peso'] ?? null;
$data_registro = $input['data_registro'] ?? null;
if ($data_registro === null) {
    $data_registro = date('Y-m-d H:i:s');
}
if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}
switch ($acao) {
    case 'cadastrar':
        $ok = cadastrarHistoricoPeso($idusuario, $peso, $data_registro);
        if ($ok) {
            enviarResposta(true, 'Histórico de peso cadastrado com sucesso', $dados = listarHistoricoPesoUltimo($idusuario));
        } else {
            enviarResposta(false, 'Erro ao cadastrar histórico de peso');
        }
        break;

    case 'editar':
        if (!$idhistorico_peso || !$peso) {
            enviarResposta(false, 'ID e peso são obrigatórios');
        }
        $ok = editarHistoricoPeso($idhistorico_peso, $peso);
        if ($ok) {
            enviarResposta(true, 'Histórico de peso editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar histórico de peso');
        }
        break;

    case 'listar':
        $dados = listarHistoricoPeso($idhistorico_peso);
        if ($dados) {
            enviarResposta(true, 'Histórico(s) de peso listado(s) com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar histórico(s) de peso');
        }
        break;

    case 'deletar':
        if (!$idhistorico_peso) {
            enviarResposta(false, 'ID do histórico de peso não informado');
        }
        $ok = deletarHistoricoPeso($idhistorico_peso);
        if ($ok) {
            enviarResposta(true, 'Histórico de peso deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar histórico de peso');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}