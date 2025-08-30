<?php

require_once __DIR__ . '/../funcao.php';


$idplano = 1;
$tipo = 'estudante';
$duracao = '3 dias';


if (!is_null(editarPlano($idplano, $tipo, $duracao))) {
    echo "funcionou";
}
