<?php
$dir = __DIR__ . '/tests';

if (!isset($_POST['arquivo']) || empty($_POST['arquivo'])) {
    echo "Nenhum arquivo selecionado.";
    exit;
}

$arquivo = basename($_POST['arquivo']); // previne traversal
$caminho = "$dir/$arquivo";

if (!file_exists($caminho)) {
    echo "Arquivo não encontrado.";
    exit;
}

// Captura a saída do teste
ob_start();
include $caminho;
$output = ob_get_clean();

echo $output;
