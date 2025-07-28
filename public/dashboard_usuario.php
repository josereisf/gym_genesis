<?php
require_once "../code/funcao.php";
session_start();

if (empty($_SESSION['id'])) {
$_SESSION['erro_login'] = "Sessão expirada ou não iniciada. Faça login para continuar.";
  header('Location: login.php');
  exit;
}

$idaluno = $_SESSION['id'] ?? null;
$nomes = $_SESSION['nome'] ?? null;
$nomes = $peso = $altura = $imc = $perc_gord = $data = "-"; // evita warning
$resultados = listarUsuarioCompleto($idaluno);
foreach ($resultados as $r) {
  $nome = $r['nome_usuario'];
  $peso = (float) $r['peso'];
  $altura = $r['altura'];
  $imc = $r['imc'];
  $perc_gord = $r['percentual_gordura'];
  $data = $r['data_avaliacao'];
  $plano = $r['tipo_plano'];
  $foto = $r['foto_perfil'] ?? 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBjbGFzcz0ibHVjaWRlIGx1Y2lkZS11c2VyLWNpcmNsZSI+PGNpcmNsZSBjeD0iMTIiIGN5PSIxMiIgcj0iMTAiLz48Y2lyY2xlIGN4PSIxMiIgY3k9IjEwIiByPSIzIi8+PHBhdGggZD0iTTcgMjAuNjZWMTlhMiAyIDAgMCAxIDItMmg2YTIgMiAwIDAgMSAyIDJ2MS42NiIvPjwvc3ZnPg=='; // imagem padrão se não houver foto
}

$dia

?>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Academia - Área do Cliente</title>
  <link rel="stylesheet" href="./css/dashboard_usuario.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&amp;display=swap"
    rel="stylesheet" />
  <!-- Font Awesome CDN (versão free) -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>

</head>

