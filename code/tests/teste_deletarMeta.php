<?php

require_once '../funcao.php';

$idmeta = 1;


if (!is_null(deletarMetaUsuario($idmeta))){
    echo "funcionou";
}
