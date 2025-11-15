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

// Pegando corretamente os dados esperados pela função
$id = $input['id'] ?? $input['usuario_id'] ?? null; // esse é o id do usuário ou funcionário
$tipo = $input['tipo'] ?? null;

$cep = $input['cep'] ?? null;
$rua = $input['rua'] ?? null;
$numero = $input['numero'] ?? null;
$complemento = $input['complemento'] ?? null;
$bairro = $input['bairro'] ?? null;
$cidade = $input['cidade'] ?? null;
$estado = $input['estado'] ?? null;


if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        $ok = cadastrarEndereco($id, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $tipo);
        if ($ok) {
            enviarResposta(true, 'Endereço cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar endereço');
        }
        $redir;
        break;

    case 'editar':
        $ok = editarEndereco($cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $tipo, $id);
        if ($ok) {
            enviarResposta(true, 'Endereço editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar endereço');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarEnderecos($tipo);
        if ($dados) {
            enviarResposta(true, 'Endereços listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar endereços');
        }
        $redir;
        break;

    case 'deletar':
        $ok = deletarEndereco($id, $tipo);
        if ($ok) {
            enviarResposta(true, 'Endereço deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar endereço');
        }
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
}
