<?php

require_once __DIR__. '/../../code/funcao.php'; // ajuste o caminho

header('Content-Type: application/json');
$conexao = conectar();
// Pega o código enviado
$codigo = '';
if (isset($_POST['codigo'])) {
    $codigo = trim($_POST['codigo']);
}

// Se não enviou nada, já retorna inválido
if ($codigo == '') {
    echo json_encode(['valido' => false]);
    exit;
}

// Prepara a consulta SQL
$sql = "SELECT codigo, tipo, percentual_desconto, valor_desconto, data_validade, quantidade_uso
        FROM cupom_desconto
        WHERE codigo = ?
        AND data_validade >= CURDATE()
        AND quantidade_uso > 0";

$comando = mysqli_prepare($conexao, $sql);

// Se der erro na preparação
if (!$comando) {
    echo json_encode(['valido' => false, 'erro' => 'Erro na preparação da consulta']);
    exit;
}

// Faz o bind do parâmetro (s = string)
mysqli_stmt_bind_param($comando, "s", $codigo);

// Executa a consulta
mysqli_stmt_execute($comando);

// Pega o resultado
$resultado = mysqli_stmt_get_result($comando);

// Verifica se encontrou algum cupom
if ($resultado && mysqli_num_rows($resultado) > 0) {
    $cupom = mysqli_fetch_assoc($resultado);

    // Define o valor de desconto com base no tipo
    if ($cupom['tipo'] == 'percentual') {
        $valor = $cupom['percentual_desconto'];
    } else {
        $valor = $cupom['valor_desconto'];
    }

    // Retorna o resultado
    echo json_encode([
        'valido' => true,
        'tipo' => $cupom['tipo'],
        'valor' => $valor
    ]);
} else {
    echo json_encode(['valido' => false]);
}

// Fecha o statement e a conexão
mysqli_stmt_close($comando);
mysqli_close($conexao);
?>
