<?php

require_once __DIR__ . '/../funcao.php';


$idtreino2 = 1;


if (!is_null(deletarTreinoExercicio($idtreino2))) {
    echo "funcionou";
}
