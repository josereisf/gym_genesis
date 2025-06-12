 <?php
require_once __DIR__ .'/../code/funcao.php';
$acao = $_GET ['acao'];

$idproduto = $_POST['idproduto'] ?? 0; 
$nome = $_POST['nome'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$preco = $_POST['preco'] ?? null;
$quantidade_estoque = $_POST['qtd'] ?? null;
$imagem = $_FILES['imagem'] ?? null;

if (!empty($imagem)){
    $imagem = uploadImagem($imagem);
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

