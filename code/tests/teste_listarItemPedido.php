<?php

require_once __DIR__ . '/../funcao.php';


header('Content-Type: application/json');

$usuario_id = null;

$json = json_encode(
    listarItemPedido($usuario_id),
    JSON_UNESCAPED_UNICODE
);
echo $json;
