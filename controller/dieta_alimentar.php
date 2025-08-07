<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idrefeicao = $_POST['idrefeicao'] ?? 0;
$idalimento = $_POST['idalimento'] ?? null;
$quantidade = $_POST['quantidade'] ?? null;
$observacao = $_POST['observacao'] ?? null;


switch ($acao) {
    case 'cadastrar':
        cadastrarDietaAlimentar($idrefeicao, $idalimento, $quantidade, $observacao);
        break;
    case 'editar':
        editarDietaAlimentar($idalimento, $idrefeicao, $quantidade, $observacao);
        break;
    case 'listar':
// fazer dps
//        listarDietaAlimentar($iddieta, $idalimento);
        break;
    case 'deletar':
        deletarDietaAlimentar($iddieta, $idlalimento);
        break;
}