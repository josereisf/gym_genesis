<?php

require_once __DIR__ . '/../funcao.php';


$usuario_id = 1;
$data = "2024-06-01";
$peso = 70.5;

$resposta = cadastrarHistoricoPeso($usuario_id, $peso);

if ($resposta) {
    echo "Teste de cadastro de histórico de peso aprovado.";
} else {
    echo "Teste de cadastro de histórico de peso reprovado.";
}
