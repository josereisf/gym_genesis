<?php
require_once __DIR__ . '/../funcao.php';


// Dados de exemplo para o teste
$data_inicio = '2025-08-30';
$data_fim = '2025-09-30';
$idusuario = 1;
$idassinatura = 1;

$resultado = editarAssinatura($idassinatura, $data_inicio, $data_fim,  $idusuario);

if ($resultado) {
    echo "Edição de assinatura realizada com sucesso!";
} else {
    echo "Falha ao editar assinatura.";
}
