<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
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

?>