<?php

require_once '../funcao.php';

$idusuario = 1;


if (!is_null(deletarAssinatura($idusuario))){
    echo "funcionou";
}
