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

$idassinatura = $input['idassinatura'] ?? null;
$idusuario = $input['idusuario'] ?? $input['usuario_id'] ?? null;
$data_inicio = $input['data_inicio'] ?? date('Y-m-d');
$idplano = $input['idplano'] ?? $input['plano_id'] ?? null;
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
        $erros = [];

        if (!$idplano) $erros[] = 'ID do plano não informado';
        if (!$data_fim) $erros[] = 'Data de término não informada';
        if (!$data_inicio) $erros[] = 'Data de início não informada';

        if (!empty($erros)) {
            enviarResposta(false, 'Erro no cadastro da assinatura: ' . implode(', ', $erros));
        } else {
            $ok = cadastrarAssinatura($data_inicio, $data_fim, $idplano, $idusuario);
            if ($ok) {
                enviarResposta(true, 'Assinatura cadastrada com sucesso');
                if ($input === $_POST) {
                    header('Location: ../listar.php');
                }
            } else {
                enviarResposta(false, 'Erro ao cadastrar assinatura no banco de dados');
            }
        }
        $redir;
        break;

    case 'editar':
        $erros = [];

        if (!$idusuario) $erros[] = 'ID do usuário não informado';
        if (!$idplano) $erros[] = 'ID do plano não informado';
        if (!$data_inicio) $erros[] = 'Data de início não informada';
        if (!$data_fim) $erros[] = 'Data de término não informada';

        if (!empty($erros)) {
            enviarResposta(false, 'Erro na edição da assinatura: ' . implode(', ', $erros));
        } else {
            $ok = editarAssinatura($data_inicio, $data_fim, $idplano, $idusuario);
            if ($ok) {
                enviarResposta(true, 'Assinatura editada com sucesso');
                if ($input === $_POST) {
                    header('Location: ../listar.php');
                }
            } else {
                enviarResposta(false, 'Erro ao editar assinatura no banco de dados');
            }
        }
        $redir;
        break;

    case 'listar':
        $dados = listarAssinaturas($idassinatura);
        if ($dados) {
            enviarResposta(true, 'Assinaturas listadas com sucesso', $dados);
            
        } else {
            enviarResposta(false, 'Erro ao listar assinaturas');
        }
        $redir;
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
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação inválida');
}