<body>
  <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800">
    <!-- Navbar
    <nav class="bg-indigo-600 text-white shadow-lg">
      <div
        class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-2">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-8 w-8"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
          </svg>
          <span class="font-bold text-xl">Gym Genesis Academia</span>
        </div>
        <div class="flex items-center space-x-4">
          <div class="relative">
            <button
              id="notificationBtn"
              class="text-white hover:text-indigo-200">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
              </svg>
              <span
                class="absolute -top-1 -right-1 bg-red-500 text-xs rounded-full h-4 w-4 flex items-center justify-center">2</span>
            </button>
          </div>
          <div class="flex items-center space-x-2">
            <img
              src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBjbGFzcz0ibHVjaWRlIGx1Y2lkZS11c2VyLWNpcmNsZSI+PGNpcmNsZSBjeD0iMTIiIGN5PSIxMiIgcj0iMTAiLz48Y2lyY2xlIGN4PSIxMiIgY3k9IjEwIiByPSIzIi8+PHBhdGggZD0iTTcgMjAuNjZWMTlhMiAyIDAgMCAxIDItMmg2YTIgMiAwIDAgMSAyIDJ2MS42NiIvPjwvc3ZnPg=="
              alt="Perfil"
              class="h-8 w-8 rounded-full bg-white p-1" />
            <span class="font-medium hidden md:block"><?= $nome ?></span>
          </div>
        </div>
      </div>
    </nav> -->
    <nav class=" text-green-400 shadow-lg">
      <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-2">
          <span class="font-bold text-xl text-green-500">Gym Genesis Academia</span>
        </div>
        <div class="flex items-center space-x-4">
          <div class="relative">
            <button id="notificationBtn" class="text-green-400 hover:text-green-300">
              <i data-lucide="bell" class="w-6 h-6"></i>
              <span class="absolute -top-1 -right-1 bg-red-500 text-xs rounded-full h-4 w-4 flex items-center justify-center">2</span>
            </button>
          </div>
          <div class="flex items-center space-x-2">
            <img
              src="./uploads/<?= $foto ?>"
              alt="Perfil"
              class="h-12 w-12 rounded-full  p-1" />
            <span class="font-medium hidden md:block text-white"><?= $nome ?></span>
          </div>

        </div>
      </div>
    </nav>


    <!-- Main Content -->
    <div class="container mx-auto px-4 py-6">

      <!-- Welcome Section -->
      <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-green-400">
          Olá, <?= "$nome'!'" ?>👋
        </h1>
        <p class="text-gray-300">
          Bem-vindo ao seu dashboard. Veja seu progresso e próximos treinos.
        </p>
      </div>


      <!-- Stats Overview -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Frequência -->
        <div class="bg-[#111827] rounded-xl shadow-md p-6 transition-all hover:shadow-lg">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-sm font-medium text-gray-400">Frequência Mensal</p>
              <h3 class="text-2xl font-bold text-white mt-1">16/20</h3>
              <p class="text-sm text-green-400 mt-1 flex items-center">
                <i class="fas fa-arrow-up text-green-400 w-4 h-4 mr-1"></i>
                80% de presença
              </p>
            </div>
            <div class="bg-[#1f2937] p-3 rounded-lg">
              <i class="fas fa-calendar-days text-green-400 text-xl"></i>
            </div>
          </div>
        </div>

        <!-- Calorias -->
        <div class="bg-[#111827] rounded-xl shadow-md p-6 transition-all hover:shadow-lg">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-sm font-medium text-gray-400">Calorias Queimadas</p>
              <h3 class="text-2xl font-bold text-white mt-1"><?= $perc_gord ?></h3>
              <p class="text-sm text-green-400 mt-1 flex items-center">
                <i class="fas fa-arrow-up text-green-400 w-4 h-4 mr-1"></i>
                12% esta semana
              </p>
            </div>
            <div class="bg-[#1f2937] p-3 rounded-lg">
              <i class="fas fa-fire text-yellow-400 text-xl"></i>
            </div>
          </div>
        </div>

        <!-- Peso -->
        <div class="bg-[#111827] rounded-xl shadow-md p-6 transition-all hover:shadow-lg">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-sm font-medium text-gray-400">Peso Atual</p>
              <h3 class="text-2xl font-bold text-white mt-1"><?= $peso ?> KG</h3>
              <p class="text-sm text-green-400 mt-1 flex items-center">
                <i class="fas fa-arrow-down text-green-400 w-4 h-4 mr-1"></i>
                2.5 kg desde o início
              </p>
            </div>
            <div class="bg-[#1f2937] p-3 rounded-lg">
              <i class="fas fa-weight text-cyan-400 text-xl"></i>
            </div>
          </div>
        </div>

        <!-- Plano -->
        <div class="bg-[#111827] rounded-xl shadow-md p-6 transition-all hover:shadow-lg">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-sm font-medium text-gray-400">Plano</p>
              <h3 class="text-2xl font-bold text-white mt-1"><?= $plano ?></h3>
              <p class="text-sm text-yellow-400 mt-1 flex items-center">
                <i class="fas fa-clock text-yellow-400 w-4 h-4 mr-1"></i>
                <?= $dia_renovacao ?>
              </p>
            </div>
            <div class="bg-[#1f2937] p-3 rounded-lg">
              <i class="fas fa-gem text-indigo-400 text-xl"></i>
            </div>
          </div>
        </div>
      </div>


      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">

          <!-- PROGRESS CHART -->
          <div class="bg-[#111827] rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-lg font-semibold text-white">Seu Progresso</h2>
              <div class="flex space-x-2">
                <button
                  class="progress-btn px-3 py-1 text-sm rounded-md bg-green-600 text-white hover:bg-green-700"
                  data-period="week">Semana</button>
                <button
                  class="progress-btn px-3 py-1 text-sm rounded-md bg-gray-700 text-gray-200 hover:bg-gray-600"
                  data-period="month">Mês</button>
                <button
                  class="progress-btn px-3 py-1 text-sm rounded-md bg-gray-700 text-gray-200 hover:bg-gray-600"
                  data-period="year">Ano</button>
              </div>
            </div>
            <div class="h-64">
              <canvas id="progressChart" width="688" height="256"
                style="display: block; box-sizing: border-box; height: 256px; width: 688px;"></canvas>
            </div>
          </div>

          <!-- TREINO DE HOJE -->
          <div class="bg-[#111827] rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-lg font-semibold text-white">Treino de Hoje</h2>
              <span class="px-3 py-1 text-sm rounded-full bg-green-800 text-green-200">
                Treino A - Peito e Tríceps
              </span>
            </div>

            <div class="space-y-4">

              <!-- Exercício -->
              <div class="flex items-center p-3 bg-[#1f2937] rounded-lg">
                <div class="bg-green-900 p-3 rounded-lg mr-4">
                  <i data-lucide="file-text" class="h-6 w-6 text-green-400"></i>
                </div>
                <div class="flex-1">
                  <h3 class="font-medium text-white">Supino Reto</h3>
                  <p class="text-sm text-gray-400">4 séries x 12 repetições</p>
                </div>
                <div class="flex items-center">
                  <span class="text-sm font-medium text-gray-300 mr-2">30kg</span>
                  <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500 rounded focus:ring-green-500" />
                </div>
              </div>

              <!-- Repita esse bloco para cada exercício: -->
              <div class="flex items-center p-3 bg-[#1f2937] rounded-lg">
                <div class="bg-green-900 p-3 rounded-lg mr-4">
                  <i data-lucide="file-text" class="h-6 w-6 text-green-400"></i>
                </div>
                <div class="flex-1">
                  <h3 class="font-medium text-white">Crucifixo</h3>
                  <p class="text-sm text-gray-400">3 séries x 15 repetições</p>
                </div>
                <div class="flex items-center">
                  <span class="text-sm font-medium text-gray-300 mr-2">15kg</span>
                  <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500 rounded focus:ring-green-500" />
                </div>
              </div>

              <!-- Tríceps Corda -->
              <div class="flex items-center p-3 bg-[#1f2937] rounded-lg">
                <div class="bg-green-900 p-3 rounded-lg mr-4">
                  <i data-lucide="file-text" class="h-6 w-6 text-green-400"></i>
                </div>
                <div class="flex-1">
                  <h3 class="font-medium text-white">Tríceps Corda</h3>
                  <p class="text-sm text-gray-400">4 séries x 12 repetições</p>
                </div>
                <div class="flex items-center">
                  <span class="text-sm font-medium text-gray-300 mr-2">25kg</span>
                  <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500 rounded focus:ring-green-500" />
                </div>
              </div>

              <!-- Tríceps Francês -->
              <div class="flex items-center p-3 bg-[#1f2937] rounded-lg">
                <div class="bg-green-900 p-3 rounded-lg mr-4">
                  <i data-lucide="file-text" class="h-6 w-6 text-green-400"></i>
                </div>
                <div class="flex-1">
                  <h3 class="font-medium text-white">Tríceps Francês</h3>
                  <p class="text-sm text-gray-400">3 séries x 12 repetições</p>
                </div>
                <div class="flex items-center">
                  <span class="text-sm font-medium text-gray-300 mr-2">12kg</span>
                  <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500 rounded focus:ring-green-500" />
                </div>
              </div>

              <!-- Botão final -->
              <button
                class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                <i data-lucide="check-circle" class="h-5 w-5 mr-2"></i>
                Concluir Treino
              </button>

            </div>
          </div>
        </div>


        <!-- Right Column -->
        <div class="space-y-6">
          <!-- Goal Progress -->
          <div class="bg-[#111827] rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Metas</h2>
            <div class="space-y-6">

              <!-- Perda de Peso -->
              <div>
                <div class="flex justify-between mb-2">
                  <span class="text-sm font-medium text-gray-300">Perda de Peso</span>
                  <span class="text-sm font-medium text-green-400">75%</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2.5">
                  <div class="bg-green-500 h-2.5 rounded-full" style="width: 75%"></div>
                </div>
                <div class="flex justify-between mt-1 text-xs text-gray-400">
                  <span>Meta: 72kg</span>
                  <span>Atual: 78.5kg</span>
                </div>
              </div>

              <!-- Frequência Semanal -->
              <div>
                <div class="flex justify-between mb-2">
                  <span class="text-sm font-medium text-gray-300">Frequência Semanal</span>
                  <span class="text-sm font-medium text-green-400">100%</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2.5">
                  <div class="bg-green-400 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
                <div class="flex justify-between mt-1 text-xs text-gray-400">
                  <span>Meta: 4 dias</span>
                  <span>Atual: 4 dias</span>
                </div>
              </div>

              <!-- Ganho Muscular -->
              <div>
                <div class="flex justify-between mb-2">
                  <span class="text-sm font-medium text-gray-300">Ganho Muscular</span>
                  <span class="text-sm font-medium text-yellow-400">40%</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2.5">
                  <div class="bg-yellow-400 h-2.5 rounded-full" style="width: 40%"></div>
                </div>
                <div class="flex justify-between mt-1 text-xs text-gray-400">
                  <span>Meta: +5kg</span>
                  <span>Atual: +2kg</span>
                </div>
              </div>

              <!-- Botão -->
              <button
                class="w-full border border-green-500 text-green-400 hover:bg-green-900/20 py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 mr-2"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Adicionar Nova Meta
              </button>

            </div>
          </div>


          <!-- Upcoming Classes -->
          <div class="bg-gray-900 rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Próximas Aulas</h2>
            <div class="space-y-4">

              <!-- Aula 1 -->
              <div class="flex items-center p-3 bg-gray-800 rounded-lg border-l-4 border-green-500">
                <div class="mr-4 text-center">
                  <span class="block text-lg font-bold text-green-400">18</span>
                  <span class="text-xs text-gray-400">JUL</span>
                </div>
                <div class="flex-1">
                  <h3 class="font-medium text-white">Spinning</h3>
                  <p class="text-sm text-gray-400">19:00 - 20:00 • Prof. Ana</p>
                </div>
                <button class="text-green-400 hover:text-green-300">
                  <i class="fas fa-chevron-right text-lg"></i>
                </button>
              </div>

              <!-- Aula 2 -->
              <div class="flex items-center p-3 bg-gray-800 rounded-lg border-l-4 border-green-500">
                <div class="mr-4 text-center">
                  <span class="block text-lg font-bold text-green-400">20</span>
                  <span class="text-xs text-gray-400">JUL</span>
                </div>
                <div class="flex-1">
                  <h3 class="font-medium text-white">Yoga</h3>
                  <p class="text-sm text-gray-400">18:00 - 19:00 • Prof. Marcos</p>
                </div>
                <button class="text-green-400 hover:text-green-300">
                  <i class="fas fa-chevron-right text-lg"></i>
                </button>
              </div>

              <!-- Aula 3 -->
              <div class="flex items-center p-3 bg-gray-800 rounded-lg border-l-4 border-green-500">
                <div class="mr-4 text-center">
                  <span class="block text-lg font-bold text-green-400">22</span>
                  <span class="text-xs text-gray-400">JUL</span>
                </div>
                <div class="flex-1">
                  <h3 class="font-medium text-white">Funcional</h3>
                  <p class="text-sm text-gray-400">20:00 - 21:00 • Prof. Ricardo</p>
                </div>
                <button class="text-green-400 hover:text-green-300">
                  <i class="fas fa-chevron-right text-lg"></i>
                </button>
              </div>

              <!-- Botão Agenda Completa -->
              <button class="w-full mt-2 bg-transparent border border-green-500 text-green-400 hover:bg-green-500 hover:text-black py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                <i class="fas fa-calendar-alt mr-2"></i>
                Ver Agenda Completa
              </button>
            </div>
          </div>


          <!-- Nutrition Tips -->
          <div class="bg-gray-900 rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Dica Nutricional</h2>
            <div class="bg-gray-800 p-4 rounded-lg">
              <div class="flex items-center mb-3">
                <div class="bg-green-700 bg-opacity-20 p-2 rounded-full mr-3">
                  <i class="fas fa-apple-alt text-green-400 text-lg"></i>
                </div>
                <h3 class="font-medium text-white">Proteínas pós-treino</h3>
              </div>
              <p class="text-sm text-gray-300">
                Consumir proteínas dentro de 30 minutos após o treino ajuda na
                recuperação muscular e maximiza os resultados. Boas opções
                incluem whey protein, ovos ou frango.
              </p>
              <button
                class="mt-3 text-sm text-green-400 font-medium hover:underline flex items-center hover:text-green-300">
                Ler mais
                <i class="fas fa-chevron-right text-xs ml-1"></i>
              </button>
            </div>
          </div>


        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-12 py-10">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
          <!-- Coluna 1 -->
          <div>
            <h3 class="text-xl font-semibold mb-4 text-indigo-400">Gym Genesis</h3>
            <p class="text-gray-400 text-sm">
              Sua jornada fitness começa aqui. Estamos comprometidos com sua
              saúde e bem-estar.
            </p>
          </div>

          <!-- Coluna 2 -->
          <div>
            <h3 class="text-xl font-semibold mb-4 text-indigo-400">Links Rápidos</h3>
            <ul class="space-y-2 text-sm text-gray-400">
              <li><a href="#" class="hover:text-white">Horários de Aulas</a></li>
              <li><a href="#" class="hover:text-white">Planos e Preços</a></li>
              <li><a href="#" class="hover:text-white">Professores</a></li>
              <li><a href="#" class="hover:text-white">Contato</a></li>
            </ul>
          </div>

          <!-- Coluna 3 -->
          <div>
            <h3 class="text-xl font-semibold mb-4 text-indigo-400">Contato</h3>
            <ul class="space-y-3 text-sm text-gray-400">
              <li class="flex items-center">
                <i class="fas fa-map-marker-alt text-indigo-400 w-5 mr-2"></i>
                Av. Principal, 1000 - Centro
              </li>
              <li class="flex items-center">
                <i class="fas fa-phone-alt text-indigo-400 w-5 mr-2"></i>
                (11) 99999-9999
              </li>
              <li class="flex items-center">
                <i class="fas fa-envelope text-indigo-400 w-5 mr-2"></i>
                contato@fitproacademia.com
              </li>
            </ul>
          </div>
        </div>

        <!-- Linha inferior -->
        <div class="border-t border-gray-700 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center">
          <p class="text-sm text-gray-400">
            © 2023 Gym Genesis. Todos os direitos reservados.
          </p>
          <div class="flex space-x-5 mt-4 md:mt-0">
            <!-- Facebook -->
            <a href="#" class="text-gray-400 hover:text-indigo-400 transition-colors">
              <i class="fab fa-facebook-f text-lg"></i>
            </a>
            <!-- Instagram -->
            <a href="#" class="text-gray-400 hover:text-indigo-400 transition-colors">
              <i class="fab fa-instagram text-lg"></i>
            </a>
            <!-- Twitter -->
            <a href="#" class="text-gray-400 hover:text-indigo-400 transition-colors">
              <i class="fab fa-twitter text-lg"></i>
            </a>
          </div>
        </div>
      </div>
    </footer>

  </div>

  <!-- Notification Modal -->
