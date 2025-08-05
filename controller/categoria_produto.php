<?php
require_once __DIR__ . '/../code/funcao.php';

$acao = $_GET['acao'] ?? null;

$idcategoria = $_POST['idcategoria'] ?? 0;
$nome = $_POST['nome'] ?? null;
$descricao = $_POST['descricao'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarCategoriaProduto($nome, $descricao);
        break;
    case 'editar':
        editarCategoriaProduto($idcategoria, $nome, $descricao);
        break;
    case 'listar':
        listarCategoriaProduto($idcategoria);
        break;
    case 'deletar':
        deletarCategoriaProduto($idcategoria);
        break;
}