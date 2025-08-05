<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idtreino = $_POST['idtreino'] ?? 0;
$series = $_POST['series'] ?? null;
$repeticoes = $_POST['repeticoes'] ?? null;
$carga = $_POST['carga'] ?? null;
$intervalo_segundos = $_POST['intervalo'] ?? null;
$treino_id = $_POST['treino_id'] ?? null;
$exercicio_id = $_POST['exercicio_id'] ?? null;


switch ($acao) {
    case 'cadastrar':
        cadastrarTreinoExercicio($treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos);
        break;
    case 'editar':
        editarTreinoExercicio($idtreino, $treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos);
        break;
    case 'listar':
        listarTreinoExercicio($idtreino);
        break;
    case 'deletar':
        deletarTreinoExercicio($idtreino);
        break;
}