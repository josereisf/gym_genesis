<?php

require_once __DIR__ . '/../funcao.php';
header('Content-Type: application/json; charset=utf-8');

$idusuario = 1;

$resultado = listarHistoricoTreino($idusuario);

echo json_encode($resultado, JSON_UNESCAPED_UNICODE);