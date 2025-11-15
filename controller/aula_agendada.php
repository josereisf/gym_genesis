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


$idaula = $input['idaula'] ?? null;
$data_aula = $input['data_aula'] ?? null;
$dia_semana = $input['dia_semana'] ?? null;
$hora_inicio = $input['hora_inicio'] ?? null;
$hora_fim = $input['hora_fim'] ?? null;
$idfuncionario = $input['funcionario_id'] ?? null;
$idtreino = $input['treino_id'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
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
        break;

    case 'listar':
        $idprofessor = $input['idprofessor'] ?? null; // pega o id do professor
        $dados = listarAulaAgendada($idprofessor);
        
        if ($dados !== false) {
            enviarResposta(true, 'Aulas agendadas listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar aulas agendadas');
        }
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
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
