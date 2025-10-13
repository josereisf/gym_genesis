<?php

require_once __DIR__ . "/../../code/funcao.php";
$codigoInserido = $_POST['codigo'] ?? '';
$email = $_POST['email'] ?? '';

$usuario = verificarUsuario($email);
$idusuario = $usuario['idusuario'];

header('Content-Type: application/json'); // Retorna JSON para o Ajax

$resultado = verificarCodigo($codigoInserido, $idusuario);

if ($resultado === true) {
    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Código verificado com sucesso!']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => $resultado]);
}