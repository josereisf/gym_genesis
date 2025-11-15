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
$idhistorico = $input['idhistorico'] ?? null;
$data_execucao = $input['data_execucao'] ?? null;
$observacoes = $input['observacoes'] ?? null;
$idusuario = $input['usuario_id'] ?? null;
$idtreino = $input['treino_id'] ?? null;
if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$idusuario || !$idtreino || !$data_execucao) {
            enviarResposta(false, 'Usuário, treino e data de execução são obrigatórios');
        }
        $ok = cadastrarHistoricoTreino($idusuario, $idtreino, $data_execucao, $observacoes);
        if ($ok) {
            enviarResposta(true, 'Histórico de treino cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar histórico de treino');
        }
        $redir;
        break;

    case 'editar':
        if (!$idhistorico || !$data_execucao) {
            enviarResposta(false, 'ID e data de execução são obrigatórios');
        }
        $ok = editarHistoricoTreino($idhistorico, $data_execucao, $observacoes);
        if ($ok) {
            enviarResposta(true, 'Histórico de treino editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar histórico de treino');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarHistoricoTreino($idhistorico);
        if ($dados) {
            enviarResposta(true, 'Históricos de treino listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar históricos de treino');
        }
        $redir;
        break;

    case 'deletar':
        if (!$idhistorico) {
            enviarResposta(false, 'ID do histórico de treino não informado');
        }
        $ok = deletarHistoricoTreino($idhistorico);
        if ($ok) {
            enviarResposta(true, 'Histórico de treino deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar histórico de treino');
        }
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
