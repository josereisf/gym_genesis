<?php

require_once '../funcao.php';

$idcargo = 1;
$nome ='clt';
$descricao = 'escravo legalizado';

if (!is_null(editarCargo($idcargo, $nome, $descricao)
)){
    echo "funcionou";
}
