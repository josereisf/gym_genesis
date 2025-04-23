<?php
require_once '../funcao.php';

$idavaliacao = 2;
$peso = 75.5;
$altura = 1.78;
$imc = $peso / ($altura * $altura); // IMC calculado automaticamente
$percentual_gordura = 18.2;
$data_avaliacao = '2025-04-22';
$usuario_idusuario = 1;

$conexao = conectar();

if (editarAvaliacaoFisica($idavaliacao, $peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $usuario_idusuario)) {
    echo "✅ Avaliação física editada com sucesso!";
} else {
    echo "❌ Erro ao editar a avaliação física.<br>";

    // Tenta obter o erro diretamente da conexão, se disponível
    if ($conexao) {
        echo "Erro MySQL: " . mysqli_error($conexao);
    } else {
        echo "Não foi possível conectar para capturar o erro.";
    }
}

desconectar($conexao);
