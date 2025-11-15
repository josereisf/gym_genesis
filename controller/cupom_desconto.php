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
$idcupom = $input['idcupom'] ?? null;
$codigo = $input['codigo'] ?? null;
$percentual_desconto = $input['percentual_desconto'] ?? null;
$valor_desconto = $input['valor_desconto'] ?? null;
$data_validade = $input['data_validade'] ?? null;
$quantidade_uso = $input['quantidade_uso'] ?? null;
$tipo = $input['tipo'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$codigo || (!$percentual_desconto && !$valor_desconto) || !$data_validade || !$quantidade_uso || !$tipo) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarCupomDesconto($codigo, $percentual_desconto, $valor_desconto, $data_validade, $quantidade_uso, $tipo);
        if ($ok) {
            enviarResposta(true, 'Cupom cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar cupom');
        }
        $redir;
        break;

    case 'editar':
        if (!$idcupom || !$codigo || (!$percentual_desconto && !$valor_desconto) || !$data_validade || !$quantidade_uso || !$tipo) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarCupomDesconto($idcupom, $codigo, $percentual_desconto, $valor_desconto, $data_validade, $quantidade_uso, $tipo);
        if ($ok) {
            enviarResposta(true, 'Cupom editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar cupom');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarCupomDesconto($idcupom);
        if ($dados) {
            enviarResposta(true, 'Cupons listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar cupons');
        }
        $redir;
        break;

    case 'deletar':
        if (!$idcupom) {
            enviarResposta(false, 'ID do cupom não informado');
        }
        // $ok = deletarCupomDesconto($idcupom);
        // if ($ok) {
        //     enviarResposta(true, 'Cupom deletado com sucesso');
        // } else {
        //     enviarResposta(false, 'Erro ao deletar cupom');
        // }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
