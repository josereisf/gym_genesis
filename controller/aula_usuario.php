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
$idaula = $input['idaula'] ?? null;
$idusuario = $input['idaluno'] ?? null;


if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$idaula || !$idusuario) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarAulaUsuario($idaula, $idusuario);
        if ($ok) {
            enviarResposta(true, 'Aula de usuário cadastrada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar aula de usuário');
        }
        break;

    case 'editar':
        if (!$idusuario || !$idaula || !$idusuario || !$status || !$data_aula) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarAulaUsuario($idaula, $idusuario);
        if ($ok) {
            enviarResposta(true, 'Aula de usuário editada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar aula de usuário');
        }
        break;

    case 'listar':
        $dados = listarAulaUsuario($idaula);
        if ($dados) {
            enviarResposta(true, 'Aulas de usuário listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar aulas de usuário');
        }
        break;

    case 'deletar':
        if (!$idusuario) {
            enviarResposta(false, 'ID da aula de usuário não informado');
        }
        $ok = deletarAulaUsuario($idusuario);
        if ($ok) {
            enviarResposta(true, 'Aula de usuário deletada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar aula de usuário');
        }
        break;
}
