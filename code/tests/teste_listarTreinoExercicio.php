<?php

header('Content-Type: application/json');



$idtreino2 = null;

$json = json_encode(listarTreinoExercicio($idtreino2), JSON_UNESCAPED_UNICODE);
echo $json;
