<?php

require_once '../funcao.php';

$idexercicio = 1;
$nome = 'ska';
$grupo_muscular = 'neuronio';
$descricao = 'sem ideia';
$video_url = '/naoexiste.png';


if (!is_null(editarExercicio($idexercicio, $nome, $grupo_muscular, $descricao, $video_url))){
    echo "funcionou";
}
