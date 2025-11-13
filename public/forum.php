<?php
require_once __DIR__ . '/../code/funcao.php';
require_once __DIR__ . '/./php/verificarLogado.php';
$idusuario = $_SESSION['idusuario'] ?? 21;
$topicos = listarForum(null);
$respostas = listarRespostaForum(null);

// Agrupa respostas por id do fórum
$respostasAgrupadas = [];
if ($respostas) {
  foreach ($respostas as $r) {
    $respostasAgrupadas[$r['forum_id']][] = $r;
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fórum da Comunidade | FitConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-950 text-gray-100">

  <!-- HEADER -->
  <header class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-6xl mx-auto flex justify-between items-center py-4 px-6">
      <a href="dashboard_usuario.php" class="text-2xl font-bold text-blue-400 hover:text-blue-500 transition">
        Fit<span class="text-white">Connect</span>
      </a>
      
      <a href="logout.php" class="text-gray-400 hover:text-red-500 transition">Sair</a>
    </div>
  </header>

  <!-- CONTEÚDO -->
  <main class="max-w-5xl mx-auto py-10 px-6 space-y-8">
    <div class="flex justify-between items-center mb-10">
      <h1 class="text-4xl font-bold text-blue-400">💬 Comunidade de Treino</h1>
      <a href="./formularioGenerico.php?tabela=forum" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition">
        Novo Tópico
      </a>
    </div>
<?php
if ($topicos && count($topicos) > 0) {
    foreach ($topicos as $t) {
        echo '<div class="bg-gray-900 border border-gray-800 rounded-2xl shadow-md p-6 hover:shadow-lg transition">';
        echo '  <div class="mb-3">';
        echo '    <h2 class="text-2xl font-semibold text-blue-400">' . htmlspecialchars($t['titulo']) . '</h2>';
        echo '    <p class="text-gray-300 mt-1">' . htmlspecialchars($t['descricao']) . '</p>';
        echo '  </div>';

        echo '  <div class="text-sm text-gray-500 mb-4 flex justify-between">';
        echo '    <span>👤 ' . htmlspecialchars($t['nome_usuario']) . '</span>';
        echo '    <span>📅 ' . date('d/m/Y H:i', strtotime($t['data_criacao'])) . '</span>';
        echo '  </div>';

        // 🔹 Respostas
        if (!empty($respostasAgrupadas[$t['idtopico']])) {
            echo '<div class="bg-gray-800 border border-gray-700 rounded-xl p-4 space-y-3">';
            foreach ($respostasAgrupadas[$t['idtopico']] as $r) {
                echo '  <div class="p-3 bg-gray-900 border border-gray-800 rounded-lg">';
                echo '    <p class="text-gray-200">' . htmlspecialchars($r['mensagem']) . '</p>';
                echo '    <div class="text-xs text-gray-500 mt-2 flex justify-between">';
                echo '      <span>👤 ' . htmlspecialchars($r['nome_usuario']) . '</span>';
                echo '      <span>📅 ' . date('d/m/Y H:i', strtotime($r['data_resposta'])) . '</span>';
                echo '    </div>';
                echo '  </div>';
            }
            echo '</div>';
        } else {
            echo '<p class="text-gray-500 italic">Nenhuma resposta ainda.</p>';
        }

        // 🔹 Formulário de nova resposta
        echo '<form action="http://localhost:83/public/api/index.php?entidade=resposta_forum&acao=cadastrar" method="POST" class="mt-4">';
        echo '  <input type="hidden" name="forum_id" value="' . $t['idtopico'] . '">';
        echo '  <input type="hidden" name="usuario_id" value="'.$idusuario.'">'; // Substituir pelo ID do usuário logado
        echo '  <textarea name="mensagem" rows="2" placeholder="Deixe sua resposta..." class="w-full bg-gray-800 text-gray-200 rounded-lg p-3 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-500"></textarea>';
        echo '  <button type="submit" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">Responder</button>';
        echo '</form>';

        echo '</div>';
    }
} else {
    echo '<p class="text-gray-400 text-center text-lg">Nenhum tópico encontrado 😕</p>';
}
?>

  </main>

  <!-- FOOTER -->
  <footer class="bg-gray-900 border-t border-gray-800 py-6 mt-10">
    <div class="max-w-6xl mx-auto text-center text-gray-500 text-sm">
      © <?= date('Y') ?> <span class="text-blue-400 font-semibold">FitConnect</span>. Todos os direitos reservados.
    </div>
  </footer>

</body>

</html>