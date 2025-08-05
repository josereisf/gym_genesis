<?php
require_once __DIR__ . '/../code/funcao.php';

$acao = $_GET['acao'] ?? null;

$idcupom = $_POST['idcupom'] ?? 0;
$codigo = $_POST['codigo'] ?? null;
$percentual_desconto = $_POST['percentual_desconto'] ?? null;
$valor_desconto = $_POST['valor_desconto'] ?? null;
$data_validade = $_POST['data_validade'] ?? null;
$quantidade_uso = $_POST['quantidade_uso'] ?? null;
$tipo = $_POST['tipo'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarCupomDesconto($codigo, $percentual_desconto, $valor_desconto, $data_validade, $quantidade_uso, $tipo);
        break;
    case 'editar':
        editarCupomDesconto($idcupom, $codigo, $percentual_desconto, $valor_desconto, $data_validade, $quantidade_uso, $tipo);
        break;
    case 'listar':
        listarCupomDesconto($idcupom);
        break;
    case 'deletar':
        //precisa ser criada
        break;
}