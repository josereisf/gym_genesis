<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idaula = $_POST['idaula'] ?? 0;
$tipo = $_POST['nome'] ?? null;
$horario = $_POST['horario'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$idusuario = $_POST['idusuario'] ?? null;


switch ($acao) {
    case 'cadastrar':
        cadastrarAulaAgendada($data_aula, $dia_semana, $hora_inicio, $hora_fim, $idusuario, $idtreino);
        break;
    case 'editar':
        editarAulaAgendada($data_aula, $dia_semana, $hora_inicio, $hora_fim, $idusuario, $idtreino, $idaula);
        break;
    case 'listar':
        listarAulaAgendada($idaula);
        break;
    case 'deletar':
        deletarAulaAgendada($idaula);
        break;
}