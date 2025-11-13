<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_GET['acao'] ?? null;

// 🔹 Lê JSON do corpo da requisição
$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idusuario        = $input['idusuario'] ?? 0;
$nome             = $input['nome'] ?? null;
$cpf              = $input['cpf'] ?? null;
$data_nasc        = $input['data_nascimento'] ?? null;
$telefone         = $input['telefone'] ?? null;
$tipo             = $input['tipo'] ?? 1; 
$imagem = $_FILES['imagem'] ?? $_FILES['foto_perfil'] ?? null; // <- aqui vem o arquivo de verdade

// 🔹 Processamento da imagem
if (!$imagem || $imagem['error'] != 0) {
    $nomeImagem = 'padrao.png';
} else {
    $resultadoUpload = uploadImagem($imagem);

    if (is_array($resultadoUpload)) {
        if (isset($resultadoUpload['erro'])) {
            die(json_encode(['error' => "Erro ao salvar imagem: {$resultadoUpload['erro']}"]));
        } elseif (isset($resultadoUpload['warning'])) {
            $nomeImagem = $resultadoUpload['nome_arquivo'] ?? 'padrao.png';
        } else {
            die(json_encode(['error' => 'Retorno inesperado da função uploadImagem']));
        }
    } else {
        $nomeImagem = $resultadoUpload;
    }
}

$numero_matricula = $tipo ? gerarNumeroMatriculaPorTipo($tipo) : null;

// 🔹 Verifica ação
if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        $funcionou = cadastrarPerfilUsuario(
            $idusuario,
            $nome,
            $cpf,
            $data_nasc,
            $telefone,
            $numero_matricula,
            $nomeImagem // aqui vai o nome da imagem, não o base64
        );

        if ($funcionou) {
            enviarResposta(true, 'Usuário cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar usuário');
        }
        break;

    case 'editar':
        $funcionou = editarPerfilUsuario(
            $idusuario,
            $nome,
            $cpf,
            $data_nasc,
            $telefone,
            $nomeImagem // idem aqui
        );

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
