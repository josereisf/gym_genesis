<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$iddieta = $input['iddieta'] ?? null;
$descricao = $input['descricao'] ?? null;
$data_inicio = $input['data_inicio'] ?? null;
$data_fim = $input['data_fim'] ?? null;
$idusuario = $input['idusuario'] ?? $input['usuario_id'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$descricao || !$data_inicio || !$data_fim || !$idusuario) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarDieta($descricao, $data_inicio, $data_fim, $idusuario);
        if ($ok) {
            enviarResposta(true, 'Dieta cadastrada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar dieta');
        }
        break;

    case 'editar':
        if (!$iddieta || !$descricao || !$data_inicio || !$data_fim || !$idusuario) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarDieta($descricao, $data_inicio, $data_fim, $idusuario, $iddieta);
        if ($ok) {
            enviarResposta(true, 'Dieta editada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar dieta');
        }
        break;

    case 'listar':
        $dados = listarDietas($iddieta);
        if ($dados) {
            enviarResposta(true, 'Dietas listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar dietas');
        }
        break;

    case 'deletar':
        if (!$iddieta) {
            enviarResposta(false, 'ID da dieta não informado');
        }
        $ok = deletarDieta($iddieta);
        if ($ok) {
            enviarResposta(true, 'Dieta deletada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar dieta');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
