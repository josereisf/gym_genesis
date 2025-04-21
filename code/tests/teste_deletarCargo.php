<?php

require_once '../funcao.php';

$idcargo = 1;


if (!is_null(deletarCargo($idcargo))){
    echo "funcionou";
}
