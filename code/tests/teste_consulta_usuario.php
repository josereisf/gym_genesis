<?php
require_once __DIR__ . '/../funcao.php';


header('Content-Type: application/json; charset=utf-8');

$data = listarUsuarioCompleto(1);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
