<?php


require_once __DIR__ . '/../funcao.php';


$codigo = '234';
$percentual_desconto = 3;
$valor_desconto = 12.40;
$data_validade = '2031-05-03';
$quantidade_uso = 1;
$tipo = 1;

if (!empty(cadastrarCupomDesconto($codigo, $percentual_desconto, $valor_desconto, $data_validade, $quantidade_uso, $tipo))) {
    echo "funcionou";
}
