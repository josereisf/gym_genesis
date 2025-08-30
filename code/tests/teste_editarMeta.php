<?php

require_once __DIR__ . '/../funcao.php';


$idmeta = 1;
$descricao = 'procrastinar';
$data_inicio = '2007-11-11';
$data_limite = '2099-12-12';
$status = 'ativa';


if (!is_null(editarMetaUsuario($idmeta, $descricao, $data_inicio, $data_limite, $status))) {
    echo "funcionou";
}
