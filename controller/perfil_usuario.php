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
$idusuario        = $input['idusuario'] ?? null;
$nome             = $input['nome'] ?? null;
$cpf              = $input['cpf'] ?? null;
$data_nasc        = $input['data_nascimento'] ?? null;
$telefone         = $input['telefone'] ?? null;
$tipo             = $input['tipo'] ?? 1;
$imagem = $_FILES['imagem'] ?? $_FILES['foto_perfil'] ?? null;
$usuario_id = $input['usuario_id'] ?? null;


if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['foto_perfil']);
} else {
    $imagem = $input['foto_perfil'] ?? "padrao.png";
}

$numero_matricula = $tipo ? gerarNumeroMatriculaPorTipo($tipo) : null;

// 🔹 Verifica ação
if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        $funcionou = cadastrarPerfilUsuario(
            $usuario_id,
            $nome,
            $cpf,
            $data_nasc,
            $telefone,
            $numero_matricula,
            $imagem // aqui vai o nome da imagem, não o base64
        );

        if ($funcionou) {
            enviarResposta(true, 'Usuário cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar usuário');
        }
        $redir;
        break;

    case 'editar':
        $funcionou = editarPerfilUsuario(
            $usuario_id,
            $nome,
            $data_nasc,
            $telefone,
            $imagem // idem aqui
        );

        if ($funcionou) {
            enviarResposta(true, 'Usuário editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar usuário');
        }
        $redir;
        break;

    case 'listar':
        $resultado = listarPerfilUsuario($idusuario);
        if ($resultado !== false) {
            enviarResposta(true, 'Usuário listado', $resultado);
        } else {
            enviarResposta(false, 'Erro ao listar usuário');
        }
        $redir;
        break;

    case 'deletar':
        $funcionou = deletarPerfilUsuario($idusuario);
        if ($funcionou) {
            enviarResposta(true, 'Usuário deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar usuário');
        }
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
}
