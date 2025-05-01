<?php

header('Content-Type: application/json');

 

$json = json_encode(listarEnderecos($tipo), JSON_UNESCAPED_UNICODE);
echo $json;

?>