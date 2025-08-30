<?php
require_once __DIR__ . '/../funcao.php';

header('Content-Type: application/json');

$json = json_encode(listarAssinaturas(null), JSON_UNESCAPED_UNICODE);
echo $json;
