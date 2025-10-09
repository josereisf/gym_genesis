<?php

require_once __DIR__ . "/../code/funcao.php";

$email = $_POST['email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($email)) {
        echo "Por favor, insira um email válido.";
    } else {
       $login = loginUsuario($email, $senha);
       if($login === false){ 
        echo "esse email nao existe"; 
       } elseif($login === true){ 
        gerarCodigoDeSeguranca($email);
        echo "Link de recuperação enviado para o email."; 
       } else {
        echo "Erro ao enviar email.";
       }
    }
}