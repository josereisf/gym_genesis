<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idtreino = $input['idtreino'] ?? null;
$tipo = $input['tipo'] ?? null;
$horario = $input['horario'] ?? null;
$descricao = $input['descricao'] ?? null;
$idusuario = $input['idusuario'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$tipo || !$horario || !$descricao || !$idusuario) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarTreino($tipo, $horario, $descricao, $idusuario);
        if ($ok) {
            enviarResposta(true, 'Treino cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar treino');
        }
        break;

    case 'editar':
        if (!$idtreino || !$tipo || !$horario || !$descricao) {
            enviarResposta(false, 'ID, tipo, horário e descrição são obrigatórios');
        }
        $ok = editarTreino($tipo, $horario, $descricao, $idtreino);
        if ($ok) {
            enviarResposta(true, 'Treino editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar treino');
        }
        break;

    case 'listar':
        $dados = listarTreino($idtreino);
        if ($dados) {
            enviarResposta(true, 'Treinos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar treinos');
        }
        break;

    case 'deletar':
        if (!$idtreino) {
            enviarResposta(false, 'ID do treino não informado');
        }
        $ok = deletarTreino($idtreino);
        if ($ok) {
            enviarResposta(true, 'Treino deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar treino');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
