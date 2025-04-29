<?php

require_once '../funcao.php';

$id = 1;
$tipo = 2;

echo '<pre>';
print_r(listarEnderecosID($id, $tipo));
echo '</pre';