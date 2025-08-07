<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idhistorico_peso = $_POST['idhistorico_peso'] ?? 0;
$idusuario = $_POST['idusuario'] ?? null;
$peso = $_POST['peso'] ?? null;
$data_registro = $_POST['data_registro'] ?? null;

// Funções não encontradas, sugestão de nomes e parâmetros:
switch ($acao) {
    case 'cadastrar':
        // cadastrarHistoricoPeso($idusuario, $peso, $data_registro);
        break;
    case 'editar':
        // editarHistoricoPeso($idhistorico_peso, $idusuario, $peso, $data_registro);
        break;
    case 'listar':
        // listarHistoricoPeso($idhistorico_peso);
        break;
    case 'deletar':
        // deletarHistoricoPeso($idhistorico_peso);
        break;
}