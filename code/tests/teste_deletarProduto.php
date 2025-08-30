<?php

require_once __DIR__ . '/../funcao.php';



$idproduto = 1;

if (!is_null(deletarProduto($idproduto))) {
    echo "funcionou";
}
