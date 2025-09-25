<?php

require_once __DIR__ . "/../code/funcao.php";

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    $input = $_POST;
}

$idresposta = $input['idresposta'] ?? null;
$mensagem   = $input['mensagem']   ?? null;
$usuario_id = $input['usuario_id'] ?? null;
$forum_id   = $input['forum_id']   ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        $ok = cadastrarRespostaForum($mensagem, $usuario_id, $forum_id);
        if ($ok) {
            enviarResposta(true, 'Resposta do fórum cadastrada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar resposta do fórum');
        }
        break;

    case 'editar':
        if (!$idresposta || !$mensagem || !$usuario_id || !$forum_id) {
            enviarResposta(false, 'ID, mensagem, usuário e fórum são obrigatórios');
        }
        $ok = editarRespostaForum($idresposta, $mensagem, $usuario_id, $forum_id);
        if ($ok) {
            enviarResposta(true, 'Resposta do fórum editada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar resposta do fórum');
        }
        break;

    case 'listar':
        $dados = listarRespostaForum($idresposta);
        if ($dados) {
            enviarResposta(true, 'Respostas do fórum listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar respostas do fórum');
        }
        break;

    case 'deletar':
        if (!$idresposta) {
            enviarResposta(false, 'ID da resposta não informado');
        }
        $ok = deletarRespostaForum($idresposta);
        if ($ok) {
            enviarResposta(true, 'Resposta do fórum deletada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar resposta do fórum');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}

?>