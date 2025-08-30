<?php
require_once __DIR__ . '/../funcao.php';

$id = 1;
$cep = '223';
$rua = 'rua 3';
$numero = '4';
$complemento = '56';
$bairro = 'b6';
$cidade = 'z';
$estado = 'mt';
$tipo = '1';

if (!is_null(editarEndereco($cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $tipo, $id))) {
    echo 'funcionou';
}
