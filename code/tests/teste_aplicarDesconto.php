<?php
require_once __DIR__ . '/../funcao.php';


$idpagamento = 1;
$idcupom = 1;

echo '<pre>';
print_r(aplicarDesconto($idpagamento, $idcupom));
print_r(listarPagamentos($idpagamento));
echo '</pre';
