<?php


require_once '../funcao.php';

$idhostorico = 1;
$data_execucao = '2031-03-04 21:12:03';
$observacoes = 'Bem observado';

if (!empty(editarHistoricoTreino($idhostorico, $data_execucao, $observacoes))){
    echo "funcionou";
}
