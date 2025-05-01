<?php
require_once '../../code/funcao.php';

header('Content-Type: application/json');

$tipo=null;

$json = json_encode(listarEnderecos($tipo), JSON_UNESCAPED_UNICODE);
echo $json;

?>