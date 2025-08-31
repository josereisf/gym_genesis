<?php

require_once __DIR__ . '/../funcao.php';
// Altere o caminho conforme necessário

$idcategoria = 1; // ID da categoria que você quer deletar

$resultado = deletarCategoriaProduto( $idcategoria);

if ($resultado) {
  echo "Categoria deletada com sucesso.\n";
} else {
  echo "Falha ao deletar a categoria.\n";
}