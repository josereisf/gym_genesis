<?php

require_once __DIR__ . '/../funcao.php';

$idusuario = 2;

if (!is_null(deletarUsuario($idusuario))){
    echo 'funcionou';
}
    
