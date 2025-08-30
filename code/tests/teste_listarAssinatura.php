<?php
require_once __DIR__ . '/../funcao.php';


// Dados de exemplo para o teste
$data_inicio = '2025-08-30';
$data_fim = '2025-09-30';
$idplano = 1;
$idusuario = 1;

$resultado = cadastrarAssinatura($data_inicio, $data_fim, $idplano, $idusuario);

if ($resultado) {
    echo "Cadastro de assinatura realizado com sucesso!";
} else {
    echo "Falha ao cadastrar assinatura.";
}
