<?php
require_once '../../code/funcao.php';


header('Content-Type: application/json');

// Lê os dados enviados
$data = json_decode(file_get_contents('php://input'), true);

$tipo = $data['tipo'];
$horario = $data['horario'];
$descricao = $data['descricao'];
$idtreino = $data['idtreino'];

if (editarTreino($tipo, $horario, $descricao, $idtreino)) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false]);
}
