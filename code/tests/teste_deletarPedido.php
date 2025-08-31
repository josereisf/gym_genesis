<?php


require_once __DIR__ . '/../funcao.php';


$idusuario = 1;

if (!empty(deletarPedido($idusuario))) {
    echo "Pedido deletado com sucesso.";
} else {
    echo "Falha ao deletar o pedido.";
}
