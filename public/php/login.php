<?php
require_once __DIR__ . '/../../code/funcao.php';
session_start();

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    $_SESSION['erro_login'] = 'Preencha todos os campos.';
    header('Location: ../login.php');
    exit();
}

$usuario = loginUsuario($email, $senha);

// var_dump($usuario); // debug temporário

if (empty($usuario) || empty($usuario['id']) || $usuario['status'] === false) {
    $_SESSION['erro_login'] = 'E-mail ou senha incorretos.';
    header('Location: ../login.php');
    exit();
}



$tipo = verificarTipoUsuario($email);
if ($tipo === null || $tipo === false) {
    $_SESSION['tentativas_login'] = ($_SESSION['tentativas_login'] ?? 0) + 1;
    
    if ($_SESSION['tentativas_login'] >= 5) {
        $_SESSION['erro_login'] = '⚠️ Detectamos várias tentativas de acesso sem sucesso. 
        Recomendamos que você refaça seu cadastro. 
        Se você já possui cadastro e continua enfrentando problemas, por favor, entre em contato com o administrador do sistema.';
        header('Location: ../login.php');
        exit();
    }
    
    $_SESSION['erro_login'] = '❌ Usuário ou senha inválidos. Verifique suas credenciais e tente novamente.';
    header('Location: ../login.php');
    exit();
}

// Redirecionamentos por tipo
if ($tipo == 0) {
    header('Location: ../dashboard_administrador.html');
    exit();
}

if ($tipo == 2) {
    $professorId = $usuario['id'];
    $perfil = listarPerfilProfessor($professorId);
    $nome = $perfil[0]['nome_professor'] ?? '';
    
    $_SESSION['id'] = $professorId;
    $_SESSION['email'] = $email;
    $_SESSION['nome'] = $nome;
    $_SESSION['tipo'] = $tipo;
    
    $_SESSION['tentativas_login'] = 0;
    header('Location: ../dashboard_professor.php');
    exit();
}

// Tipo padrão (aluno)
$usuarioId = $usuario['id'];
$resposta = listarAvaliacaoFisica($usuarioId);
$perfilUsuario = listarPerfilUsuario($usuarioId);
$nome = $perfilUsuario[0]['nome_usuario'] ?? '';

// var_dump($nome);
$_SESSION['id'] = $usuarioId;
$_SESSION['email'] = $email;
$_SESSION['nome'] = $nome;
$_SESSION['tipo'] = $tipo;
$_SESSION['tentativas_login'] = 0;

if ($resposta) {
    header('Location: ../dashboard_usuario.php');
} else {
    header('Location: ../primeira_avaliacao.php');
}
exit();
