<?php
// Incluindo o arquivo com a função que será testada
require_once '../funcao.php';

// Dados de teste
$peso = 75.5;  // Peso em kg
$altura = 1.78; // Altura em metros
$imc = 23.8;    // IMC calculado
$percentual_gordura = 18.5; // Percentual de gordura
$data_avaliacao = 'Null'; // Data da avaliação
$usuario_idusuario = 1; // ID de usuário (substitua pelo ID de um usuário existente)

// Chamando a função para cadastrar a avaliação física
$resultado = cadastrarAvaliacaoFisica($peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $usuario_idusuario);

// Verificando o resultado
if ($resultado) {
    echo "A avaliação física foi cadastrada com sucesso!";
} else {
    echo "O cadastro da avaliação física falhou.";
}
?>
