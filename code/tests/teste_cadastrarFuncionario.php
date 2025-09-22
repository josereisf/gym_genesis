<?php

require_once __DIR__ . '/../funcao.php';


$nome = "Funcionário de teste";
$data_contratacao = "2024-06-01";
$salario = 3000.00;
$cargo_id = 1;
$usuario_id = 1;

$resposta = cadastrarFuncionario($nome,$data_contratacao, $salario, $cargo_id, $usuario_id);

if ($resposta) {
    echo "Teste de cadastro de funcionário aprovado.";
} else {
    echo "Teste de cadastro de funcionário reprovado.";
}
