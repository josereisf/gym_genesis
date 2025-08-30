<?php

require_once __DIR__ . '/../funcao.php';


$idrefeicao = 2;
$idalimento = 6;
$quantidade = 100;
$observacao = "Sem glúten";

$resposta = cadastrarDietaAlimentar($idrefeicao, $idalimento, $quantidade, $observacao);

if ($resposta) {
    echo "Teste de cadastro de dieta alimentar aprovado.";
} else {
    echo "Teste de cadastro de dieta alimentar reprovado.";
}
