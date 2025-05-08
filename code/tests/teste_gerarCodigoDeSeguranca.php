<?php
require_once '../funcao.php';

$email_destinatario ='pabloalmeidathe1@gmail.com';
echo '<pre>';
print_r(gerarCodigoDeSeguranca($email_destinatario));
echo '</pre';