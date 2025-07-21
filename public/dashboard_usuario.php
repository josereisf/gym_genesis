<?php
  require_once "../code/funcao.php";
  session_start();
  $idaluno = $_SESSION['usuario_id'];
  $nomes = $_SESSION['usuario_nome'] ?? null;
  $resultados = listarAvaliacaoFisica($idaluno);
  $nome = $peso = $altura = $imc = $perc_gord = $data = "-"; // evita warning
  foreach ($resultados as $r) {
      $nome = $r['nome_usuario'];
      $peso = $r['peso'];
      $altura = $r['altura'];
      $imc = $r['imc'];
      $perc_gord = $r['percentual_gordura'];
      $data = $r['data_avaliacao'];
  }

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
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50">
      <!-- Navbar -->
      <nav class="bg-indigo-600 text-white shadow-lg">
        <div
          class="container mx-auto px-4 py-3 flex justify-between items-center"
        >
          <div class="flex items-center space-x-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-8 w-8"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
              ></path>
            </svg>
            <span class="font-bold text-xl">Gym Genesis Academia</span>
          </div>
          <div class="flex items-center space-x-4">
            <div class="relative">
              <button
                id="notificationBtn"
                class="text-white hover:text-indigo-200"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                  ></path>
                </svg>
                <span
                  class="absolute -top-1 -right-1 bg-red-500 text-xs rounded-full h-4 w-4 flex items-center justify-center"
                  >2</span
                >
              </button>
            </div>
            <div class="flex items-center space-x-2">
              <img
                src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBjbGFzcz0ibHVjaWRlIGx1Y2lkZS11c2VyLWNpcmNsZSI+PGNpcmNsZSBjeD0iMTIiIGN5PSIxMiIgcj0iMTAiLz48Y2lyY2xlIGN4PSIxMiIgY3k9IjEwIiByPSIzIi8+PHBhdGggZD0iTTcgMjAuNjZWMTlhMiAyIDAgMCAxIDItMmg2YTIgMiAwIDAgMSAyIDJ2MS42NiIvPjwvc3ZnPg=="
                alt="Perfil"
                class="h-8 w-8 rounded-full bg-white p-1"
              />
              <span class="font-medium hidden md:block"><?= $nomes ?></span>
            </div>
          </div>
        </div>
      </nav>

      <!-- Main Content -->
      <div class="container mx-auto px-4 py-6">
        
        <!-- Welcome Section -->
        <div class="mb-8">
          <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
            Olá, <?= "$nomes'!'"?>👋
          </h1>
          <p class="text-gray-600">
            Bem-vindo ao seu dashboard. Veja seu progresso e próximos treinos.
          </p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <!-- Attendance Card -->
          <div
            class="bg-white rounded-xl shadow-md p-6 transition-all hover:shadow-lg"
          >
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-500">
                  Frequência Mensal
                </p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">16/20</h3>
                <p class="text-sm text-green-600 mt-1 flex items-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 10l7-7m0 0l7 7m-7-7v18"
                    ></path>
                  </svg>
                  80% de presença
                </p>
              </div>
              <div class="bg-indigo-100 p-3 rounded-lg">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6 text-indigo-600"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                  ></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Calories Card -->
          <div
            class="bg-white rounded-xl shadow-md p-6 transition-all hover:shadow-lg"
          >
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-500">
                  Calorias Queimadas
                </p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1"><?= $perc_gord ?></h3>
                <p class="text-sm text-green-600 mt-1 flex items-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 10l7-7m0 0l7 7m-7-7v18"
                    ></path>
                  </svg>
                  12% esta semana
                </p>
              </div>
              <div class="bg-orange-100 p-3 rounded-lg">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6 text-orange-500"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"
                  ></path>
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"
                  ></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Weight Card -->
          <div
            class="bg-white rounded-xl shadow-md p-6 transition-all hover:shadow-lg"
          >
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-500"><?= $peso ?></p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">78.5 kg</h3>
                <p class="text-sm text-green-600 mt-1 flex items-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 14l-7 7m0 0l-7-7m7 7V3"
                    ></path>
                  </svg>
                  2.5 kg desde o início
                </p>
              </div>
              <div class="bg-blue-100 p-3 rounded-lg">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6 text-blue-600"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"
                  ></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Membership Card -->
          <div
            class="bg-white rounded-xl shadow-md p-6 transition-all hover:shadow-lg"
          >
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-500">Plano</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">Premium</h3>
                <p class="text-sm text-amber-600 mt-1 flex items-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                    ></path>
                  </svg>
                  Renova em 18 dias
                </p>
              </div>
              <div class="bg-purple-100 p-3 rounded-lg">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6 text-purple-600"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  ></path>
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- Left Column -->
          <div class="lg:col-span-2 space-y-6">
            <!-- Progress Chart -->
            <div class="bg-white rounded-xl shadow-md p-6">
              <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">
                  Seu Progresso
                </h2>
                <div class="flex space-x-2">
                  <button
                    class="progress-btn px-3 py-1 text-sm rounded-md bg-indigo-600 text-white"
                    data-period="week"
                  >
                    Semana
                  </button>
                  <button
                    class="progress-btn px-3 py-1 text-sm rounded-md bg-gray-200 text-gray-700"
                    data-period="month"
                  >
                    Mês
                  </button>
                  <button
                    class="progress-btn px-3 py-1 text-sm rounded-md bg-gray-200 text-gray-700"
                    data-period="year"
                  >
                    Ano
                  </button>
                </div>
              </div>
              <div class="h-64">
                <canvas
                  id="progressChart"
                  width="688"
                  height="256"
                  style="
                    display: block;
                    box-sizing: border-box;
                    height: 256px;
                    width: 688px;
                  "
                ></canvas>
              </div>
            </div>

            <!-- Today's Workout -->
            <div class="bg-white rounded-xl shadow-md p-6">
              <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">
                  Treino de Hoje
                </h2>
                <span
                  class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800"
                  >Treino A - Peito e Tríceps</span
                >
              </div>
              <div class="space-y-4">
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6 text-indigo-600"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                      ></path>
                    </svg>
                  </div>
                  <div class="flex-1">
                    <h3 class="font-medium text-gray-800">Supino Reto</h3>
                    <p class="text-sm text-gray-600">
                      4 séries x 12 repetições
                    </p>
                  </div>
                  <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-600 mr-2"
                      >30kg</span
                    >
                    <input
                      type="checkbox"
                      class="form-checkbox h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500"
                    />
                  </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6 text-indigo-600"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                      ></path>
                    </svg>
                  </div>
                  <div class="flex-1">
                    <h3 class="font-medium text-gray-800">Crucifixo</h3>
                    <p class="text-sm text-gray-600">
                      3 séries x 15 repetições
                    </p>
                  </div>
                  <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-600 mr-2"
                      >15kg</span
                    >
                    <input
                      type="checkbox"
                      class="form-checkbox h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500"
                    />
                  </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6 text-indigo-600"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                      ></path>
                    </svg>
                  </div>
                  <div class="flex-1">
                    <h3 class="font-medium text-gray-800">Tríceps Corda</h3>
                    <p class="text-sm text-gray-600">
                      4 séries x 12 repetições
                    </p>
                  </div>
                  <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-600 mr-2"
                      >25kg</span
                    >
                    <input
                      type="checkbox"
                      class="form-checkbox h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500"
                    />
                  </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6 text-indigo-600"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                      ></path>
                    </svg>
                  </div>
                  <div class="flex-1">
                    <h3 class="font-medium text-gray-800">Tríceps Francês</h3>
                    <p class="text-sm text-gray-600">
                      3 séries x 12 repetições
                    </p>
                  </div>
                  <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-600 mr-2"
                      >12kg</span
                    >
                    <input
                      type="checkbox"
                      class="form-checkbox h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500"
                    />
                  </div>
                </div>

                <button
                  class="w-full mt-4 bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition-colors flex items-center justify-center"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                    ></path>
                  </svg>
                  Concluir Treino
                </button>
              </div>
            </div>
          </div>

          <!-- Right Column -->
          <div class="space-y-6">
            <!-- Goal Progress -->
            <div class="bg-white rounded-xl shadow-md p-6">
              <h2 class="text-lg font-semibold text-gray-800 mb-4">Metas</h2>
              <div class="space-y-6">
                <div>
                  <div class="flex justify-between mb-2">
                    <span class="text-sm font-medium text-gray-600"
                      >Perda de Peso</span
                    >
                    <span class="text-sm font-medium text-indigo-600">75%</span>
                  </div>
                  <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div
                      class="bg-indigo-600 h-2.5 rounded-full"
                      style="width: 75%"
                    ></div>
                  </div>
                  <div class="flex justify-between mt-1 text-xs text-gray-500">
                    <span>Meta: 72kg</span>
                    <span>Atual: 78.5kg</span>
                  </div>
                </div>

                <div>
                  <div class="flex justify-between mb-2">
                    <span class="text-sm font-medium text-gray-600"
                      >Frequência Semanal</span
                    >
                    <span class="text-sm font-medium text-green-600">100%</span>
                  </div>
                  <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div
                      class="bg-green-500 h-2.5 rounded-full"
                      style="width: 100%"
                    ></div>
                  </div>
                  <div class="flex justify-between mt-1 text-xs text-gray-500">
                    <span>Meta: 4 dias</span>
                    <span>Atual: 4 dias</span>
                  </div>
                </div>

                <div>
                  <div class="flex justify-between mb-2">
                    <span class="text-sm font-medium text-gray-600"
                      >Ganho Muscular</span
                    >
                    <span class="text-sm font-medium text-amber-600">40%</span>
                  </div>
                  <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div
                      class="bg-amber-500 h-2.5 rounded-full"
                      style="width: 40%"
                    ></div>
                  </div>
                  <div class="flex justify-between mt-1 text-xs text-gray-500">
                    <span>Meta: +5kg</span>
                    <span>Atual: +2kg</span>
                  </div>
                </div>

                <button
                  class="w-full bg-white border border-indigo-600 text-indigo-600 hover:bg-indigo-50 py-2 px-4 rounded-lg transition-colors flex items-center justify-center"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    ></path>
                  </svg>
                  Adicionar Nova Meta
                </button>
              </div>
            </div>

            <!-- Upcoming Classes -->
            <div class="bg-white rounded-xl shadow-md p-6">
              <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Próximas Aulas
              </h2>
              <div class="space-y-4">
                <div
                  class="flex items-center p-3 bg-indigo-50 rounded-lg border-l-4 border-indigo-600"
                >
                  <div class="mr-4 text-center">
                    <span class="block text-lg font-bold text-indigo-600"
                      >18</span
                    >
                    <span class="text-xs text-gray-500">JUN</span>
                  </div>
                  <div class="flex-1">
                    <h3 class="font-medium text-gray-800">Spinning</h3>
                    <p class="text-sm text-gray-600">
                      19:00 - 20:00 • Prof. Ana
                    </p>
                  </div>
                  <button class="text-indigo-600 hover:text-indigo-800">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                      ></path>
                    </svg>
                  </button>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <div class="mr-4 text-center">
                    <span class="block text-lg font-bold text-gray-600"
                      >20</span
                    >
                    <span class="text-xs text-gray-500">JUN</span>
                  </div>
                  <div class="flex-1">
                    <h3 class="font-medium text-gray-800">Yoga</h3>
                    <p class="text-sm text-gray-600">
                      18:00 - 19:00 • Prof. Marcos
                    </p>
                  </div>
                  <button class="text-indigo-600 hover:text-indigo-800">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                      ></path>
                    </svg>
                  </button>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <div class="mr-4 text-center">
                    <span class="block text-lg font-bold text-gray-600"
                      >22</span
                    >
                    <span class="text-xs text-gray-500">JUN</span>
                  </div>
                  <div class="flex-1">
                    <h3 class="font-medium text-gray-800">Funcional</h3>
                    <p class="text-sm text-gray-600">
                      20:00 - 21:00 • Prof. Ricardo
                    </p>
                  </div>
                  <button class="text-indigo-600 hover:text-indigo-800">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                      ></path>
                    </svg>
                  </button>
                </div>

                <button
                  class="w-full mt-2 bg-white border border-indigo-600 text-indigo-600 hover:bg-indigo-50 py-2 px-4 rounded-lg transition-colors flex items-center justify-center"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                    ></path>
                  </svg>
                  Ver Agenda Completa
                </button>
              </div>
            </div>

            <!-- Nutrition Tips -->
            <div class="bg-white rounded-xl shadow-md p-6">
              <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Dica Nutricional
              </h2>
              <div class="bg-green-50 p-4 rounded-lg">
                <div class="flex items-center mb-3">
                  <div class="bg-green-100 p-2 rounded-full mr-3">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6 text-green-600"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"
                      ></path>
                    </svg>
                  </div>
                  <h3 class="font-medium text-gray-800">
                    Proteínas pós-treino
                  </h3>
                </div>
                <p class="text-sm text-gray-700">
                  Consumir proteínas dentro de 30 minutos após o treino ajuda na
                  recuperação muscular e maximiza os resultados. Boas opções
                  incluem whey protein, ovos ou frango.
                </p>
                <button
                  class="mt-3 text-sm text-green-700 font-medium hover:underline flex items-center"
                >
                  Ler mais
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 ml-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5l7 7-7 7"
                    ></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="container mx-auto px-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
              <h3 class="text-lg font-semibold mb-4">FitPro Academia</h3>
              <p class="text-gray-400 text-sm">
                Sua jornada fitness começa aqui. Estamos comprometidos com sua
                saúde e bem-estar.
              </p>
            </div>
            <div>
              <h3 class="text-lg font-semibold mb-4">Links Rápidos</h3>
              <ul class="space-y-2 text-sm text-gray-400">
                <li>
                  <a href="#" class="hover:text-white">Horários de Aulas</a>
                </li>
                <li>
                  <a href="#" class="hover:text-white">Planos e Preços</a>
                </li>
                <li><a href="#" class="hover:text-white">Professores</a></li>
                <li><a href="#" class="hover:text-white">Contato</a></li>
              </ul>
            </div>
            <div>
              <h3 class="text-lg font-semibold mb-4">Contato</h3>
              <ul class="space-y-2 text-sm text-gray-400">
                <li class="flex items-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2 text-indigo-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                    ></path>
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                    ></path>
                  </svg>
                  Av. Principal, 1000 - Centro
                </li>
                <li class="flex items-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2 text-indigo-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                    ></path>
                  </svg>
                  (11) 99999-9999
                </li>
                <li class="flex items-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2 text-indigo-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    ></path>
                  </svg>
                  contato@fitproacademia.com
                </li>
              </ul>
            </div>
          </div>
          <div
            class="border-t border-gray-700 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center"
          >
            <p class="text-sm text-gray-400">
              © 2023 FitPro Academia. Todos os direitos reservados.
            </p>
            <div class="flex space-x-4 mt-4 md:mt-0">
              <a href="#" class="text-gray-400 hover:text-white">
                <svg
                  class="h-5 w-5"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                  aria-hidden="true"
                >
                  <path
                    fill-rule="evenodd"
                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-white">
                <svg
                  class="h-5 w-5"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                  aria-hidden="true"
                >
                  <path
                    fill-rule="evenodd"
                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-white">
                <svg
                  class="h-5 w-5"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                  aria-hidden="true"
                >
                  <path
                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"
                  ></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </footer>
    </div>

    <!-- Notification Modal -->
    <div
      id="notificationModal"
      class="fixed inset-0 bg-black bg-opacity-30 z-50 hidden items-center justify-center"
    >
      <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-gray-800">Notificações</h3>
          <button
            id="closeNotificationBtn"
            class="text-gray-500 hover:text-gray-700"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              ></path>
            </svg>
          </button>
        </div>
        <div class="space-y-4">
          <div class="flex p-3 bg-indigo-50 rounded-lg">
            <div class="bg-indigo-100 p-2 rounded-full mr-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-indigo-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                ></path>
              </svg>
            </div>
            <div>
              <h4 class="font-medium text-gray-800">
                Aula de Spinning Confirmada
              </h4>
              <p class="text-sm text-gray-600">
                Sua reserva para a aula de amanhã às 19h foi confirmada.
              </p>
              <p class="text-xs text-gray-500 mt-1">Há 2 horas</p>
            </div>
          </div>

          <div class="flex p-3 bg-green-50 rounded-lg">
            <div class="bg-green-100 p-2 rounded-full mr-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-green-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                ></path>
              </svg>
            </div>
            <div>
              <h4 class="font-medium text-gray-800">Meta Alcançada!</h4>
              <p class="text-sm text-gray-600">
                Você atingiu sua meta de frequência semanal. Continue assim!
              </p>
              <p class="text-xs text-gray-500 mt-1">Ontem</p>
            </div>
          </div>
        </div>
        <button
          class="w-full mt-4 text-sm text-indigo-600 hover:underline flex items-center justify-center"
        >
          Ver todas as notificações
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4 ml-1"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 5l7 7-7 7"
            ></path>
          </svg>
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
          datasets: [
            {
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
      (function () {
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
            var e = document.onreadystatechange || function () {};
            document.onreadystatechange = function (b) {
              e(b);
              "loading" !== document.readyState &&
                ((document.onreadystatechange = e), c());
            };
          }
        }
      })();
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
      "
    ></iframe>
  </body>
</html>
