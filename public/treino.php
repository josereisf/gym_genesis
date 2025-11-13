<?php
require_once '../code/funcao.php';
require_once __DIR__ . "/./php/verificarLogado.php";
$idaula = $_GET['idaula'] ?? null;
$idaluno = $_GET['idaluno'] ?? null;
$aula_agendada = listarAulaAgendada($idaula);
//print_r($aula_agendada);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gym_Genesis | Treino</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .active-item {
      background-color: rgba(34, 197, 94, 0.15);
      border-left: 3px solid #22c55e;
    }
  </style>
</head>

<body class="bg-gray-900 text-white flex h-screen">

  <!-- Sidebar -->
  <aside class="w-72 bg-gray-800/60 backdrop-blur-xl border-r border-white/10 flex flex-col">
    <div class="p-6 flex items-center justify-center border-b border-white/10">
      <img src="./assets/logo_gym_genesis.png" alt="Logo" class="w-16 h-16 mr-3">
      <h1 class="text-2xl font-bold text-green-400">Gym_Genesis</h1>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-3">
      <h2 class="text-white/70 text-sm mb-2 uppercase tracking-wider">Seu Treino</h2>
      <ul id="exercise-list" class="space-y-2"></ul>
    </nav>

    <!-- Botão Concluir -->
    <div class="p-6 border-t border-white/10">
      <button id="finish-btn" class="w-full bg-green-500/20 hover:bg-green-500/30 text-green-400 font-semibold py-3 px-4 rounded-xl transition-all duration-300">
        ✅ Concluir Treino
      </button>
    </div>
  </aside>

  <!-- Painel principal -->
  <main class="flex-1 p-10 overflow-y-auto">
    <div id="exercise-content" class="text-center text-white/60 mt-20">
      <h2 class="text-3xl font-semibold mb-4">👋 Bem-vindo ao seu treino</h2>
      <p>Selecione um exercício na lista ao lado para começar.</p>
    </div>
  </main>

  <script>
    // -----------------------------
    // 🔹 Dados simulados (substituir com PHP depois)
    // -----------------------------
    const idaluno = <?= json_encode($_GET['idaluno'] ?? 21) ?>;
    const idaula = <?= json_encode($_GET['idaula'] ?? 9) ?>; // começa vazio

    let exercises = <?= json_encode($aula_agendada) ?>;
    console.log(exercises);

    // -----------------------------
    // 🔹 Lógica de Exibição dos Exercícios
    // -----------------------------

    const exerciseList = document.getElementById('exercise-list');
    const content = document.getElementById('exercise-content');
    const finishBtn = document.getElementById('finish-btn');

    // Gera lista de exercícios
    exercises.forEach(ex => {
      const li = document.createElement('li');
      li.className = "cursor-pointer px-4 py-3 rounded-lg hover:bg-white/10 transition flex justify-between items-center";
      li.innerHTML = `
      <div>
        <div class="font-semibold">${ex.nome_exercicio}</div>
        <div class="text-sm text-white/50">${ex.grupo_muscular}</div>
      </div>
      <span class="text-green-400 text-xs uppercase">Ver</span>
    `;
      li.addEventListener('click', () => showExercise(ex, li));
      exerciseList.appendChild(li);
    });

    // Mostra detalhes do exercício selecionado
    function showExercise(ex, li) {
      document.querySelectorAll('#exercise-list li').forEach(el => el.classList.remove('active-item'));
      li.classList.add('active-item');

      content.innerHTML = `
      <div class="max-w-3xl mx-auto">
        <h2 class="text-4xl font-bold text-green-400 mb-4">${ex.nome_exercicio}</h2>
        <p class="text-white/70 mb-6">${ex.descricao_exercicio}</p>
        <video controls class="w-full rounded-2xl mb-6 shadow-lg">
          <source src="${ex.video_url || ''}" type="video/mp4">
          Seu navegador não suporta vídeos.
        </video>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
          <div class="bg-white/5 p-4 rounded-xl">
            <div class="text-sm text-white/60">Séries</div>
            <div class="text-xl font-bold">${ex.series}</div>
          </div>
          <div class="bg-white/5 p-4 rounded-xl">
            <div class="text-sm text-white/60">Repetições</div>
            <div class="text-xl font-bold">${ex.repeticoes}</div>
          </div>
          <div class="bg-white/5 p-4 rounded-xl">
            <div class="text-sm text-white/60">Carga</div>
            <div class="text-xl font-bold">${ex.carga} kg</div>
          </div>
          <div class="bg-white/5 p-4 rounded-xl">
            <div class="text-sm text-white/60">Intervalo</div>
            <div class="text-xl font-bold">${ex.intervalo_segundos}s</div>
          </div>
        </div>

        <div class="mt-6 text-center">
          <h3 class="text-lg font-semibold text-green-300 mb-2">Professor: ${ex.nome_usuario}</h3>
          <p class="text-white/60">${ex.descricao_professor}</p>
          <p class="text-white/40 text-sm mt-1">Modalidade: ${ex.modalidade}</p>
        </div>
      </div>
    `;
    }
    // -----------------------------
    // 🔹 Botão de Concluir Treino
    // -----------------------------
    finishBtn.addEventListener('click', concluirTreino);

    function concluirTreino() {
      const agora = new Date();
      const dataHora = agora.toISOString().slice(0, 19).replace('T', ' ');

      fetch('http://localhost:83/public/api/index.php?entidade=historico_treino&acao=cadastrar', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            idtreino: exercises[0].idtreino,
            idusuario: idaluno,
            data_execucao: dataHora,
            observacoes: exercises[0].descricao_exercicio
          })
        })
        .then(response => response.json())
        .then(dataHist => {
          console.log('Histórico salvo:', dataHist);
          return fetch('http://localhost:83/public/api/index.php?entidade=aula_usuario&acao=deletar', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              idaula: idaula,
              idaluno: idaluno
            })
          });
        })
        .then(response => response.json())
        .then(dataDel => {
          console.log('Treino concluído:', dataDel);
          finishBtn.innerText = '✅ Treino Concluído!';
          finishBtn.classList.add('bg-green-500/40');
          setTimeout(() => window.location.href = 'dashboard_usuario.php', 1500);
        })
        .catch(error => {
          console.error('Erro:', error);
          finishBtn.innerText = '❌ Tente novamente';
          finishBtn.disabled = false;
        });
    }
  </script>

</body>

</html>