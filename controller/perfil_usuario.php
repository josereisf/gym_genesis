<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_GET['acao'] ?? null;

// Como você está recebendo dados JSON no fetch, não use $_POST direto,
// leia o raw input e decodifique JSON:
$input = json_decode(file_get_contents('php://input'), true);

$idusuario       = $input['idusuario'] ?? 0;
$nome            = $input['nome'] ?? null;
$cpf             = $input['cpf'] ?? null;
$data_nasc       = $input['data_nascimento'] ?? null;
$telefone        = $input['telefone'] ?? null;
$tipo            = $input['tipo'] ?? 1; // adicionado
$numero_matricula = $tipo ? gerarNumeroMatriculaPorTipo($tipo) : null;

// Supondo que a imagem vai vir como string base64 no JSON
$imagem = $input['imagem'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        $funcionou = cadastrarPerfilUsuario($idusuario, $nome, $cpf, $data_nasc, $telefone,$numero_matricula, $imagem);
        if ($funcionou) {
            enviarResposta(true, 'Usuário cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar usuário');
        }
        break;

    case 'editar':
        $funcionou = editarPerfilUsuario($idusuario, $nome, $cpf, $data_nasc, $telefone, $imagem);
        if ($funcionou) {
            enviarResposta(true, 'Usuário editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar usuário');
        }
        break;

    case 'listar':
        $resultado = listarPerfilUsuario($idusuario);
        if ($resultado !== false) {
            enviarResposta(true, 'Usuário listado', $resultado);
        } else {
            enviarResposta(false, 'Erro ao listar usuário');
        }
        break;

    case 'deletar':
        $funcionou = deletarPerfilUsuario($idusuario);
        if ($funcionou) {
            enviarResposta(true, 'Usuário deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar usuário');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
}
