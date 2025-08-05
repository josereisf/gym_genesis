<?php
require_once __DIR__ . '/../code/funcao.php';

$acao = $_GET['acao'] ?? null;

$idtopico = $_POST['idtopico'] ?? 0;
$titulo = $_POST['titulo'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$usuario_idusuario = $_POST['usuario_idusuario'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarForum($titulo, $descricao, $usuario_idusuario);
        break;
    case 'editar':
        editarForum($idtopico, $titulo, $descricao);
        break;
    case 'listar':
        listarForum($idtopico);
        break;
    case 'deletar':
        deletarForum($idtopico);
        break;
}