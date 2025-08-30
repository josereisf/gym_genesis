<?php
require_once __DIR__ . '/../funcao.php';


// Dados de exemplo para o teste
$nome      = 'Instrutor de Musculação';
$descricao = 'Responsável por acompanhar e orientar os treinos de musculação.';

$resultado = cadastrarCargo($nome, $descricao);

if ($resultado) {
    echo "✅ Cargo cadastrado com sucesso!";
} else {
    echo "❌ Falha ao cadastrar cargo.";
}
