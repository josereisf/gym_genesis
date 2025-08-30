<?php


require_once __DIR__ . '/../funcao.php';


$iddieta = 1;
$tipo = 'Almoço';
$horario = '04:20:12';

if (!empty(cadastrarRefeicao($iddieta, $tipo, $horario))) {
    echo "funcionou";
}
