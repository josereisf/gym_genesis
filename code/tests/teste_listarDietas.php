<?php
require_once '../../code/funcao.php';

 header('Content-Type: application/json');
$idusuario = null;

$json = json_encode(listarDietas($idusuario), JSON_UNESCAPED_UNICODE);
echo $json;


