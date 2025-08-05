<?php
require_once __DIR__ . '/../code/funcao.php';

$acao = $_GET['acao'] ?? null;

$idplano = $_POST['idplano'] ?? 0;
$tipo = $_POST['tipo'] ?? null;
$duracao = $_POST['duracao'] ?? null;
$idassinatura = $_POST['idassinatura'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarPlano($tipo, $duracao, $idassinatura);
        break;
    case 'editar':
        editarPlano($idplano, $tipo, $duracao);
        break;
    case 'listar':
        listarPlanos($idplano);
        break;
    case 'deletar':
        deletarPlano($idplano);
        break;
}