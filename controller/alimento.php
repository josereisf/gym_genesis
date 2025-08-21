<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idalimento = $input['idalimento'] ?? null;
$nome = $input['nome'] ?? null;
$calorias = $input['calorias'] ?? null;
$carboidratos = $input['carboidratos'] ?? null;
$proteinas = $input['proteinas'] ?? null;
$gorduras = $input['gorduras'] ?? null;
$porcao = $input['porcao'] ?? null;
$categoria = $input['categoria'] ?? null;

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['imagem']);
} elseif (isset($input['imagem']) && (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK)) {
    $imagem = $input['imagem'];
} else {
    $imagem = null;
}

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$nome || !$calorias || !$carboidratos || !$proteinas || !$gorduras || !$porcao || !$categoria) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarAlimento($nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem);
        if ($ok) {
            enviarResposta(true, 'Alimento cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar alimento');
        }
        break;

    case 'editar':
        if (!$idalimento || !$nome || !$calorias || !$carboidratos || !$proteinas || !$gorduras || !$porcao || !$categoria) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarAlimento($idalimento, $nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem);
        if ($ok) {
            enviarResposta(true, 'Alimento editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar alimento');
        }
        break;

    case 'listar':
        $dados = listarAlimentos($idalimento);
        if ($dados) {
            enviarResposta(true, 'Alimentos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar alimentos');
        }
        break;

    case 'deletar':
        if (!$idalimento) {
            enviarResposta(false, 'ID do alimento não informado');
        }
        $ok = deletarAlimento($idalimento);
        if ($ok) {
            enviarResposta(true, 'Alimento deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar alimento');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
