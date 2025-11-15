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
$idcategoria = $input['idcategoria'] ?? null;
$nome = $input['nome'] ?? null;
$descricao = $input['descricao'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$nome || !$descricao) {
            enviarResposta(false, 'Nome e descrição são obrigatórios');
        }
        $ok = cadastrarCategoriaProduto($nome, $descricao);
        if ($ok) {
            enviarResposta(true, 'Categoria cadastrada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar categoria');
        }
        break;

    case 'editar':
        if (!$idcategoria || !$nome || !$descricao) {
            enviarResposta(false, 'ID, nome e descrição são obrigatórios');
        }
        $ok = editarCategoriaProduto($idcategoria, $nome, $descricao);
        if ($ok) {
            enviarResposta(true, 'Categoria editada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar categoria');
        }
        break;

    case 'listar':
        $dados = listarCategoriaProduto($idcategoria);
        if ($dados) {
            enviarResposta(true, 'Categorias listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar categorias');
        }
        break;

    case 'deletar':
        if (!$idcategoria) {
            enviarResposta(false, 'ID da categoria não informado');
        }
        $ok = deletarCategoriaProduto($idcategoria);
        if ($ok) {
            enviarResposta(true, 'Categoria deletada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar categoria');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
