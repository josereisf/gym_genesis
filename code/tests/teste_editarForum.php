<?php


require_once __DIR__ . '/../funcao.php';


$idtopico = 1;
$titulo = 'cegoha';
$descricao = 'muito chato';

if (!empty(editarForum($idtopico, $titulo, $descricao))) {
    echo "funcionou";
}
