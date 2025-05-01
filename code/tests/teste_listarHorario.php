<?php
require_once '../../code/funcao.php';

header('Content-Type: application/json');


$idhorario = null;

$json = json_encode(listarHorario($idhorario), JSON_UNESCAPED_UNICODE);
echo $json;


