<?php

require_once __DIR__ . '/../funcao.php';


$descricao = 'se ta caro, não compra';
$data_inicio = '2024-02-03';
$data_fim = '2025-03-04';
$idusuario = 1;
$idDieta = 1;

if (!is_null(editarDieta($descricao, $data_inicio, $data_fim, $idusuario, $idDieta))) {
    echo "funcionou";
}
