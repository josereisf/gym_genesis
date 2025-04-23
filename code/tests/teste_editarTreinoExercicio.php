<?php

require_once '../funcao.php';

// Dados de exemplo para teste
$iditem = 1; // ID do item já existente na tabela item_pedido
$pedido_idpedido = 2; // ID de um pedido válido existente
$produto_idproduto = 3; // ID de um produto válido existente
$quantidade = 5; // Nova quantidade

$resultado = editarItemPedido($iditem, $pedido_idpedido, $produto_idproduto, $quantidade);

if ($resultado) {
    echo "Item do pedido editado com sucesso!";
} else {
    echo "Falha ao editar o item do pedido.";
}
?>