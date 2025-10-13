<?php

$local = $_REQUEST['saida'] ?? '../login.php';
session_start();

session_destroy();

header("Location: $local");
exit();