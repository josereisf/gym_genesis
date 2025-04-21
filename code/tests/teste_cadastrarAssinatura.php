<?php
require_once '../funcao.php';

$data_inicio = '2102-10-02';
$data_fim = '2103-04-05';
$idusuario = 1;

if (!is_null(cadastrarAssinatura($data_inicio, $data_fim, $idusuario))){
    echo "funcionou";
}