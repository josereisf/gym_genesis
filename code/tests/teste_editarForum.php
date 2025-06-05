<?php


require_once '../funcao.php';

$idtopico = 1;
$titulo = 'cegoha';
$descricao = 'muito chato';

if (!empty(editarForum($idtopico, $titulo, $descricao))){
    echo "funcionou";
}
