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
$idtreino = $input['idtreino'] ?? null;
$tipo = $input['tipo'] ?? null;
$horario = $input['horario'] ?? null;
$descricao = $input['descricao'] ?? null;
$idusuario = $input['funcionario_id'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        $ok = cadastrarTreino($tipo, $horario, $descricao, $idusuario);
        if ($ok) {
            enviarResposta(true, 'Treino cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar treino');
        }
        $redir;
        break;

    case 'editar':
        if (!$idtreino || !$tipo || !$horario || !$descricao) {
            enviarResposta(false, 'ID, tipo, horário e descrição são obrigatórios');
        }
        $ok = editarTreino($tipo, $horario, $descricao, $idtreino);
        if ($ok) {
            enviarResposta(true, 'Treino editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar treino');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarTreino($idtreino);
        if ($dados) {
            enviarResposta(true, 'Treinos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar treinos');
        }
        $redir;
        break;

    case 'deletar':
        if (!$idtreino) {
            enviarResposta(false, 'ID do treino não informado');
        }
        $ok = deletarTreino($idtreino);
        if ($ok) {
            enviarResposta(true, 'Treino deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar treino');
        }
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
switch ($acao) {
    case 'cadastrar':
        if (!$data_aula || !$dia_semana || !$hora_inicio || !$hora_fim || !$idfuncionario || !$idtreino) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarAulaAgendada($data_aula, $dia_semana, $hora_inicio, $hora_fim, $idfuncionario, $idtreino);
        if ($ok) {
            enviarResposta(true, 'Aula agendada cadastrada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar aula agendada');
        }
        $redir;
        break;

    case 'editar':
        if (!$idaula || !$data_aula || !$dia_semana || !$hora_inicio || !$hora_fim || !$idfuncionario || !$idtreino) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarAulaAgendada($data_aula, $dia_semana, $hora_inicio, $hora_fim, $idfuncionario, $idtreino, $idaula);
        if ($ok) {
            enviarResposta(true, 'Aula agendada editada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar aula agendada');
        }
        $redir;
        break;

    case 'listar':
        $idprofessor = $input['idprofessor'] ?? null; // pega o id do professor
        $dados = listarAulaAgendada($idprofessor);
        if ($dados !== false) {
            enviarResposta(true, 'Aulas agendadas listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar aulas agendadas');
        }
        $redir;
        break;


    case 'deletar':
        if (!$idaula) {
            enviarResposta(false, 'ID da aula agendada não informado');
        }
        $ok = deletarAulaAgendada($idaula);
        if ($ok) {
            enviarResposta(true, 'Aula agendada deletada com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar aula agendada');
        }
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
if ($input === $_POST) {
    header('Location: ../listar.php');
    exit;
}
