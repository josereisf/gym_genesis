<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idalimento = $_POST['idalimento'] ?? 0;
$nome = $_POST['nome'] ?? null;
$calorias = $_POST['calorias'] ?? null;
$carboidratos = $_POST['carboidratos'] ?? null;
$proteinas = $_POST['proteinas'] ?? null;
$gorduras = $_POST['gorduras'] ?? null;
$porcao = $_POST['porcao'] ?? null;
$categoria = $_POST['categoria'] ?? null;

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['imagem']);
} elseif (isset($_POST['imagem']) && (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK)) {
    $imagem = $_POST['imagem'];
} else {
    $imagem = null;
}

switch ($acao) {
    case 'cadastrar':
        cadastrarAlimento($nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem);
        break;
    case 'editar':
        editarAlimento($idalimento, $nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem);
        break;
    case 'listar':
        listarAlimentos($idalimento);
        break;
    case 'deletar':
        deletarAlimento($idalimento);
        break;
}