<div
  id="notificationModal"
  class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center">
  <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6">
    
    <!-- Cabeçalho -->
    <div class="flex justify-between items-center mb-5">
      <h3 class="text-xl font-semibold text-gray-800">🔔 Notificações</h3>
      <button
        id="closeNotificationBtn"
        class="text-gray-400 hover:text-indigo-500 transition">
        <i class="fas fa-times text-xl"></i>
      </button>
    </div>

    <!-- Lista de Notificações -->
    <div class="space-y-4 max-h-72 overflow-y-auto pr-1">

      <!-- Notificação 1 -->
      <div class="flex items-start p-3 bg-indigo-50 border border-indigo-100 rounded-xl">
        <div class="bg-indigo-100 p-2 rounded-full mr-3">
          <i class="fas fa-calendar-check text-indigo-600 text-base"></i>
        </div>
        <div>
          <h4 class="text-sm font-semibold text-gray-800">
            Aula de Spinning Confirmada
          </h4>
          <p class="text-sm text-gray-600">
            Sua reserva para a aula de amanhã às 19h foi confirmada.
          </p>
          <p class="text-xs text-gray-500 mt-1">⏰ Há 2 horas</p>
        </div>
      </div>

      <!-- Notificação 2 -->
      <div class="flex items-start p-3 bg-green-50 border border-green-100 rounded-xl">
        <div class="bg-green-100 p-2 rounded-full mr-3">
          <i class="fas fa-check-circle text-green-600 text-base"></i>
        </div>
        <div>
          <h4 class="text-sm font-semibold text-gray-800">
            Meta Alcançada!
          </h4>
          <p class="text-sm text-gray-600">
            Você atingiu sua meta de frequência semanal. Continue assim!
          </p>
          <p class="text-xs text-gray-500 mt-1">📅 Ontem</p>
        </div>
      </div>

      <!-- + Você pode adicionar mais notificações aqui -->
      
    </div>

    <!-- Botão Ver Todas -->
    <button
      class="w-full mt-5 text-sm text-indigo-600 hover:underline flex items-center justify-center font-medium transition">
      Ver todas as notificações
      <i class="fas fa-chevron-right text-xs ml-2"></i>
    </button>
  </div>
