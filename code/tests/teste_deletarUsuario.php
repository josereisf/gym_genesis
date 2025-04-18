<?php

require_once('../funcao.php');

$idusuario = 2;

if (!is_null(deletarUsuario($idusuario))){
    echo 'funcionou';
}
    
