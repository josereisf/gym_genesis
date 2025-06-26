<?php
require_once "../code/funcao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Professor - Gym Gênesis</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white font-sans">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-72 bg-gray-800 p-6 flex flex-col items-center shadow-lg">
      <!-- Logo -->
      <img src="https://github.com/josereisf/gym_genesis/blob/main/public/logo.png" alt="Logo Gym Gênesis" class="mb-6 w-32 h-auto">
      <h2 class="text-2xl font-bold text-center mb-8">Gym Gênesis</h2>
      <nav class="w-full space-y-3">
        <a href="#" class="flex items-center gap-3 text-gray-300 hover:bg-gray-700 p-2 rounded-md">
          <span class="material-icons">calendar_today</span> <span>Agenda</span>
        </a>
        <a href="#" class="flex items-center gap-3 text-gray-300 hover:bg-gray-700 p-2 rounded-md">
          <span class="material-icons">groups</span> <span>Meus Alunos</span>
        </a>
        <a href="#" class="flex items-center gap-3 text-gray-300 hover:bg-gray-700 p-2 rounded-md">
          <span class="material-icons">fitness_center</span> <span>Metas</span>
        </a>
        <a href="#" class="flex items-center gap-3 text-gray-300 hover:bg-gray-700 p-2 rounded-md">
          <span class="material-icons">forum</span> <span>Fórum</span>
        </a>
        <a href="#" class="flex items-center gap-3 text-gray-300 hover:bg-gray-700 p-2 rounded-md">
          <span class="material-icons">settings</span> <span>Configurações</span>
        </a>
      </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 p-8 overflow-y-auto" x-data="{ modal: false, aula: null }">
      <!-- Header -->
      <header class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-white">Painel do Professor</h1>
        <div class="text-gray-300 text-lg">Bem-vindo(a), Professor 👋</div>
      </header>

      <!-- Calendário -->
      <div class="bg-gray-800 p-6 rounded-xl shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4">Agenda de Aulas</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <template
            <?php
            echo 'x-for="(item, index) in [';
            $idaula = 0;
            $horarios = listarAulaAgendada($idaula);
            foreach ($horarios as $h) {
              echo "{ dia: '" . $h['dia_semana'] . "', horario: '" . $h['hora_inicio'] . "', horario: '" . $h['hora_fim'] . "' },";
            }
            echo ']" :key="index"';
            ?>>
            <div @click="modal = true; aula = item" class="cursor-pointer bg-gray-700 p-4 rounded-lg hover:bg-indigo-600 transition">
              <h3 class="text-xl font-bold" x-text="item.dia"></h3>
              <p class="text-sm mt-1">Horário: <span x-text="item.horario"></span></p>
              <p class="text-sm">Treino: <span x-text="item.treino"></span></p>
              <p class="text-sm">Alunos: <span x-text="item.alunos"></span></p>
            </div>
          </template>
        </div>

        <!-- Modal -->
        <div x-show="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50" x-cloak>
          <div class="bg-gray-900 p-6 rounded-xl w-96 shadow-xl">
            <h2 class="text-2xl font-semibold mb-4">Detalhes da Aula</h2>
            <p><strong>Dia:</strong> <span x-text="aula?.dia"></span></p>
            <p><strong>Horário:</strong> <span x-text="aula?.horario"></span></p>
            <p><strong>Treino:</strong> <span x-text="aula?.treino"></span></p>
            <p><strong>Alunos:</strong> <span x-text="aula?.alunos"></span></p>
            <div class="mt-4 text-right">
              <button @click="modal = false" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded text-white">Fechar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabela de Alunos -->
      <div class="bg-gray-800 p-6 rounded-xl shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4">Meus Alunos</h2>
        <table class="w-full text-left border-collapse">
          <thead>
            <tr>
              <th class="border-b border-gray-700 p-2">Nome</th>
              <th class="border-b border-gray-700 p-2">Objetivo</th>
              <th class="border-b border-gray-700 p-2">Progresso</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-gray-700">
              <td class="p-2">João Silva</td>
              <td class="p-2">Hipertrofia</td>
              <td class="p-2">60%</td>
            </tr>
            <tr class="hover:bg-gray-700">
              <td class="p-2">Maria Souza</td>
              <td class="p-2">Perda de Peso</td>
              <td class="p-2">45%</td>
            </tr>
            <tr class="hover:bg-gray-700">
              <td class="p-2">Carlos Lima</td>
              <td class="p-2">Condicionamento</td>
              <td class="p-2">70%</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Fórum acesso -->
      <div class="bg-gray-800 p-6 rounded-xl shadow-md text-center">
        <h2 class="text-2xl font-semibold mb-4">Participar do Fórum</h2>
        <p class="text-gray-400 mb-4">Conecte-se com outros professores, compartilhe dicas e experiências.</p>
        <button class="bg-purple-600 hover:bg-purple-700 px-6 py-3 rounded-full text-white font-semibold">
          <span class="material-icons align-middle mr-2">forum</span> Ir para o Fórum
        </button>
      </div>
    </div>
  </div>
</body>

</html>