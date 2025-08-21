<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idplano = $input['idplano'] ?? null;
$tipo = $input['tipo'] ?? null;
$duracao = $input['duracao'] ?? null;
$idassinatura = $input['idassinatura'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$tipo || !$duracao) {
            enviarResposta(false, 'Tipo e duração são obrigatórios');
        }
        $ok = cadastrarPlano($tipo, $duracao, $idassinatura);
        if ($ok) {
            enviarResposta(true, 'Plano cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar plano');
        }
        break;

    case 'editar':
        if (!$idplano || !$tipo || !$duracao) {
            enviarResposta(false, 'ID, tipo e duração são obrigatórios');
        }
        $ok = editarPlano($idplano, $tipo, $duracao);
        if ($ok) {
            enviarResposta(true, 'Plano editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar plano');
        }
        break;

    case 'listar':
        $dados = listarPlanos($idplano);
        if ($dados) {
            enviarResposta(true, 'Planos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar planos');
        }
        break;

    case 'deletar':
        if (!$idplano) {
            enviarResposta(false, 'ID do plano não informado');
        }
        $ok = deletarPlano($idplano);
        if ($ok) {
            enviarResposta(true, 'Plano deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar plano');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
}
