<?php

require_once '../funcao.php';

$nome = 'Produto Teste';
$descricao = 'Descrição do produto de teste';
$preco = 49.99;
$quantidade_estoque = 15;
$imagem = 'produto_teste.jpg';

$inserido = cadastrarProduto($nome, $descricao, $preco, $quantidade_estoque, $imagem);

if ($inserido !== null && $inserido !== false) {
  echo "Deu tudo certo ao cadastrar o produto!<br>";

  $conexao = conectar();
  $sql = "SELECT * FROM produto WHERE nome = '$nome' ORDER BY idproduto DESC LIMIT 1";
  $resultado = mysqli_query($conexao, $sql);

  if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($linha = mysqli_fetch_assoc($resultado)) {
      echo "<pre>";
      print_r($linha);
      echo "</pre>";
    }
  } else {
    echo "Produto não encontrado no banco.";
  }

  desconectar($conexao);
} else {
  echo "Erro ao cadastrar o produto.";
}
