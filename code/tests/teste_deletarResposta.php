<?php


require_once __DIR__ . '/../funcao.php';


$mensagem = 'asfESDGATJSfdhd';
$idusuario = 1;
$idtopico = 1;

if (!empty(deletarRespostaForum($idtopico))) {
    echo "Resposta deletada com sucesso.";
}
