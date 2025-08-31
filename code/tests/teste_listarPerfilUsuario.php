<?php 

require_once __DIR__ . '/../funcao.php';

$resultado = listarPerfilUsuario(1);

var_dump($resultado[0]['nome']);