<?php
<<<<<<< Updated upstream
require_once "../php/verificarLogado.php";
require_once __DIR__ . "/../code/funcao.php";
=======
require_once "./php/verificarLogado.php";
require_once "../code/funcao.php";
>>>>>>> Stashed changes

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fórum Premium - Gym Gênesis</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-950 to-gray-900 text-gray-100 min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-black/60 border-b border-gray-700 backdrop-blur-md p-6 text-center">
    <h1 class="text-3xl md:text-4xl font-extrabold text-emerald-400 tracking-wide">🏋️‍♂️ GYM GÊNESIS</h1>
  </header>

  <div class="flex flex-1 gap-6 p-6">

    <!-- Sidebar -->
    <aside class="w-64 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 flex flex-col gap-3 shadow-lg">
      <button class="px-4 py-3 rounded-xl border border-white/10 text-left font-medium hover:bg-emerald-400 hover:text-black transition">
        🏋️ Treinos
      </button>
      <button class="px-4 py-3 rounded-xl border border-white/10 text-left font-medium hover:bg-emerald-400 hover:text-black transition">
        🥗 Nutrição
      </button>
      <button class="px-4 py-3 rounded-xl border border-white/10 text-left font-medium hover:bg-emerald-400 hover:text-black transition">
        💊 Suplementos
      </button>
      <button class="px-4 py-3 rounded-xl border border-white/10 text-left font-medium hover:bg-emerald-400 hover:text-black transition">
        🧠 Mindset
      </button>
    </aside>

    <!-- Main Forum -->
    <main class="flex-1 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-lg">
      <h2 class="text-2xl font-bold text-emerald-400 mb-6">Dicas Avançadas de Hipertrofia</h2>

      <?php
      $idtopico = 0; // exemplo fixo, pode vir via GET
      $comentarios = listarForum($idtopico); // retorna tópicos

      foreach ($comentarios as $c) {
      ?>
        <div class="bg-white/10 border border-white/10 rounded-xl p-5 mb-6 shadow-md">
          <!-- Comentário principal -->
          <div class="text-sm text-gray-400 mb-2">
            <?= htmlspecialchars($c['nome_usuario']) ?> · <?= date("d/m/Y H:i", strtotime($c['data_criacao'])) ?>
          </div>
          <p class="text-gray-200"><?= nl2br(htmlspecialchars($c['descricao'])) ?></p>

          <!-- Ações -->
          <div class="flex gap-3 mt-4">
            <button
              class="bg-emerald-400 text-black px-4 py-2 rounded-lg font-semibold hover:bg-emerald-500 transition">
              Curtir
            </button>

            <!-- botão abre modal e leva o id do tópico -->
            <button
              class="bg-emerald-400 text-black px-4 py-2 rounded-lg font-semibold hover:bg-emerald-500 transition responder-btn"
              data-forum="<?= $c['idtopico'] ?>"
              data-usuario="<?= $c['usuario_id'] ?>">
              Responder
            </button>
          </div>

          <!-- Respostas -->
          <?php
          $respostas = listarRespostaForum($c['idtopico']); // retorna respostas do tópico
          if ($respostas) {
            $totalRespostas = count($respostas);
          ?>
            <div class="mt-5 space-y-4 pl-6 border-l border-emerald-400/40">
              <?php foreach ($respostas as $i => $r) { ?>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4 resposta <?= $i > 1 ? 'hidden' : '' ?>"
                  data-forum="<?= $c['idtopico'] ?>">
                  <div class="text-xs text-gray-400 mb-1">
                    <?= htmlspecialchars($r['nome_usuario']) ?> · <?= date("d/m/Y H:i", strtotime($r['data_resposta'])) ?>
                  </div>
                  <p class="text-gray-300"><?= nl2br(htmlspecialchars($r['mensagem'])) ?></p>
                </div>
              <?php } ?>

              <?php if ($totalRespostas > 2) { ?>
                <button
                  class="mt-3 text-emerald-400 hover:text-emerald-300 text-sm font-semibold ver-mais"
                  data-forum="<?= $c['idtopico'] ?>">
                  Ver todas as <?= $totalRespostas ?> respostas
                </button>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </main>

  </div>

  <!-- Modal Responder -->
  <div id="modalResponder" class="fixed inset-0 bg-black/70 flex items-center justify-center hidden z-50">
    <div class="bg-gray-900 border border-white/10 rounded-2xl p-6 w-96 shadow-xl">
      <h3 class="text-xl font-bold text-emerald-400 mb-4">Responder ao Tópico</h3>
      <form method="post" action="">
        <input type="hidden" name="location">
        <!-- preenchido via JS -->
        <input type="hidden" name="forum_id" id="forumIdInput" value="">

        <!-- usuário logado -->
        <input type="hidden" name="usuario_id" id="usuarioIdInput" value="">

        <textarea name="mensagem" rows="4" required
          class="w-full p-3 rounded-lg bg-white/5 border border-white/10 text-gray-200 focus:outline-none focus:ring-2 focus:ring-emerald-400"
          placeholder="Digite sua resposta..."></textarea>

        <div class="flex justify-end gap-3 mt-4">
          <button type="button" id="fecharModal"
            class="px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 transition">Cancelar</button>
          <button type="submit"
            class="px-4 py-2 rounded-lg bg-emerald-400 text-black font-bold hover:bg-emerald-500 transition">Enviar</button>
        </div>
      </form>


    </div>
  </div>

  <!-- Script Modal -->
  <script>
    const modal = document.getElementById("modalResponder");
    const forumIdInput = document.getElementById("forumIdInput");
    const usuarioIdInput = document.getElementById("usuarioIdInput");
    const responderBtns = document.querySelectorAll(".responder-btn");
    const fecharModal = document.getElementById("fecharModal");

    responderBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        forumIdInput.value = btn.getAttribute("data-forum");
        usuarioIdInput.value = btn.getAttribute("data-usuario");
        modal.classList.remove("hidden");
      });
    });

    fecharModal.addEventListener("click", () => {
      modal.classList.add("hidden");
    });

    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.classList.add("hidden");
      }
    });

    document.addEventListener("DOMContentLoaded", () => {
      // botão "Ver todas"
      document.querySelectorAll(".ver-mais").forEach(btn => {
        btn.addEventListener("click", () => {
          const forumId = btn.dataset.forum;
          const respostas = document.querySelectorAll(`.resposta[data-forum="${forumId}"]`);

          const ocultas = [...respostas].filter(r => r.classList.contains("hidden"));

          if (ocultas.length > 0) {
            // mostrar todas
            ocultas.forEach(r => r.classList.remove("hidden"));
            btn.textContent = "Ver menos respostas";
          } else {
            // esconder a partir da 3ª
            respostas.forEach((r, i) => {
              if (i > 1) r.classList.add("hidden");
            });
            btn.textContent = `Ver todas as ${respostas.length} respostas`;
          }
        });
      });
    });
  </script>

</body>

</html>