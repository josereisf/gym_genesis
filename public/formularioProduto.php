<?php
require_once '../code/funcao.php';

if (isset($_GET['idproduto'])){
  $idproduto = $_GET['idproduto'];
  $resultados = json_decode(listarProdutos($idproduto));
  $nome = $resultados['nome'];
  $descricao = $resultados['descricao'];
  $preco = $resultados['preco'];
  $quantidade = $resultados['quantidade_estoque'];
  $imagem = $resultados['imagem'];
  }
else {
  $idproduto = 0;
  $nome = '';
  $descricao = '';
  $preco = 0;
  $quantidade = 0;
  $imagem = null;
}


?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulário de Produto</title>
  </head>
  <body>
    <form action="api/index.php?entidade=produto&acao=cadastrar" method="post" enctype="multipart/form-data">
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" value="<?= $nome?>" required /><br />

      <label for="descricao">Descrição:</label>
      <input type="text" name="descricao" id="descricao" value="<?= $descricao ?>" required /><br />

      <label for="preco">Preço:</label>
      <input type="number" name="preco" id="preco" step="0.01" value="<?= $preco ?>" required /><br />

      <label for="qtd">Quantidade no estoque:</label>
      <input type="number" name="qtd" id="qtd" value="<?= $quantidade ?>" required /><br />

      <?php 
      if (!empty($imagem)){
        echo "<img src='uploads/$imagem' alt='$imagem'>";
      }
      ?>
      <label for="imagem">Imagem:</label>
      <input type="file" name="imagem" id="imagem" accept="image/*" /><br />
      <input type="submit" value="Salvar" />
    </form>
  </body>
</html>
