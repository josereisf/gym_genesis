<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
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
        break;

    case 'listar':
        $dados = listarCargo($idcargo);
        if ($dados) {
            enviarResposta(true, 'Cargos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar cargos');
        }
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
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