</div>

  <script>
    // Progress Chart
    const ctx = document.getElementById("progressChart").getContext("2d");
    const progressChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: ["Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
        datasets: [{
            label: "Calorias Queimadas",
            data: [450, 580, 690, 520, 730, 810, 540],
            borderColor: "rgb(99, 102, 241)",
            backgroundColor: "rgba(99, 102, 241, 0.1)",
            tension: 0.3,
            fill: true,
          },
          {
            label: "Tempo de Treino (min)",
            data: [45, 60, 75, 55, 80, 90, 60],
            borderColor: "rgb(16, 185, 129)",
            backgroundColor: "rgba(16, 185, 129, 0.0)",
            tension: 0.3,
            borderDash: [5, 5],
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "top",
          },
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              display: true,
              color: "rgba(0, 0, 0, 0.05)",
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });

    // Progress Button Handlers
    const progressBtns = document.querySelectorAll(".progress-btn");
    progressBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        // Reset all buttons
        progressBtns.forEach((b) => {
          b.classList.remove("bg-indigo-600", "text-white");
          b.classList.add("bg-gray-200", "text-gray-700");
        });

        // Highlight clicked button
        btn.classList.remove("bg-gray-200", "text-gray-700");
        btn.classList.add("bg-indigo-600", "text-white");

        // Update chart data based on period
        const period = btn.dataset.period;
        let labels, caloriesData, timeData;

        if (period === "week") {
          labels = ["Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"];
          caloriesData = [450, 580, 690, 520, 730, 810, 540];
          timeData = [45, 60, 75, 55, 80, 90, 60];
        } else if (period === "month") {
          labels = ["Semana 1", "Semana 2", "Semana 3", "Semana 4"];
          caloriesData = [3200, 3800, 4100, 3900];
          timeData = [320, 380, 410, 390];
        } else {
          labels = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun"];
          caloriesData = [12000, 14500, 13800, 15200, 16100, 15800];
          timeData = [1200, 1450, 1380, 1520, 1610, 1580];
        }

        progressChart.data.labels = labels;
        progressChart.data.datasets[0].data = caloriesData;
        progressChart.data.datasets[1].data = timeData;
        progressChart.update();
      });
    });

    // Notification Modal
    const notificationBtn = document.getElementById("notificationBtn");
    const notificationModal = document.getElementById("notificationModal");
    const closeNotificationBtn = document.getElementById(
      "closeNotificationBtn"
    );

    notificationBtn.addEventListener("click", () => {
      notificationModal.classList.remove("hidden");
      notificationModal.classList.add("flex");
    });

    closeNotificationBtn.addEventListener("click", () => {
      notificationModal.classList.add("hidden");
      notificationModal.classList.remove("flex");
    });

    // Close modal when clicking outside
    notificationModal.addEventListener("click", (e) => {
      if (e.target === notificationModal) {
        notificationModal.classList.add("hidden");
        notificationModal.classList.remove("flex");
      }
    });
  </script>
  <script>
    (function() {
      function c() {
        var b = a.contentDocument || a.contentWindow.document;
        if (b) {
          var d = b.createElement("script");
          d.innerHTML =
            "window.__CF$cv$params={r:'94bcd4c1c300e01a',t:'MTc0OTI2NDUxMi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
          b.getElementsByTagName("head")[0].appendChild(d);
        }
      }
      if (document.body) {
        var a = document.createElement("iframe");
        a.height = 1;
        a.width = 1;
        a.style.position = "absolute";
        a.style.top = 0;
        a.style.left = 0;
        a.style.border = "none";
        a.style.visibility = "hidden";
        document.body.appendChild(a);
        if ("loading" !== document.readyState) c();
        else if (window.addEventListener)
          document.addEventListener("DOMContentLoaded", c);
        else {
          var e = document.onreadystatechange || function() {};
          document.onreadystatechange = function(b) {
            e(b);
            "loading" !== document.readyState &&
              ((document.onreadystatechange = e), c());
          };
        }
      }
    })();
  </script>
  <script>
    lucide.createIcons();
  </script>

  <iframe
    height="1"
    width="1"
    style="
        position: absolute;
        top: 0px;
        left: 0px;
        border: none;
        visibility: hidden;
      "></iframe>
</body>

</html>