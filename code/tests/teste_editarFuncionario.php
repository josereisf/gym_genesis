<?php
require_once '../funcao.php';

// Dados de teste — certifique-se que esse ID de funcionário já exista
$idfuncionario = 1;
$nome = "Carlos Silva";
$email = "carlos.silva@example.com";
$telefone = "1234567";
$data_contratacao = "2024-01-15";
$salario = 4500.00;
$cargo_id = 2; // ID de um cargo existente

$resultado = editarFuncionario($idfuncionario, $nome, $email, $telefone, $data_contratacao, $salario, $cargo_id);

if ($resultado) {
    echo "Funcionário atualizado com sucesso!";
} else {
    echo "Falha ao atualizar funcionário.";
}
?>