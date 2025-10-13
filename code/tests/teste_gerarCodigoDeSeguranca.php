<?php
require_once __DIR__ . '/../funcao.php';


$idusuario = 1;
$emails = [
    'pabloalmeidathe1@gmail.com',
    'kairobarbosa2007@gmail.com'
];

echo '<pre>';
print_r(enviarCodigoSeguranca($emails, $idusuario));
echo '</pre>';
