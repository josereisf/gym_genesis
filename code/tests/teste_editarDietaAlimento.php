<?php


require_once '../funcao.php';

$iddieta_alimentar = 1;
$quantidade = 5;
$observacao = '12';

if (!empty(editarDietaAlimento($iddieta_alimentar, $quantidade, $observacao))){
    echo "funcionou";
}
