<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idexercicio = $input['idexercicio'] ?? null;
$nome = $input['nome'] ?? null;
$grupo_muscular = $input['grupo_muscular'] ?? null;
$video_url = $input['video_url'] ?? null;
$descricao = $input['descricao'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$nome || !$grupo_muscular || !$descricao) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarExercicio($nome, $grupo_muscular, $descricao, $video_url);
        if ($ok) {
            enviarResposta(true, 'Exercício cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar exercício');
        }
        break;

    case 'editar':
        if (!$idexercicio || !$nome || !$grupo_muscular || !$descricao) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarExercicio($idexercicio, $nome, $grupo_muscular, $descricao, $video_url);
        if ($ok) {
            enviarResposta(true, 'Exercício editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar exercício');
        }
        break;

    case 'listar':
        $dados = listarExercicio($idexercicio);
        if ($dados) {
            enviarResposta(true, 'Exercícios listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar exercícios');
        }
        break;

    case 'deletar':
        if (!$idexercicio) {
            enviarResposta(false, 'ID do exercício não informado');
        }
        $ok = deletarExercicio($idexercicio);
        if ($ok) {
            enviarResposta(true, 'Exercício deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar exercício');
        }
        break;
}
