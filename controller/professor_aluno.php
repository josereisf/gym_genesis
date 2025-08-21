<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idprofessor_aluno = $input['idprofessor_aluno'] ?? null;
$idprofessor = $input['idprofessor'] ?? null;
$idaluno = $input['idaluno'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$idprofessor || !$idaluno) {
            enviarResposta(false, 'Professor e aluno são obrigatórios');
        }
        $ok = cadastrarProfessorAluno($idprofessor, $idaluno);
        if ($ok) {
            enviarResposta(true, 'Relação cadastrada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar relação');
        }
        break;

    case 'editar':
        if (!$idprofessor_aluno || !$idprofessor || !$idaluno) {
            enviarResposta(false, 'ID, professor e aluno são obrigatórios');
        }
        $ok = editarProfessorAluno($idprofessor_aluno, $idprofessor, $idaluno);
        if ($ok) {
            enviarResposta(true, 'Relação editada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar relação');
        }
        break;

    case 'listar':
        $dados = listarProfessorAluno($idprofessor_aluno);
        if ($dados) {
            enviarResposta(true, 'Relações listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar relações');
        }
        break;

    case 'deletar':
        if (!$idprofessor_aluno) {
            enviarResposta(false, 'ID da relação não informado');
        }
        $ok = deletarProfessorAluno($idprofessor_aluno);
        if ($ok) {
            enviarResposta(true, 'Relação deletada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar relação');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
