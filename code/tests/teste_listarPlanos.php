<?php

 header('Content-Type: application/json');

 
$idplano = null;

$json = json_encode(listarPlanos($idplano), JSON_UNESCAPED_UNICODE);
echo $json;

