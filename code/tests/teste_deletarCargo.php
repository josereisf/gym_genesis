<?php

require_once __DIR__ . '/../funcao.php';


$idcargo = 1;


if (!is_null(deletarCargo($idcargo))) {
    echo "funcionou";
}
