<?php

require_once __DIR__ . '/../funcao.php';

$id = 1;

if (!empty(deletarExercicio($id))) {
    echo "Exercício deletado com sucesso.";
} else {
    echo "Falha ao deletar o exercício.";
}
