<?php

require_once __DIR__ . '/../funcao.php';


$idmeta = 1;


if (!is_null(deletarMetaUsuario($idmeta))) {
    echo "funcionou";
}
