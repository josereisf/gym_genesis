<?php
session_start();

$id = $_GET['id'] ?? null;

if ($id && isset($_SESSION['carrinho'][$id])) {
    unset($_SESSION['carrinho'][$id]);
    echo json_encode(['status' => true, 'mensagem' => 'Produto removido']);
} else {
    echo json_encode(['status' => false, 'mensagem' => 'Produto não encontrado']);
}