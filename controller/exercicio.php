<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idexercicio = $_POST['idexercicio'] ?? 0;
$grupo_muscular = $_POST['grupo_muscular'] ?? null;
$video_url = $_POST['video_url'] ?? null;
$descricao = $_POST['descricao'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarExercicio($nome, $grupo_muscular, $descricao, $video_url);
        break;
    case 'editar':
        editarExercicio($idexercicio, $nome, $grupo_muscular, $descricao, $video_url);
        break;
    case 'listar':
        listarExercicio($idexercicio);
        break;
    case 'deletar':
        deletarExercicio($idexercicio);
        break;
}