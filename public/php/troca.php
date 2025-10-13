<?php
session_start();
$tipo = $_GET['tipo'];

switch($tipo){
    case '0':
        $_SESSION['tipo'] = 0;
        break;
    case '1':
        $_SESSION['tipo'] = 1;
        break;
    case '2':
        $_SESSION['tipo'] = 2;
        break;
}