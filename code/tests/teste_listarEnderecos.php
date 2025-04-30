<?php

require_once '../funcao.php';
header('Content-Type: application/json');

$id = null;
$tipo = null;

$json = json_encode(listarEnderecos($tipo), JSON_UNESCAPED_UNICODE);
echo $json;

?>