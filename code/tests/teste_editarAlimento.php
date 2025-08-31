<?php
require_once __DIR__ . '/../funcao.php';


// Dados de exemplo para o teste
$idalimento = 1; // ID do alimento que você deseja editar
$nome = 'Banana';
$calorias = 89;
$carboidratos = 23;
$proteinas = 1.1;
$gorduras = 0.3;
$porcao = '100g';
$categoria = 'Fruta';
$imagem = 'banana.jpg';

$resultado = editarAlimento($idalimento, $nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem);

if ($resultado) {
    echo "Edição de alimento realizada com sucesso!";
} else {
    echo "Falha ao editar alimento.";
}
