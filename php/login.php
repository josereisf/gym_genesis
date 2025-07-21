<?php

require_once '../code/funcao.php';

$email = $_GET['email'] ?? '';
$senha = $_GET['senha'] ?? '';

if (empty($email) || empty($senha)) {
    header('Location: ../public/login.html?error=empty_fields');
    exit();
}

$usuario = loginUsuario($email, $senha); // agora deve retornar os dados do usuário, não só true/false

if ($usuario !== null) {
    $tipo = verificarTipoUsuario($email); // ou $usuario['tipo'], se já vier junto

    if ($tipo == 0) {
        header('Location: ../public/dashboard_administrador.html');
        exit();
    } elseif ($tipo == 2) {
        header('Location: ../public/dashboard_professor.html');
        exit();
    } else {
        $usuarioId = $usuario['id']; // ou $usuario['id_usuario'], dependendo de como está estruturado
        session_start();
        $_SESSION['usuario_id'] = $usuarioId;
        $_SESSION['usuario_email'] = $email;
        $_SESSION['usuario_nome'] = $usuario['nome']; // opcional, se quiser
        header('Location: ../public/dashboard_usuario.php');
        exit();
    }
} else {
    header('Location: ../public/login.html?error=invalid_credentials');
    exit();
}
