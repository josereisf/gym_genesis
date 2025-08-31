<?php
require_once __DIR__ . '/../funcao.php';


// Dados de exemplo para o teste
$peso               = 75.5;         // em kg
$altura             = 1.78;         // em metros
$imc                = $peso / ($altura * $altura); // cálculo simples
$percentual_gordura = 18.2;
$data_avaliacao     = '2025-09-01';
$idusuario          = 1;

$resultado = listarAvaliacaoFisica($idusuario);

var_dump($resultado);