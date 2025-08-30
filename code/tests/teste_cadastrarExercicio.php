<?php

require_once __DIR__ . '/../funcao.php';


$idusuario = 1;
$descricao = "Exercício de teste";
$duracao = 60;
$calorias = 500;

$resposta = cadastrarExercicio($idusuario, $descricao, $duracao, $calorias);

if ($resposta) {
    echo "Teste de cadastro de exercício aprovado.";
} else {
    echo "Teste de cadastro de exercício reprovado.";
}
