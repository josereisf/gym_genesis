<?php

require_once '../funcao.php';

$idhorario = 1;


if (!is_null(deletarHorario($idhorario))){
    echo "funcionou";
}
