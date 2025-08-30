<?php

require_once __DIR__ . '/../funcao.php';


// Dados de teste
$pedido_id = 2;       // ID válido na tabela pedido
$produto_idproduto = 3;     // ID válido na tabela produto
$quantidade = 10;
$preco_unitario = 25.99;    // Novo valor para o UPDATE

// Teste da função
$funcionou = editarItemPedido($pedido_id, $produto_idproduto, $quantidade, $preco_unitario);

if ($funcionou === true) {
    echo "Deu tudo certo<br>";

    $conexao = conectar();
    $sql = "SELECT * FROM item_pedido WHERE pedido_id = '$pedido_id' AND produto_idproduto = '$produto_idproduto'";
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
