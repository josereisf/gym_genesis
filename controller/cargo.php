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
$idcargo = $input['idcargo'] ?? null;
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
        $ok = cadastrarCargo($nome, $descricao);
        if ($ok) {
            enviarResposta(true, 'Cargo cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar cargo');
        }
        $redir;
        break;

    case 'editar':
        if (!$idcargo || !$nome || !$descricao) {
            enviarResposta(false, 'ID, nome e descrição são obrigatórios');
        }
        $ok = editarCargo($idcargo, $nome, $descricao);
        if ($ok) {
            enviarResposta(true, 'Cargo editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar cargo');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarCargo($idcargo);
        if ($dados) {
            enviarResposta(true, 'Cargos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar cargos');
        }
        $redir;
        break;

    case 'deletar':
        if (!$idcargo) {
            enviarResposta(false, 'ID do cargo não informado');
        }
        $ok = deletarCargo($idcargo);
        if ($ok) {
            enviarResposta(true, 'Cargo deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar cargo');
        }
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
