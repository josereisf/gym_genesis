<?php
require_once __DIR__ . '/../funcao.php';


// Dados de exemplo para o teste
$id = 1;

$resultado = deletarAlimento($id);

if ($resultado) {
    echo "Deleção de alimento realizado com sucesso!";
} else {
    echo "Falha ao deletar alimento.";
}
