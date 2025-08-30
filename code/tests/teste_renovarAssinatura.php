<?php

require_once __DIR__ . '/../funcao.php';


$data_inicio = '2250-10-11';
$data_fim = '2250-11-11';
$idusuario = 1;

if (!is_null(renovarAssinatura($idusuario, $data_inicio, $data_fim))) {
    echo "funcionou";
}
