 <?php
require_once __DIR__ .'/../code/funcao.php';
$acao = $_GET ['acao'];
// $idproduto = 0;

switch ($acao) {
    case 'listar':
        listarProdutos($idproduto);
        break;
    case 'editar':
        editarProduto($idproduto, $nome, $descricao, $preco, $quantidade_estoque, $imagem);
} 

