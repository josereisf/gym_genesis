<?php
session_start();
$erro = $_SESSION['erro_login'] ?? null;
unset($_SESSION['erro_login']); // Limpa depois de exibir
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Gym Genesis</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <style>
    @keyframes fade-in {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
      animation: fade-in 0.4s ease-out;
      transition: opacity 0.5s ease;
    }
  </style>
</head>
<body class="bg-[#132237] flex items-center justify-center min-h-screen text-white">
<?php if ($erro): ?>
  <div
    id="alertaErro"
    class="absolute top-4 left-1/2 transform -translate-x-1/2 bg-red-600 text-white px-6 py-3 rounded-xl shadow-lg animate-fade-in"
  >
    <?= htmlspecialchars($erro) ?>
  </div>
<?php endif; ?>

  <div class="w-full max-w-sm bg-[#1e2a3a] p-8 rounded-2xl shadow-lg">
    <h1 class="text-3xl font-bold text-center mb-6">Gym Genesis</h1>

    <form action="./php/login.php" method="post" class="space-y-4">
      <div>
        <label for="email" class="block text-sm font-medium">Email</label>
        <input
          type="email"
          name="email"
          id="email"
          required
          class="w-full px-4 py-2 mt-1 bg-[#223344] border border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>

      <div>
        <label for="senha" class="block text-sm font-medium">Senha</label>
        <input
          type="password"
          name="senha"
          id="senha"
          required
          class="w-full px-4 py-2 mt-1 bg-[#223344] border border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>

      <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 transition duration-300 py-2 rounded-xl font-semibold mt-4"
      >
        Entrar
      </button>
    </form>
<p class="text-sm text-center mt-4 text-gray-400">
      Se ainda não possui Cadastro?
      <a href="2-etapa.php" class="text-blue-400 hover:underline">Clique aqui</a>
    </p>
    <p class="text-sm text-center mt-4 text-gray-400">
      Esqueceu a senha?
      <a href="recuperar.php" class="text-blue-400 hover:underline">Clique aqui</a>
    </p>
  </div>

   <script>
    // Faz o alerta sumir depois de 3 segundos
    setTimeout(() => {
      const alerta = document.getElementById('alertaErro');
      if (alerta) {
        alerta.classList.add('opacity-0');
        setTimeout(() => alerta.remove(), 500); // remove depois da transição
      }
    }, 30000);
  </script>
</body>
</html>
