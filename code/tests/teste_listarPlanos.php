<?php
require_once __DIR__ . '/../funcao.php';


header('Content-Type: application/json');

$idplano = 1;
$data_inicio = date('Y-m-d');

// Retorna algo como: [ [ "idplano" => 1, "tipo" => "Mensal", "duracao" => "30 dias" ] ]
$plano = listarPlanos($idplano);

if (isset($plano[0]['tipo']) && isset($plano[0]['duracao'])) {
    $tipo = $plano[0]['tipo'];
    $duracao = $plano[0]['duracao']; // ex: "30 dias"

    // Extrai o número de dias da string "30 dias"
    preg_match('/(\d+)/', $duracao, $matches);
    $dias = isset($matches[1]) ? (int)$matches[1] : 0;

    // Calcula a data final com base na duração
    $data_fim = date('Y-m-d', strtotime("+$dias days", strtotime($data_inicio)));

    echo json_encode([
        'data_inicio' => $data_inicio,
        'data_fim' => $data_fim,
        'tipo' => $tipo,
        'duracao' => $duracao
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['erro' => 'Plano inválido ou dados incompletos']);
}
