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

$imagem = $_FILES['foto_perfil'] ?? null;
$modalidade = $input['modalidade'] ?? null;
$avaliacao_media = $input['avaliacao_media'] ?? null;
$descricao = $input['descricao'] ?? null;
$horarios_disponiveis = $input['horarios_disponiveis'] ?? null;
$telefone = $input['telefone'] ?? null;
$usuario_id = $input['usuario_id'] ?? null;
$idperfil = $input['idperfil'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['foto_perfil']);
} else {
    $imagem = $input['foto_perfil'] ?? "padrao.png";
}

switch ($acao) {
    case 'cadastrar':

        if (!empty($erros)) {
            enviarResposta(false, 'Erro no cadastro do professor: ' . implode(', ', $erros));
        } else {
            $ok = cadastrarPerfilProfessor(
                $imagem,
                $modalidade,
                $avaliacao_media,
                $descricao,
                $horarios_disponiveis,
                $telefone,
                $usuario_id
            );
            if ($ok) {
                enviarResposta(true, 'Perfil do professor cadastrado com sucesso');
            } else {
                enviarResposta(false, 'Erro ao cadastrar perfil do professor');
            }
        }
        break;

    case 'editar':

        if (!empty($erros)) {
            enviarResposta(false, 'Erro na edição do perfil: ' . implode(', ', $erros));
        } else {
            $ok = editarPerfilProfessor($idperfil, $usuario_id, $imagem, $modalidade, $avaliacao_media, $descricao, $horarios_disponiveis, $telefone);
            if ($ok) {
                enviarResposta(true, 'Perfil do professor editado com sucesso');
            } else {
                enviarResposta(false, 'Erro ao editar perfil do professor');
            }
        }
        break;

    case 'listar':
        $dados = listarPerfilProfessor($idprofessor);
        if ($dados) {
            enviarResposta(true, 'Perfis de professores listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar perfis de professores');
        }
        break;

    case 'deletar':
        if ($idprofessor) {
            $ok = deletarPerfilProfessor($idprofessor);
            if ($ok) {
                enviarResposta(true, 'Perfil do professor deletado com sucesso');
            } else {
                enviarResposta(false, 'Erro ao deletar perfil do professor');
            }
        } else {
            enviarResposta(false, 'ID do professor não fornecido');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
}
