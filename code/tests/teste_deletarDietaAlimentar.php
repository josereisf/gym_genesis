<?php

require_once __DIR__ . '/../funcao.php';

$id = 1;
$id2 = 2;
if (!empty(deletarDietaAlimentar($id, $id2))) {
    echo "Dieta deletada com sucesso.";
} else {
    echo "Falha ao deletar a dieta.";
}
