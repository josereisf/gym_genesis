<?
require_once '../code/funcao.php';
session_start(); // Precisa estar no topo antes de qualquer header()

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
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
        // Incrementa as tentativas de login
        if (!isset($_SESSION['tentativas_login'])) {
            $_SESSION['tentativas_login'] = 1;
        } else {
            $_SESSION['tentativas_login']++;
        }

        // Verifica se excedeu o limite de tentativas
        if ($_SESSION['tentativas_login'] >= 5) {
            $_SESSION['erro_login'] = '⚠️ Detectamos várias tentativas de acesso sem sucesso. 
        Recomendamos que você refaça seu cadastro. 
        Se você já possui cadastro e continua enfrentando problemas, por favor, entre em contato com o administrador do sistema.';

            header('Location: ../public/login.php');
            exit;
        }

        // Mensagem de erro padrão (para menos de 5 tentativas)
        $_SESSION['erro_login'] = '❌ Usuário ou senha inválidos. Verifique suas credenciais e tente novamente.';
        header('Location: ../public/login.php');
        exit;
    }


    // Redirecionamento por tipo
    if ($tipo == 0) {
        header('Location: ../public/dashboard_administrador.html');
        exit();
    }

    if ($tipo == 2) {

    // Tipo padrão (aluno)
    $usuarioId = $usuario['id'];
    $resposta = listarAvaliacaoFisica($usuarioId);
    $usuario = listarPerfilUsuario($usuarioId);
    $usuario['nome'] = $usuario[0]['nome'];
    $_SESSION['id'] = $usuarioId;
    $_SESSION['email'] = $email;
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['tipo'] = $tipo;
        header('Location: ../public/dashboard_professor.html');
        exit();
    }

    // Tipo padrão (aluno)
    $usuarioId = $usuario['id'];
    $resposta = listarAvaliacaoFisica($usuarioId);
    $usuario = listarPerfilUsuario($usuarioId);
    $usuario['nome'] = $usuario[0]['nome'];
    $_SESSION['id'] = $usuarioId;
    $_SESSION['email'] = $email;
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['tipo'] = $tipo;

    if ($resposta) {
        // Resetar tentativas após login bem-sucedido
        $_SESSION['tentativas_login'] = 0;

        header('Location: ../public/dashboard_usuario.php');
    } else {
        // Resetar tentativas após login bem-sucedido
        $_SESSION['tentativas_login'] = 0;

        header('Location: ../public/primeira_avaliacao.php');
    }

    exit();
} else {
    $_SESSION['erro_login'] = 'E-mail ou senha incorretos.';
    header('Location: ../public/login.php');
    exit();
}
