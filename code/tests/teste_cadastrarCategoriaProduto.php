<?php

require_once '../funcao.php'; // Altere o caminho conforme necessário

$idproduto = 1; // ID do produto que você quer editar
$nome = 'Produto Editado';
$descricao = 'Nova descrição para o produto';
$preco = 19.99;
$quantidade_estoque = 10;
$imagem = 'imagem_nova.jpg';

$resultado = editarProduto($idproduto, $nome, $descricao, $preco, $quantidade_estoque, $imagem);

if ($resultado) {
  echo "Edição realizada com sucesso.\n";

  // Verifica se os dados foram realmente alterados
  $conexao = conectar();
  $sql = "SELECT nome, descricao, preco, quantidade_estoque, imagem FROM produto WHERE idproduto = ?";
  $stmt = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($stmt, "i", $idProduto);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $nome, $descricao, $preco, $quantidade_estoque, $imagem);
  mysqli_stmt_fetch($stmt);

  echo "Dados atualizados:\n";
  echo "Nome: $nome\n";
  echo "Descrição: $descricao\n";
  echo "Preço: $preco\n";
  echo "Quantidade em estoque: $quantidade_estoque\n";
  echo "Imagem: $imagem\n";

  mysqli_stmt_close($stmt);
  desconectar($conexao);
} else {
  echo "Falha na edição do produto.\n";
}
