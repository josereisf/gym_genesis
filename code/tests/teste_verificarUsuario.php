<?php
require_once __DIR__ . "/../funcao.php";
$email = "acabate@gmail.com";
$senha =null;
$tipo = null;

$usuario = verificarUsuario($email, $senha, $tipo);

if ($usuario) {
echo "Usuário encontrado!";
print_r($usuario);
} else {
echo "Usuário não encontrado.";
}
