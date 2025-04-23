<?php

require_once '../funcao.php';
$usuario_id = 2;
$treino_id = 2;
$data_execucao = date("Y-m-d"); // data atual no formato 'YYYY-MM-DD'
$observacoes = "Treino realizado com sucesso."; // observação descritiva

$idInserido = cadastrarHistoricoTreino($usuario_id, $treino_id, $data_execucao, $observacoes);

if ($idInserido !== null) {
    echo "Deu tudo certo! ID inserido: $idInserido<br>";

    $conexao = conectar();
    $sql = "SELECT * FROM historico_treino WHERE idhistorico = $idInserido";
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