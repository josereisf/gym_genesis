<?php
require_once '../funcao.php';

$idusuario = 1;
$emails = [
    'diosep70@gmail.com',
    'pabloalmeidathe1@gmail.com',
    'kairobarbosa2007@gmail.com'
];

echo '<pre>';
print_r(gerarCodigosDeSegurancaa($emails, $idusuario));
echo '</pre>';