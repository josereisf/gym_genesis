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

// Variáveis recebidas
$idtopico = $input['idtopico'] ?? null;
$titulo = $input['titulo'] ?? null;
$descricao = $input['descricao'] ?? null;
$usuario_idusuario = $input['usuario_idusuario'] ?? $input['usuario_id'] ?? null;

// Ação obrigatória
if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

// Executar ação
switch ($acao) {

    case 'cadastrar':
        if (!$titulo || !$descricao || !$usuario_idusuario) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarForum($titulo, $descricao, $usuario_idusuario);
        enviarResposta($ok, $ok ? 'Tópico do fórum cadastrado com sucesso' : 'Erro ao cadastrar tópico do fórum');
        $redir;
        break;

    case 'editar':
        if (!$idtopico || !$titulo || !$descricao) {
            enviarResposta(false, 'ID, título e descrição são obrigatórios');
        }
        $ok = editarForum($idtopico, $titulo, $descricao);
        enviarResposta($ok, $ok ? 'Tópico do fórum editado com sucesso' : 'Erro ao editar tópico do fórum');
        $redir;
        break;

    case 'listar':
        $dados = listarForum($idtopico);
        if ($dados) {
            enviarResposta(true, 'Tópicos do fórum listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar tópicos do fórum');
        }
        $redir;
        break;

    case 'deletar':
        if (!$idtopico) {
            enviarResposta(false, 'ID do tópico não informado');
        }
        $ok = deletarForum($idtopico);
        enviarResposta($ok, $ok ? 'Tópico do fórum deletado com sucesso' : 'Erro ao deletar tópico do fórum');
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
}
