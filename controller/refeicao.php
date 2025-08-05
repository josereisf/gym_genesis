<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idrefeicao = $_POST['idrefeicao'] ?? 0;
$tipo = $_POST['tipo'] ?? null;
$horario = $_POST['horario'] ?? null;
$iddieta = $_POST['iddieta'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarRefeicao($iddieta, $tipo, $horario);
        break;
    case 'editar':
        editarRefeicao($idrefeicao,  $iddieta, $tipo, $horario);
        break;
    case 'listar':
        listarRefeicoes($idrefeicao);
        break;
    case 'deletar':
        deletarRefeicao($idrefeicao);
        break;
}