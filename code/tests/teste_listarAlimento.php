<?php
require_once __DIR__ . '/../funcao.php';

$idalimento = null; // Defina o ID do alimento que deseja listar
$resposta = listarAlimentos($idalimento);

var_dump($resposta);