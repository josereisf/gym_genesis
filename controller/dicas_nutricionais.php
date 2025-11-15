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
$iddicas = $input['iddicas_nutricionais'] ?? null;
$titulos = $input['titulos'] ?? null;
$descricao = $input['descricao'] ?? null;
$icone = $input['icone'] ?? null;
$cor = $input['cor'] ?? null;

if (!$acao) {
    enviarResposta(false, 'Ação não informada.');
}

switch ($acao) {

    case 'cadastrar':
        if (!$titulos || !$descricao || !$icone || !$cor) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos.');
        }
        $ok = cadastrarDicaNutricional($titulos, $descricao, $icone, $cor);
        if ($ok) {
            enviarResposta(true, 'Dica nutricional cadastrada com sucesso.');
        } else {
            enviarResposta(false, 'Erro ao cadastrar dica.');
        }
        break;


    case 'editar':
        if (!$iddicas || !$titulos || !$descricao || !$icone || !$cor) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos.');
        }
        $ok = editarDicaNutricional($titulos, $descricao, $icone, $cor, $iddicas);
        if ($ok) {
            enviarResposta(true, 'Dica nutricional editada com sucesso.');
        } else {
            enviarResposta(false, 'Erro ao editar dica.');
        }
        break;


    case 'listar':
        $dados = listarDicasNutricionais($iddicas);
        if ($dados) {
            enviarResposta(true, 'Dicas listadas com sucesso.', $dados);
        } else {
            enviarResposta(false, 'Nenhuma dica encontrada.');
        }
        break;


    case 'deletar':
        if (!$iddicas) {
            enviarResposta(false, 'ID não informado.');
        }
        $ok = deletarDicaNutricional($iddicas);
        if ($ok) {
            enviarResposta(true, 'Dica nutricional deletada com sucesso.');
        } else {
            enviarResposta(false, 'Erro ao deletar dica.');
        }
        break;


    default:
        enviarResposta(false, 'Ação inválida.');
        break;
}
