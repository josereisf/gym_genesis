<?php

require_once __DIR__ . '/../funcao.php';

$idHistorico = 1;
$peso = 75.5;

$resposta = editarHistoricoPeso($idHistorico, $peso);

if ($resposta) {
    echo "Edição realizada com sucesso!";
} else {
    echo "Erro ao editar histórico de peso.";
}