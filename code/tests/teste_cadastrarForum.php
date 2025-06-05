<?php


require_once '../funcao.php';

$titulo = 'Hoje tem'; 
$descricao = 'tem nada'; 
$usuario_idusuario = 1;

if (!empty(cadastrarForum($titulo, $descricao, $usuario_idusuario))){
    echo "funcionou";
}
