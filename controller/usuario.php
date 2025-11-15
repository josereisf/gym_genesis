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
$idusuario = $input['idusuario'] ?? 0;
$senha = $input['senha'] ?? null;
$email = $input['email'] ?? null;
$tipo = $input['tipo'] ?? $input['tipo_usuario'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        $resultado = cadastrarUsuario($senha, $email, $tipo);
        if ($resultado['success'] == true) {
            enviarResposta(true, 'Usuário cadastrado com sucesso', ['id' => $resultado['id']]);
        } else {
            enviarResposta(false, 'Erro ao cadastrar usuário');
        }
        break;

    case 'editar':
        $funcionou = editarUsuario($senha, $email, $tipo, $idusuario);
        if ($funcionou) {
            enviarResposta(true, 'Usuário editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar usuário');
        }
        break;
    case 'listar':
        $resultado = listarUsuario($idusuario);
        if ($resultado !== false) {
            enviarResposta(true, 'Usuário listado', $resultado);
        } else {
            enviarResposta(false, 'Erro ao listar usuário');
        }
        break;

    case 'deletar':
        $funcionou = deletarUsuario($idusuario);
        if ($funcionou) {
            enviarResposta(true, 'Usuário deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar usuário');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
}
