<?php


require_once __DIR__ . '/../funcao.php';


$idalimento = 1;
$idrefeicao = 1;
$quantidade = 5;
$observacao = '12';

if (!empty(editarDietaAlimento($idalimento, $idrefeicao, $quantidade, $observacao))) {
    echo "funcionou";
}
