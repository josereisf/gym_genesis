<?php
require_once __DIR__ . '/../funcao.php';


$idtopico = 3;
$funcionou = deletarForum($idtopico);
if ($funcionou === true) {
    echo "funcionou";
} else {
    echo "nao funcionou";
}
