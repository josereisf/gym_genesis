<?php 
session_start();
$_SESSION['id'] = $_GET['id'] ?? 21;
print_r($_SESSION);
?>