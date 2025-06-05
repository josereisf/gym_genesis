<?php
$img = $_GET['img'] ?? '';
$caminho = './teste_imagem/' . basename($img);

if (!file_exists($caminho)) {
    header("HTTP/1.0 404 Not Found");
    echo "Imagem não encontrada.";
    exit;
}

$tipo = mime_content_type($caminho);
header("Content-Type: $tipo");
readfile($caminho);
