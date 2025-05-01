<?php

 header('Content-Type: application/json');

 
$idfuncionario = null;

$json = json_encode(listarFuncionarios($idfuncionario), JSON_UNESCAPED_UNICODE);
echo $json;
