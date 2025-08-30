<?php
require_once '../funcao.php';

// Dados de exemplo para o teste
$data_aula   = '2025-09-01';
$dia_semana = 'Segunda'; // e não 'Segunda-feira'
$hora_inicio = '10:00:00';
$hora_fim    = '11:00:00';
$idtreino    = 1;

$resultado = cadastrarAulaAgendada($data_aula, $dia_semana, $hora_inicio, $hora_fim, $idtreino);

if ($resultado) {
    echo "Cadastro de aula agendada realizado com sucesso!";
} else {
    echo "Falha ao cadastrar aula agendada.";
}
