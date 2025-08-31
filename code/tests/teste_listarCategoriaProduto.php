<?php

require_once __DIR__ . '/../funcao.php';
// Altere o caminho conforme necessário

$idproduto = 1; // ID do produto que você quer editar
$nome = 'Produto Editado';
$descricao = 'Nova descrição para o produto';
$preco = 19.99;
$quantidade_estoque = 10;
$imagem = 'imagem_nova.jpg';

$resultado = listarProdutos(null);

var_dump($resultado);
