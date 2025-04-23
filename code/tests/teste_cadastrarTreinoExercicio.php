<?php

require_once '../funcao.php';
$treino_id = 2;
$exercicio_id = 2;
$series = 5;
$repeticoes = 2;
$carga = 2;
$intervalo_segundos = 2;

$idInserido = cadastrarTreinoExercicio($treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos);

if ($idInserido !== null) {
    echo "Deu tudo certo! ID inserido: $idInserido<br>";

    $conexao = conectar();
    $sql = "SELECT * FROM treino_exercicio WHERE idtreino2 = $idInserido";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            echo "<pre>";
            print_r($linha);
            echo "</pre>";
        }
    } else {
        echo "Nenhum dado encontrado.";
    }

    desconectar($conexao);
} else {
    echo "Algo de errado não está certo.";
}