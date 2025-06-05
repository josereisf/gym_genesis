<?php


require_once '../funcao.php';

$mensagem = 'asfESDGATJSfdhd';
$idusuario = 1;
$idtopico = 1;

if (!empty(cadastrarRespostaForum($mensagem, $idusuario, $idtopico))){
    echo "funcionou";
}
