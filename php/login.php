<?
require_once '../code/funcao.php';
session_start(); // Precisa estar no topo antes de qualquer header()

$email = $_GET['email'] ?? '';
$senha = $_GET['senha'] ?? '';

// Verifica campos vazios
if (empty($email) || empty($senha)) {
    $_SESSION['erro_login'] = 'Preencha todos os campos.';
    header('Location: ../public/login.php');
    exit();
}

$usuario = loginUsuario($email, $senha);

if ($usuario !== null) {
    $tipo = verificarTipoUsuario($email);

    if ($tipo === null || $tipo === false) {
        $_SESSION['erro_login'] = 'Credenciais inválidas ou Usuario não reconhecido.';
        header('Location: ../public/login.php');
        exit();
    }

    // Redirecionamento por tipo
    if ($tipo == 0) {
        header('Location: ../public/dashboard_administrador.html');
        exit();
    }

    if ($tipo == 2) {
        header('Location: ../public/dashboard_professor.html');
        exit();
    }

    // Tipo padrão (aluno)
    $usuarioId = $usuario['id'];
    $resposta = listarAvaliacaoFisica($usuarioId);

    $_SESSION['id'] = $usuarioId;
    $_SESSION['email'] = $email;
    $_SESSION['nome'] = $usuario['nome'];

    if ($resposta) {
        header('Location: ../public/dashboard_usuario.php');
    } else {
        header('Location: ../public/primeira_avaliacao.php');
    }

    exit();
} else {
    $_SESSION['erro_login'] = 'E-mail ou senha incorretos.';
    header('Location: ../public/login.php');
    exit();
}
?>