<?php

require_once '../funcao.php';

// ID opcional via GET ou fixo
$iddieta_alimentar = isset($_GET['id']) ? (int)$_GET['id'] : 3;

echo "<h2>Resultados para dieta_alimento (ID: {$iddieta_alimentar})</h2>";
echo "<pre>";

try {
    $resultados = listarDietaAlimentos($iddieta_alimentar);

    if (!empty($resultados)) {
        print_r($resultados);
    } else {
        echo "Nenhum resultado encontrado para o ID especificado.";
    }
} catch (Exception $e) {
    echo "Erro ao buscar dados: " . $e->getMessage();
}

echo "</pre>";
