<?php
require_once __DIR__ . '/../funcao.php';

$idtreino = 1;

$resultado = listarAulaAgendadaUsuario($idtreino);

var_dump($resultado);