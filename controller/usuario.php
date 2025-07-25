<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_GET['acao'] ?? null;

// Como você está recebendo dados JSON no fetch, não use $_POST direto,
// leia o raw input e decodifique JSON:
$input = json_decode(file_get_contents('php://input'), true);

$idusuario = $input['idusuario'] ?? 0;
$nome = $input['nome'] ?? null;
$senha = $input['senha'] ?? null;
$email = $input['email'] ?? null;
$cpf = $input['cpf'] ?? null;
$data_nasc = $input['data_nascimento'] ?? null;
$telefone = $input['telefone'] ?? null;
$tipo = $input['tipo'] ?? null;
$numero_matricula = gerarNumeroMatriculaPorTipo($tipo);

// Supondo que a imagem vai vir como string base64 no JSON, trate aqui
$imagem = $input['imagem'] ?? null;


if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        $resultado = cadastrarUsuario($nome, $senha, $email, $cpf, $data_nasc, $telefone, $imagem, $numero_matricula, $tipo);
    
    if ($resultado['success'] == true) {
        enviarResposta(true, 'Usuário cadastrado com sucesso', ['id' => $resultado['id']]);
    } else {
        enviarResposta(false, 'Erro ao cadastrar usuário');
    }
    break;

    case 'editar':
        $funcionou = editarUsuario($nome, $senha, $email, $cpf, $data_nasc, $telefone, $imagem, $numero_matricula, $tipo, $idusuario);
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
