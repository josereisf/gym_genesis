<?php

require_once '../funcao.php';

$tipo = 'flexão';
$horario = '06:00:00';
$descricao = 'fazer 2 milhões de vezes';
$idusuario = 1;


if (!is_null(cadastrarTreino($tipo, $horario, $descricao, $idusuario))){
    echo "funcionou";
}