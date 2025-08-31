<?php

require_once __DIR__ . '/../funcao.php';

$id = 1;

if (!empty(deletarItemPedido($id))) {
    echo "Item do pedido deletado com sucesso.";
} else {
    echo "Falha ao deletar o item do pedido.";
}
