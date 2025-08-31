<?php
require_once __DIR__ . '/../funcao.php';


// Dados de exemplo para o teste
$id = 1;

$resultado = deletarAulaAgendada($id);

if ($resultado) {
    echo "Deleção de aula agendada realizada com sucesso!";
} else {
    echo "Falha ao deletar aula agendada.";
}
