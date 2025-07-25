<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_GET['acao'] ?? null;
$input = json_decode(file_get_contents('php://input'), true);

$idassinatura = $input['idassinatura'] ?? null;
$idusuario = $input['idusuario'] ?? null;
$data_inicio = $input['data_inicio'] ?? date('Y-m-d');
$idplano = $input['idplano'] ?? null;

// Recupera o plano do banco
$plano = $idplano ? (listarPlanos($idplano)[0] ?? null) : null;

// Calcula a data_fim apenas se for cadastrar e tiver plano
$data_fim = null;
if ($acao === 'cadastrar' && $plano) {
    switch ($plano['tipo']) {
        case 'Mensal':
            $data_fim = date('Y-m-d', strtotime($data_inicio . ' +30 days'));
            break;
        case 'Trimestral':
            $data_fim = date('Y-m-d', strtotime($data_inicio . ' +90 days'));
            break;
        case 'Anual':
            $data_fim = date('Y-m-d', strtotime($data_inicio . ' +365 days'));
            break;
    }
}

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if ($data_fim && $idplano && $idusuario) {
            $ok = cadastrarAssinatura($data_inicio, $data_fim, $idplano, $idusuario);
            if ($ok) {
                enviarResposta(true, 'Assinatura cadastrada com sucesso');
            } else {
                enviarResposta(false, 'Erro ao cadastrar assinatura');
            }
        } else {
            enviarResposta(false, 'Dados inválidos para cadastro');
        }
        break;

    case 'editar':
        if ($data_inicio && $data_fim && $idplano && $idusuario) {
            $ok = editarAssinatura($data_inicio, $data_fim, $idplano, $idusuario);
            if ($ok) {
                enviarResposta(true, 'Assinatura editada com sucesso');
            } else {
                enviarResposta(false, 'Erro ao editar assinatura');
            }
        } else {
            enviarResposta(false, 'Dados inválidos para edição');
        }
        break;

    case 'listar':
        $dados = listarAssinaturas($idassinatura);
        if ($dados) {
            enviarResposta(true, 'Assinaturas listadas com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar assinaturas');
        }
        break;

    case 'deletar':
        if ($idassinatura) {
            $ok = deletarAssinatura($idassinatura);
            if ($ok) {
                enviarResposta(true, 'Assinatura deletada com sucesso');
            } else {
                enviarResposta(false, 'Erro ao deletar assinatura');
            }
        } else {
            enviarResposta(false, 'ID da assinatura não fornecido');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
}
