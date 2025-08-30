<?php
require_once __DIR__ . '/../funcao.php';


$idresposta = 2;
$funcionou = deletarRespostaForum($idresposta);
if ($funcionou === true) {
    echo "funcionou";
} else {
    echo "nao funcionou";
}
