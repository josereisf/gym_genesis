<?php

 header('Content-Type: application/json');

 

$json = json_encode(listarExercicio($idexercicio), JSON_UNESCAPED_UNICODE);
echo $json;

