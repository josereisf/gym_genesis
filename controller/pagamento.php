<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idpagamento = $_POST['idpagamento'] ?? 0;
$usuario_idusuario = $_POST['usuario_idusuario'] ?? null;
$valor = $_POST['valor'] ?? null;
$data_pagamento = $_POST['data_pagamento'] ?? null;
$metodo = $_POST['metodo'] ?? null;
$status = $_POST['status'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarPagamento($usuario_idusuario, $valor, $data_pagamento, $metodo, $status);
        break;
    case 'editar':
        editarPagamento($idpagamento, $valor, $data_pagamento, $metodo, $status);
        break;
    case 'listar':
        listarPagamentos($idpagamento);
        break;
    case 'deletar':
        deletarPagamento($idpagamento);
        break;
}