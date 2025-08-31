<?php

require_once __DIR__ . '/../funcao.php';


$tipo = 'flexão';
$horario = '06:00:00';
$descricao = 'fazer 2 milhões de vezes';
$idusuario = 1;


if (!is_null(deletarTreino($idusuario))) {
    echo "Treino deletado com sucesso.";
}
