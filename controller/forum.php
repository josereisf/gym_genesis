<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idtopico = $input['idtopico'] ?? null;
$titulo = $input['titulo'] ?? null;
$descricao = $input['descricao'] ?? null;
$usuario_idusuario = $input['usuario_idusuario'] ?? $input['usuario_id'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}
switch ($acao) {
    case 'cadastrar':
        if (!$titulo || !$descricao || !$usuario_idusuario) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarForum($titulo, $descricao, $usuario_idusuario);
        if ($ok) {
            enviarResposta(true, 'Tópico do fórum cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar tópico do fórum');
        }
        break;

    case 'editar':
        if (!$idtopico || !$titulo || !$descricao) {
            enviarResposta(false, 'ID, título e descrição são obrigatórios');
        }
        $ok = editarForum($idtopico, $titulo, $descricao);
        if ($ok) {
            enviarResposta(true, 'Tópico do fórum editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar tópico do fórum');
        }
        break;

    case 'listar':
        $dados = listarForum($idtopico);
        if ($dados) {
            enviarResposta(true, 'Tópicos do fórum listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar tópicos do fórum');
        }
        break;

    case 'deletar':
        if (!$idtopico) {
            enviarResposta(false, 'ID do tópico não informado');
        }
        $ok = deletarForum($idtopico);
        if ($ok) {
            enviarResposta(true, 'Tópico do fórum deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar tópico do fórum');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
