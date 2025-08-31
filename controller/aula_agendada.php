<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idaula = $input['idaula'] ?? null;
$data_aula = $input['data_aula'] ?? null;
$dia_semana = $input['dia_semana'] ?? null;
$hora_inicio = $input['hora_inicio'] ?? null;
$hora_fim = $input['hora_fim'] ?? null;
$idfuncionario = $input['idfuncionario'] ?? null;
$idtreino = $input['idtreino'] ?? null;

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
        $dados = listarAulaAgendada($idaula);
        if ($dados) {
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
