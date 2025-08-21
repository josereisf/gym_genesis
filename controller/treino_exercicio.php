<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idtreino_exercicio = $input['idtreino_exercicio'] ?? null;
$treino_id = $input['treino_id'] ?? $input['idtreino'] ?? null;
$exercicio_id = $input['exercicio_id'] ?? $input['idexercicio'] ?? null;
$series = $input['series'] ?? null;
$repeticoes = $input['repeticoes'] ?? null;
$carga = $input['carga'] ?? null;
$intervalo_segundos = $input['intervalo_segundos'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$treino_id || !$exercicio_id || !$series || !$repeticoes || $carga === null || $intervalo_segundos === null) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarTreinoExercicio($treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos);
        if ($ok) {
            enviarResposta(true, 'Treino-exercício cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar treino-exercício');
        }
        break;

    case 'editar':
        if (!$idtreino_exercicio || !$treino_id || !$exercicio_id || !$series || !$repeticoes || $carga === null || $intervalo_segundos === null) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarTreinoExercicio($idtreino_exercicio, $treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos);
        if ($ok) {
            enviarResposta(true, 'Treino-exercício editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar treino-exercício');
        }
        break;

    case 'listar':
        $dados = listarTreinoExercicio($idtreino_exercicio);
        if ($dados) {
            enviarResposta(true, 'Treino-exercícios listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar treino-exercícios');
        }
        break;

    case 'deletar':
        if (!$idtreino_exercicio) {
            enviarResposta(false, 'ID do treino-exercício não informado');
        }
        $ok = deletarTreinoExercicio($idtreino_exercicio);
        if ($ok) {
            enviarResposta(true, 'Treino-exercício deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar treino-exercício');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
