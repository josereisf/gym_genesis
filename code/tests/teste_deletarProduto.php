<?php

require_once '../funcao.php';


$idproduto = 1;

if (!is_null(deletarProduto($idproduto))){
    echo "funcionou";
}