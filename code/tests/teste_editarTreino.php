<?php

require_once __DIR__ . '/../funcao.php';


$idtreino = 1;
$tipo = 'agachamento';
$horario = '07:00:00';
$descricao = '2 mil vezes';


if (!is_null(editarTreino($tipo, $horario, $descricao, $idtreino))) {
    echo "funcionou";
}
