<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$iddieta = $_POST['iddieta'] ?? 0;
$descricao = $_POST['descricao'] ?? null;
$data_inicio = $_POST['data_inicio'] ?? null;
$data_fim = $_POST['data_fim'] ?? null;
$idusuario = $_POST['idusuario'] ?? 0;


switch ($acao) {
    case 'cadastrar':
        cadastrarDieta($descricao, $data_inicio, $data_fim, $idusuario);
        break;
    case 'editar':
        editarDieta($descricao, $data_inicio, $data_fim, $idusuario, $iddieta);
        break;
    case 'listar':
        listarDietas($iddieta);
        break;
    case 'deletar':
        deletarDieta($iddieta);
        break;
}