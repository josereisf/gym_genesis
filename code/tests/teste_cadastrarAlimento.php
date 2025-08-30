<?php
require_once '../funcao.php';

// Dados de exemplo para o teste
$nome = 'Banana';
$calorias = 89;
$carboidratos = 23;
$proteinas = 1.1;
$gorduras = 0.3;
$porcao = '100g';
$categoria = 'Fruta';
$imagem = 'banana.jpg';

$resultado = cadastrarAlimento($nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem);

if ($resultado) {
    echo "Cadastro de alimento realizado com sucesso!";
} else {
    echo "Falha ao cadastrar alimento.";
}