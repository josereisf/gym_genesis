<?php

require_once __DIR__ . '/../funcao.php';

$id = 1;

if (!empty(deletarHistoricoPeso($id))) {
    echo "Histórico de peso deletado com sucesso.";
} else {
    echo "Falha ao deletar o histórico de peso.";
}
