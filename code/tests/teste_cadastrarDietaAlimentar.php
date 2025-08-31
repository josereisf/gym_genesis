<?php

require_once __DIR__ . '/../funcao.php';


$idrefeicao = 1;
$idalimento = 18;
$quantidade = 100;
$observacao = "Sem glúten";

$resposta = cadastrarDietaAlimentar($idrefeicao, $idalimento, $quantidade, $observacao);

if ($resposta) {
    echo "Teste de cadastro de dieta alimentar aprovado.";
} else {
    echo "Teste de cadastro de dieta alimentar reprovado.";
}
