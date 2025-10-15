<?php
require_once __DIR__ . '/../funcao.php'; // ajuste o caminho para funcao.php

// ====== FORMULÁRIO SIMPLES ======
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    echo "<pre>";
    echo "Email digitado: $email\n";
    echo "Senha digitada: $senha\n";
    echo "</pre>";

    $usuario = loginUsuario(trim($email), $senha);

    echo "<pre>";
    print_r($usuario);
    echo "</pre>";

    if (isset($usuario['status']) && $usuario['status'] === false) {
        echo "<h3 style='color:red'>❌ {$usuario['msg']}</h3>";
    } else {
        echo "<h3 style='color:green'>✅ Login realizado com sucesso!</h3>";
        echo "Bem-vindo(a), " . ($usuario['nome'] ?? $usuario['email']);
    }
} else {
?>
    <form method="post" style="max-width:400px;margin:auto;margin-top:50px;font-family:sans-serif">
        <h2>🔐 Teste de Login</h2>
        <label>Email:</label><br>
        <input type="email" name="email" required style="width:100%;padding:8px;margin-bottom:10px"><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required style="width:100%;padding:8px;margin-bottom:10px"><br>

        <button type="submit" style="padding:10px 20px;background:#007BFF;color:white;border:none;border-radius:5px;cursor:pointer">Testar Login</button>
    </form>
<?php
}
?>