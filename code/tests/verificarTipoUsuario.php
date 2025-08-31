<?php
require_once __DIR__ . '/../funcao.php';

$email = "acabate@gmail.com";
$tipo = verificarTipoUsuario($email);

if ($tipo) {
    echo "Tipo do usuário: $tipo";
} else {
    echo "Usuário não encontrado.";
}
