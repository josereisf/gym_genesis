<?php
require_once __DIR__ . '/../funcao.php';


// Dados de exemplo para o teste
$idusuario = 2;

$resultado = listarDietas($idusuario);

var_dump($resultado);