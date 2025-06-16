 <?php
require_once __DIR__ .'/../code/funcao.php';
$acao = $_GET['acao'];

$idproduto = $_POST['idproduto'] ?? 0; 
$nome = $_POST['nome'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$preco = $_POST['preco'] ?? null;
$quantidade_estoque = $_POST['qtd'] ?? null;
var_dump($_FILES['imagem']);
if (isset($_FILES['imagem'])){
    $imagem = uploadImagem($_FILES['imagem']);
}
elseif (isset($_POST['imagem']) and !isset($_FILES['imagem'])) {
    $imagem = $_POST['imagem'];
}
else {
    $imagem = null;
}

print_r($_POST);
print_r($imagem);
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

