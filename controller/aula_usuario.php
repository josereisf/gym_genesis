<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
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
        if (!$idaula_usuario || !$idaula || !$idusuario || !$status || !$data_aula) {
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
        if (!$idaula_usuario) {
            enviarResposta(false, 'ID da aula de usuário não informado');
        }
        $ok = deletarAulaUsuario($idaula_usuario);
        if ($ok) {
            enviarResposta(true, 'Aula de usuário deletada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar aula de usuário');
        }
        break;
}
