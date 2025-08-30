<?php

require_once __DIR__ . '/../funcao.php';


$descricao = "Dieta de teste";
$data_inicio = "2023-01-01";
$data_fim = "2023-01-07";
$usuario_id = 1;

$resposta = cadastrarDieta($descricao, $data_inicio, $data_fim, $usuario_id);

if ($resposta) {
    echo "Teste de cadastro de dieta aprovado.";
} else {
    echo "Teste de cadastro de dieta reprovado.";
}
