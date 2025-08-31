<?php

require_once __DIR__ . '/../funcao.php';

$idDieta = 1;
$idAlimento = 1;
$quantidade = 100;
$medida = 'g';

$resposta = editarDietaAlimentar($idDieta, $idAlimento, $quantidade, $medida);

if ($resposta) {
    echo "funcionou";
}
