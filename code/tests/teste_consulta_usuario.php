<?php
require_once '../funcao.php';

header('Content-Type: application/json; charset=utf-8');

$data = listarUsuarioCompleto(3);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
