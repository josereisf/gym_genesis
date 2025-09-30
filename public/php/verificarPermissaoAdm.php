<?php 
if ($_SESSION['tipo'] != 0) {
$_SESSION['erro_login'] = "Usuário não permitido!";
header('Location: dashboard_usuario.php');
exit;
}
