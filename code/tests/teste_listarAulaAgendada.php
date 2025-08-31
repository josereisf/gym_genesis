<?php
require_once __DIR__ . '/../funcao.php';


// Dados de exemplo para o teste
$data_aula   = '2025-09-01';
$dia_semana = 'Segunda'; // e não 'Segunda-feira'
$hora_inicio = '10:00:00';
$hora_fim    = '11:00:00';
$idtreino    = 1;

$resultado = listarAulaAgendada($idtreino);

var_dump($resultado);