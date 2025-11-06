<?php

$id = $_GET['id'];

session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}


if (isset($_SESSION['carrinho'][$id]))
$_SESSION['carrinho'][$id] += 1;
else {
    $_SESSION['carrinho'][$id] = 1;
}
  