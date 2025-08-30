<?php
require_once __DIR__ . '/../funcao.php';


$id = 1;

$tipo = '1';

if (!is_null(deletarEndereco($id, $tipo))) {
    echo 'funcionou';
}
