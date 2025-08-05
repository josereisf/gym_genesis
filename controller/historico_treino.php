<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idhistorico = $_POST['idistoricotreino'] ?? 0;
$data_execucao = $_POST['data_execucao'] ?? null;
$observacoes = $_POST['observacoes'] ?? null;
$idusuario = $_POST['idusuario'] ?? null;
$idtreino = $_POST['idtreino'] ?? null;

switch ($acao) {
    case 'cadastrar':
        cadastrarHistoricoTreino($idusuario, $idtreino, $data_execucao, $observacoes);
        break;
    case 'editar':
        editarHistoricoTreino($idhistrico, $data_execucao, $observacoes);
        break;
    case 'listar':
        listarRefeicoes($idHistoricoTreino);
        break;
    case 'deletar':
        deletarHistoricoTreino($idHistoricoTreino);
        break;
}