<?php
require_once '../funcao.php';

$idusuario = 1;
$email_destinatario ='pabloalmeidathe1@gmail.com';
echo '<pre>';
print_r(gerarCodigoDeSeguranca($email_destinatario, $idusuario));
echo '</pre';