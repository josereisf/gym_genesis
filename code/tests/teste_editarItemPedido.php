<?php

require_once '../funcao.php';

$idtreino2 = 3;
$treino_id = 3;
$exercicio_id = 1;
$series = 5;
$repeticoes = 3;
$carga = 6;
$intervalo_segundos = 15;

$funcionou = editarTreinoExercicio($idtreino2, $treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos);

if ($funcionou === true) {
    echo "Deu tudo certo<br>";

    $conexao = conectar();
    $sql = "SELECT * FROM treino_exercicio WHERE idtreino2 = '$idtreino2'";
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
    echo "Algo de errado não está certo";
}
