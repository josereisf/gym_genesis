<?php
require_once __DIR__ . '/../funcao.php';


// Dados de exemplo para o teste
$nome      = 'Instrutor de Musculação';
$descricao = 'Responsável por acompanhar e orientar os treinos de musculação.';

$resultado = listarCargo(null);

var_dump($resultado);
