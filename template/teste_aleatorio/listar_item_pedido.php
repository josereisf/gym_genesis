<?php
header('Content-Type: application/json');

// Aqui você faria consulta no banco, mas pra teste vamos mandar dados fixos

$itens = [
    [
        "pedido_idpedido" => 1,
        "produto_idproduto" => 101,
        "nome_cliente" => "João",
        "nome_produto" => "Caneta Azul",
        "quantidade" => 10,
        "preco_unitario" => 1.50
    ],
    [
        "pedido_idpedido" => 1,
        "produto_idproduto" => 102,
        "nome_cliente" => "João",
        "nome_produto" => "Caderno",
        "quantidade" => 5,
        "preco_unitario" => 12.00
    ]
];

echo json_encode($itens);
