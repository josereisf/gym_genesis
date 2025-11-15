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
$idtreino_exercicio = $input['idtreino2'] ?? null;
$treino_id = $input['treino_id'] ?? null;
$exercicio_id = $input['exercicio_id'] ?? null;
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
        $redir;
        break;

    case 'editar':
        print_r($input);
        $ok = editarTreinoExercicio($idtreino_exercicio, $treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos);
        if ($ok) {
            enviarResposta(true, 'Treino-exercício editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar treino-exercício');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarTreinoExercicio($idtreino_exercicio);
        if ($dados) {
            enviarResposta(true, 'Treino-exercícios listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar treino-exercícios');
        }
        $redir;
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
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
