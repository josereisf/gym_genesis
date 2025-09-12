<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;
$input = json_decode(file_get_contents('php://input'), true);

$foto_perfil = $input['foto_perfil'] ?? null;
$experiencia_anos = $input['experiencia_anos'] ?? null;
$modalidade = $input['modalidade'] ?? null;
$avaliacao_media = $input['avaliacao_media'] ?? null;
$descricao = $input['descricao'] ?? null;
$horarios_disponiveis = $input['horarios_disponiveis'] ?? null;
$telefone = $input['telefone'] ?? null;
$usuario_id = $input['usuario_id'] ?? null;
$nome = $input['nome'] ?? null;
$email = $input['email'] ?? null;
$especialidade = $input['especialidade'] ?? null;
$idprofessor = $input['idprofessor'] ?? null;
$idperfil = $input['idperfil'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        $erros = [];
        if (!$nome) $erros[] = 'Nome não informado';
        if (!$email) $erros[] = 'Email não informado';
        if (!$especialidade) $erros[] = 'Especialidade não informada';

        if (!empty($erros)) {
            enviarResposta(false, 'Erro no cadastro do professor: ' . implode(', ', $erros));
        } else {
            $ok = cadastrarPerfilProfessor(
    $foto_perfil,
    $experiencia_anos,
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
        $erros = [];
        if (!$idprofessor) $erros[] = 'ID do professor não informado';
        if (!$nome) $erros[] = 'Nome não informado';
        if (!$email) $erros[] = 'Email não informado';
        if (!$especialidade) $erros[] = 'Especialidade não informada';

        if (!empty($erros)) {
            enviarResposta(false, 'Erro na edição do perfil: ' . implode(', ', $erros));
        } else {
            $ok = editarPerfilProfessor($idperfil, $foto_perfil, $experiencia_anos, $modalidade, $avaliacao_media, $descricao, $horarios_disponiveis, $telefone);
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