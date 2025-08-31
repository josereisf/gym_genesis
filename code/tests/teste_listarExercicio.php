<?php
require_once __DIR__ . '/../funcao.php';


header('Content-Type: application/json');

$idexercicio = null;

$json = json_encode(listarExercicio($idexercicio), JSON_UNESCAPED_UNICODE);
echo $json;
