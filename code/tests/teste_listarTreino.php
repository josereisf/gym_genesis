<?php
require_once '../../code/funcao.php';

header('Content-Type: application/json');

$idtreino = null;
$json = json_encode(listarTreino($idtreino), JSON_UNESCAPED_UNICODE);
echo $json;
