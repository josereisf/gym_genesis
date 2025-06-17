<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idproduto = $_POST['idproduto'] ?? 0;
$nome = $_POST['nome'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$preco = $_POST['preco'] ?? null;
$quantidade_estoque = $_POST['qtd'] ?? null;
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['imagem']);
} elseif (isset($_POST['imagem']) && (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK)) {
    $imagem = $_POST['imagem'];
} else {
    $imagem = null;
}
switch ($acao) {
    case 'cadastrar':
        cadastrarProduto($nome, $descricao, $preco, $quantidade_estoque, $imagem);
        break;
    case 'editar':
        editarProduto($idproduto, $nome, $descricao, $preco, $quantidade_estoque, $imagem);
        break;
    case 'listar':
        listarProdutos($idprouto);
        break;
    case 'deletar':
        deletarProduto($idproduto);
        break;
}
