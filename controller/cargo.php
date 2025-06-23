<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idcargo = $_POST['idcargo'] ?? 0;
$nome = $_POST['nome'] ?? null;
$descricao = $_POST['descricao'] ?? null;


switch ($acao) {
    case 'cadastrar':
        cadastrarCargo($nome, $descricao);
        break;
    case 'editar':
        editarCargo($idcargo, $nome, $descricao);
        break;
    case 'listar':
        listarCargo($idcargo);
        break;
    case 'deletar':
        deletarCargo($idcargo);
        break;
}