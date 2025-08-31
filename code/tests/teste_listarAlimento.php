<?php
require_once __DIR__ . '/../funcao.php';

$idalimento = 31; // Defina o ID do alimento que deseja listar
$resposta = listarAlimentos($idalimento);

var_dump($resposta);