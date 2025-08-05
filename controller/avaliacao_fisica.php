<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idavalaicao = $_POST['idavaliacao'] ?? 0;
$peso = $_POST['peso'] ?? null;
$altura = $_POST['altura'] ?? null;
$imc = $_POST['imc'] ?? null;
$percentual_gordura = $_POST['percentual_gordura'] ?? null;
$data_avaliacao = $_POST['da$data_avaliacao'] ?? null;
$idusuario = $_POST['idusuario'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarAvaliacaoFisica($peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $idusuario);
        break;
    case 'editar':
        editarAvaliacaoFisica($idavaliacao, $peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $idusuario);
        break;
    case 'listar':
        listarAvaliacaoFisica($idavaliacao);
        break;
    case 'deletar':
        deletarAvaliacaoFisica($idavaliacao);
        break;
}