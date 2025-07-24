<?php

require_once '../funcao.php';

$idusuario = 4;
$foto = $_FILES['foto'] ?? 123412344;

var_dump(atualizarFotoUsuario($foto, $idusuario));