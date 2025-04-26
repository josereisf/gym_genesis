<?php
require_once '../../code/funcao.php';


header('Content-Type: application/json');

$treinos = listarTreino(null);
echo json_encode($treinos);
