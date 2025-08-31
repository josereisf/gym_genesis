<?php


require_once __DIR__ . '/../funcao.php';


$idcupom = 1;

if (!empty(deletarCupomDesconto($idcupom))) {
    echo "funcionou";
}
