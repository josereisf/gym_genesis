<?php

require_once __DIR__ . '/../funcao.php';


$idusuario = 1;


if (!is_null(deletarAssinatura($idusuario))) {
    echo "funcionou";
}
