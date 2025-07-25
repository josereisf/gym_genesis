<?php
require_once "../code/funcao.php";
$idprofessor = 2; // ID do professor, pode ser dinâmico conforme a sessão do usuário
$horarios = listarAulaAgendada($idprofessor); // Função para listar
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

<body class="bg-gray-950 text-white font-sans">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-gray-900 to-gray-800 p-6 flex flex-col items-center shadow-xl border-r border-gray-700">
      <!-- Logo -->
      <img src="https://github.com/josereisf/gym_genesis/blob/main/public/logo.png" alt="Logo Gym Gênesis" class="mb-6 w-32 h-auto">
      <h2 class="text-3xl font-extrabold text-center mb-10 text-indigo-400">Gym Gênesis</h2>
      <nav class="w-full space-y-4">
        <a href="#" class="flex items-center gap-3 text-gray-300 hover:bg-indigo-600 hover:text-white p-3 rounded-lg transition">
          <span class="material-icons">calendar_today</span> <span>Agenda</span>
        </a>
        <a href="#" class="flex items-center gap-3 text-gray-300 hover:bg-indigo-600 hover:text-white p-3 rounded-lg transition">
          <span class="material-icons">groups</span> <span>Meus Alunos</span>
        </a>
        <a href="#" class="flex items-center gap-3 text-gray-300 hover:bg-indigo-600 hover:text-white p-3 rounded-lg transition">
          <span class="material-icons">fitness_center</span> <span>Metas</span>
        </a>
        <a href="#" class="flex items-center gap-3 text-gray-300 hover:bg-indigo-600 hover:text-white p-3 rounded-lg transition">
          <span class="material-icons">forum</span> <span>Fórum</span>
        </a>
        <a href="#" class="flex items-center gap-3 text-gray-300 hover:bg-indigo-600 hover:text-white p-3 rounded-lg transition">
          <span class="material-icons">settings</span> <span>Configurações</span>
        </a>
      </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 p-10 overflow-y-auto" x-data="{ modal: false, aula: null }">
      <!-- Header -->
      <header class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-extrabold text-indigo-400">Painel do Professor</h1>
        <div class="text-gray-400 text-lg">Bem-vindo(a), Professor 👋</div>
      </header>

      <!-- Calendário -->
      <div class="bg-gray-900 p-6 rounded-2xl shadow-lg mb-10 border border-gray-700">
        <h2 class="text-2xl font-semibold text-indigo-300 mb-6">Agenda de Aulas</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          <template
            <?php
            echo 'x-for="(item, index) in [';
            $horarios = listarAulaAgendada();

            foreach ($horarios as $h) {
              echo "{
                dia: '" . $h['dia_semana'] . "',
                inicio: '" . $h['hora_inicio'] . "',
                fim: '" . $h['hora_fim'] . "',
                treino: '" . $h['treino_tipo'] . " - " . $h['treino_desc'] . "',
                alunos: '" . $h['alunos'] . "'
              },";
            }
            echo ']" :key="index"';
            ?>
          >
            <div @click="modal = true; aula = item" class="cursor-pointer bg-gray-800 p-5 rounded-2xl hover:bg-indigo-600 transition shadow-md border border-gray-700">
              <h3 class="text-lg font-bold text-indigo-200" x-text="item.dia"></h3>
              <p class="text-sm mt-2 text-gray-300">
                Horário: <span x-text="item.inicio + ' - ' + item.fim"></span>
              </p>
              <p class="text-sm text-gray-300">
                Treino: <span x-text="item.treino"></span>
              </p>
              <p class="text-sm text-gray-300">
                Alunos: <span x-text="item.alunos"></span>
              </p>
            </div>
          </template>
        </div>

        <!-- Modal -->
        <div x-show="modal" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-50" x-cloak>
          <div class="bg-gray-900 p-8 rounded-2xl w-full max-w-md shadow-xl border border-indigo-600">
            <h2 class="text-2xl font-bold mb-4 text-indigo-400">Detalhes da Aula</h2>
            <p class="mb-2"><strong>Dia:</strong> <span x-text="aula?.dia"></span></p>
            <p class="mb-2"><strong>Horário:</strong> <span x-text="aula?.inicio + ' - ' + aula?.fim"></span></p>
            <p class="mb-2"><strong>Treino:</strong> <span x-text="aula?.treino"></span></p>
            <p class="mb-4"><strong>Alunos:</strong> <span x-text="aula?.alunos"></span></p>
            <div class="text-right">
              <button @click="modal = false" class="bg-indigo-600 hover:bg-indigo-700 px-5 py-2 rounded-full text-white font-semibold">Fechar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabela de Alunos -->
      <div class="bg-gray-900 p-6 rounded-2xl shadow-lg mb-10 border border-gray-700">
        <h2 class="text-2xl font-semibold text-indigo-300 mb-6">Meus Alunos</h2>
        <table class="w-full text-left border-collapse text-sm">
          <thead>
            <tr>
              <th class="border-b border-gray-700 p-3">Nome</th>
              <th class="border-b border-gray-700 p-3">Objetivo</th>
              <th class="border-b border-gray-700 p-3">Progresso</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-gray-800">
              <td class="p-3">João Silva</td>
              <td class="p-3">Hipertrofia</td>
              <td class="p-3">60%</td>
            </tr>
            <tr class="hover:bg-gray-800">
              <td class="p-3">Maria Souza</td>
              <td class="p-3">Perda de Peso</td>
              <td class="p-3">45%</td>
            </tr>
            <tr class="hover:bg-gray-800">
              <td class="p-3">Carlos Lima</td>
              <td class="p-3">Condicionamento</td>
              <td class="p-3">70%</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Fórum acesso -->
      <div class="bg-gradient-to-r from-purple-700 via-purple-800 to-purple-900 p-8 rounded-2xl shadow-xl text-center border border-purple-600">
        <h2 class="text-2xl font-semibold text-white mb-4">Participar do Fórum</h2>
        <p class="text-purple-200 mb-6">Conecte-se com outros professores, compartilhe dicas e experiências.</p>
        <button class="bg-white text-purple-800 hover:bg-purple-100 px-6 py-3 rounded-full font-bold shadow-sm">
          <span class="material-icons align-middle mr-2">forum</span> Ir para o Fórum
        </button>
      </div>
    </div>
  </div>
</body>

</html>