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

$resultado = listarEnderecos($id);

var_dump($resultado);   