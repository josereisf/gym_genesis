<?php

require_once __DIR__ . '/../funcao.php';


$tipo = 'Família';
$duracao = '2 anos';
$idassinatura = 1;


if (!is_null(cadastrarPlano($tipo, $duracao, $idassinatura))) {
    echo "funcionou";
}
