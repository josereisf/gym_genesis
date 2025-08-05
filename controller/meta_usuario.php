<?php
require_once __DIR__ . '/../code/funcao.php';

$acao = $_GET['acao'] ?? null;

$idmeta = $_POST['idmeta'] ?? 0;
$idusuario = $_POST['idusuario'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$data_inicio = $_POST['data_inicio'] ?? null;
$data_limite = $_POST['data_limite'] ?? null;
$status = $_POST['status'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarMetaUsuario($idusuario, $descricao, $data_inicio, $data_limite, $status);
        break;
    case 'editar':
        editarMetaUsuario($idmeta, $descricao, $data_inicio, $data_limite, $status);
        break;
    case 'listar':
        listarMetaUsuario($idmeta);
        break;
    case 'deletar':
        deletarMetaUsuario($idmeta);
        break;
}