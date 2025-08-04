<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idtreino = $_POST['idtreino'] ?? 0;
$tipo = $_POST['nome'] ?? null;
$horario = $_POST['horario'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$idusuario = $_POST['idusuario'] ?? null;


switch ($acao) {
    case 'cadastrar':
        cadastrarTreino($tipo, $horario, $descricao, $idusuario);
        break;
    case 'editar':
        editarTreino($tipo, $horario, $descricao, $idtreino);
        break;
    case 'listar':
        listarTreino($idtreino);
        break;
    case 'deletar':
        deletarTreino($idtreino);
        break;
}