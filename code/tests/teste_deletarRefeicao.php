<?php

require_once __DIR__ . '/../funcao.php';


$idrefeicao = 1;


if (!is_null(deletarRefeição($idrefeicao))) {
    echo "funcionou";
}
// echo '<pre>';
// print_r($listar);
// echo '</pre';