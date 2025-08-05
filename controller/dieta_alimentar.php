<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idDietaAlimentar = $_POST['idDietaAlimentar'] ?? 0;
$tipo = $_POST['tipo'] ?? null;
$horario = $_POST['horario'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$idusuario = $_POST['idusuario'] ?? null;


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
        deletarDietaAlimento($iddieta, $idlalimento);
        break;
}