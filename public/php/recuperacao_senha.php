<?php
require_once __DIR__ . "/../../code/funcao.php";

header('Content-Type: application/json'); // Retorna JSON para o Ajax

$email = $_POST['email'] ?? '';

if (empty($email)) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Por favor, insira um e-mail válido.']);
    exit;
}

$usuario = verificarUsuario($email);

if ($usuario === false) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Este e-mail não existe cadastrado.']);
    exit;
}

$idusuario = $usuario['idusuario'];
$resultado = enviarCodigoSeguranca($email, $idusuario);

// verificar se o envio deu certo
$sucesso = false;
foreach ($resultado as $res) {
    if ($res['status'] === 'enviado') {
        $sucesso = true;
        break;
    }
}

if ($sucesso) {
    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Código enviado com sucesso! Verifique seu e-mail.']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao enviar o código de segurança.']);
}
