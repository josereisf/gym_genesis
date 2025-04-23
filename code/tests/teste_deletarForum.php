<?php
require_once '../funcao.php';

$idtopico = 3;
$funcionou = deletarForum($idtopico);
if($funcionou === true){
    echo "funcionou";
}else{
    echo "nao funcionou";
}
?>