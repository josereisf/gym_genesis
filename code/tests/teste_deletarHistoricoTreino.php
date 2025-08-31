<?php

require_once __DIR__ . '/../funcao.php';

$id = 1;

$resposta = deletarHistoricoTreino($id);

if ($resposta) {
    echo "Histórico de treino deletado com sucesso.";
} else {
    echo "Falha ao deletar o histórico de treino.";
}