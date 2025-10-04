<?php

use Vtiful\Kernel\Format;

require_once __DIR__ . "/../code/funcao.php";
require_once __DIR__ . "/php/verificarLogado.php";


$idaluno = $_SESSION["id"];
$nomes = $_SESSION['nome'] ?? "-";
// var_dump($_SESSION["id"]);

$peso = $altura = $imc = $perc_gord = $plano = $dia_inicial = $dia_fim = $dia_renovacao = "-";
$foto = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBjbGFzcz0ibHVjaWRlIGx1Y2lkZS11c2VyLWNpcmNsZSI+PGNpcmNsZSBjeD0iMTIiIGN5PSIxMiIgcj0iMTAiLz48Y2lyY2xlIGN4PSIxMiIgY3k9IjEwIiByPSIzIi8+PHBhdGggZD0iTTcgMjAuNjZWMTlhMiAyIDAgMCAxIDItMmg2YTIgMiAwIDAgMSAyIDJ2MS42NiIvPjwvc3ZnPg==';

$resultados = listarUsuarioCompleto($idaluno);
if ($resultados && count($resultados) > 0) {
  $r = $resultados[0]; // Assume apenas um resultado

  $nomes = $r['nome_usuario'] ?? $nomes;
  $peso = (float)($r['peso'] ?? 0);
  $altura = $r['altura'] ?? "-";
  $imc = $r['imc'] ?? "-";
  $perc_gord = $r['percentual_gordura'] ?? "-";
  $plano = $r['tipo_plano'] ?? "-";
  $dia_inicial = $r['data_inicio'] ?? "-";
  $dia_fim = $r['data_fim'] ?? null;
  $foto = $r['foto_perfil'] ?? $foto;
  $email = $r['email'] ?? "-";
  $idmeta = $r['idmeta'];
}

$metas = listarMetaUsuario($idaluno);

$metasProcessadas = [];

if (!empty($metas)) {
  foreach ($metas as $meta) {
    $inicioRaw = $meta['data_inicio'] ?? null;
    $limiteRaw = $meta['data_limite'] ?? null;

    $progresso = 0;

    if ($inicioRaw && $limiteRaw) {
      $hoje     = strtotime(date("Y-m-d"));
      $inicio   = strtotime($inicioRaw);
      $limite   = strtotime($limiteRaw);

      if ($hoje <= $inicio) {
        $progresso = 0; // ainda não começou
      } elseif ($hoje >= $limite) {
        $progresso = 100; // já passou do prazo
      } else {
        $total     = $limite - $inicio;
        $andamento = $hoje - $inicio;
        $progresso = round(($andamento / $total) * 100, 2);
      }
    }

    // Definição de cores conforme progresso
    if ($progresso >= 100) {
      $corBarra = "bg-green-500";
      $corTexto = "text-green-400";
    } elseif ($progresso >= 50) {
      $corBarra = "bg-yellow-400";
      $corTexto = "text-yellow-400";
    } else {
      $corBarra = "bg-red-500";
      $corTexto = "text-red-400";
    }

    // Dados formatados
    $descricao   = !empty($meta['descricao']) ? htmlspecialchars($meta['descricao']) : "-";
    $inicioFmt   = $inicioRaw ? date("d/m/Y", strtotime($inicioRaw)) : "-";
    $limiteFmt   = $limiteRaw ? date("d/m/Y", strtotime($limiteRaw)) : "-";
    $status      = !empty($meta['status']) ? ucfirst($meta['status']) : "-";
    $usuario     = !empty($meta['nome']) ? htmlspecialchars($meta['nome']) : "-";

    $metasProcessadas[] = [
      'descricao'   => $descricao,
      'progresso'   => $progresso,
      'corBarra'    => $corBarra,
      'corTexto'    => $corTexto,
      'inicio'      => $inicioFmt,
      'limite'      => $limiteFmt,
      'status'      => $status,
      'usuario'     => $usuario
    ];
  }
} else {
  $metasProcessadas[] = [
    'descricao'   => "-",
    'progresso'   => 0,
    'corBarra'    => "bg-gray-500",
    'corTexto'    => "text-gray-400",
    'inicio'      => "-",
    'limite'      => "-",
    'status'      => "-",
    'usuario'     => "-"
  ];
}

// echo '<pre>';
// var_dump(
//   $metas
// );
// echo '</pre>';
$historico_peso = listarHistoricoPeso($idaluno);

$diferenca = "Não há histórico de peso suficiente.";
$icone = ""; // ícone da seta
$cor = "";   // cor da seta e do texto
$pesoAntigo = 0; // garante que existe
$pesoRecente = 0; // valor padrão seguro

if (!empty($historico_peso) && count($historico_peso) >= 2) {
  // Pega o peso mais recente e o mais antigo
  $pesoRecente = $historico_peso[0]['peso'];
  $pesoAntigo  = $historico_peso[count($historico_peso) - 1]['peso'];

  $calculo = $pesoRecente - $pesoAntigo;

  if ($calculo > 0) {
    $icone = "fas fa-arrow-up";
    $cor = "text-red-500";
    $diferenca = "Você ganhou " . abs($calculo) . " kg desde o início";
  } elseif ($calculo < 0) {
    $icone = "fas fa-arrow-down";
    $cor = "text-green-400";
    $diferenca = "Você perdeu " . abs($calculo) . " kg desde o início";
  } else {
    $icone = "fas fa-arrows-alt-h";
    $cor = "text-gray-400";
    $diferenca = "Sem alteração de peso desde o início";
  }
} else {
  // Quando não há histórico suficiente
  $icone = "fas fa-arrows-alt-h";
  $cor = "text-gray-400";
  $diferenca = "Não há histórico de peso suficiente.";
}

$avaliacao_fisica = listarAvaliacaoFisica($idaluno);
$porcentagem2 = "Não há histórico de calorias suficientes.";
$porcentagem  = null;

if (!empty($avaliacao_fisica) && count($avaliacao_fisica) >= 2) {
  $perc_gordRecente = $avaliacao_fisica[0]['percentual_gordura'] ?? 0;
  $perc_gordAntigo  = $avaliacao_fisica[count($avaliacao_fisica) - 1]['percentual_gordura'] ?? 0;
  $diferenca2 = abs($perc_gordRecente - $perc_gordAntigo);

  // Evita divisão por zero e variável nula
  if (!empty($pesoAntigo) && $pesoAntigo != 0) {
    $porcentagem = ($diferenca2 / $pesoAntigo) * 100;
    $porcentagem = number_format($porcentagem, 1);
    $porcentagem2 = "$porcentagem% desde o início";
  } else {
    $porcentagem2 = "Não é possível calcular a porcentagem.";
  }
}


// Cálculo da renovação se não tiver data fim vinda do usuário
if ($dia_fim === null || $dia_fim === "-") {
  $assinaturasJson = listarAssinaturas(null); // Busca todas
  $assinaturas = json_decode($assinaturasJson, true);

  // Filtra pelas assinaturas do usuário atual
  if (is_array($assinaturas)) {
    foreach ($assinaturas as $assinatura) {
      if (isset($assinatura['nome']) && $assinatura['nome'] === $nomes) {
        $dia_fim = $assinatura['data_fim'] ?? null;
        break;
      }
    }
  }

  $classe_cor = 'text-gray-400'; // padrão visual

  if ($dia_fim && strtotime($dia_fim) > time()) {
    $dias_restantes = (strtotime($dia_fim) - time()) / (60 * 60 * 24);

    if ($dias_restantes > 10) {
      $classe_cor = 'text-green-400';
    } elseif ($dias_restantes > 3) {
      $classe_cor = 'text-yellow-400';
    } else {
      $classe_cor = 'text-red-500';
    }

    $dia_renovacao = "Faltam " . ceil($dias_restantes) . " dias para vencer";
  } else {
    $classe_cor = 'text-red-500';
    $dia_renovacao = "Plano vencido ou não definido";
  }
}

// $idprofessor = null;
// $relacionamento = listarProfessorAluno($idprofessor, $idaluno);
// pega todas as dicas
$dicas = listarDicasNutricionais();
$aula_agendada = listarAulaAgendadaUsuario($idaluno);
$aula_agendada = array_slice($aula_agendada, 0, 5);
// echo "<pre>";
// var_dump($aula_agendada);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Academia - Área do Cliente</title>
  <link rel="stylesheet" href="./css/dashboard_usuario.css">
  <!-- Tailwind CSS (para desenvolvimento rápido; depois, pode trocar pelo output.css) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Font Awesome (versão free, ícones) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Chart.js (para gráficos) -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <!-- <link rel="stylesheet" href="./css/tailwind-output.css"> -->
  <link rel="stylesheet" href="./css/dashboard_usuario.css">

  <style>
    .concluido {
      opacity: 0.6;
      /* deixa mais apagado */
    }

    .concluido .descricao {
      text-decoration: line-through;
      /* risca o texto */
      color: #9ca3af;
      /* cinza claro */
    }
  </style>
</head>

<body>
  <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800">
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
          <!-- BOTÃO DO PERFIL -->
          <div id="botaoPerfil" class="flex items-center space-x-2 cursor-pointer">
            <img
              src="./uploads/<?= $foto ?>"
              alt="Perfil"
              class="h-12 w-12 rounded-full p-1" />
            <span class="font-medium hidden md:block text-white"><?= $nomes ?></span>
          </div>
          <!-- DROPDOWN DO PERFIL (INICIALMENTE OCULTO) -->
          <div
            id="menuPerfil"
            class="absolute top-16 right-4 z-50 max-w-xs w-full bg-white border border-green-200 rounded-xl overflow-hidden shadow-[0_10px_25px_-5px_rgba(0,0,0,0.05),0_8px_10px_-6px_rgba(0,0,0,0.04)] hidden transition-all duration-300">
            <!-- Cabeçalho -->
            <div class="px-4 py-4 border-b border-green-200 bg-gradient-to-r from-green-700 to-green-600">
              <p class="text-xs font-medium text-green-200 uppercase tracking-wider">
                Conectado como
              </p>
              <div class="flex items-center mt-1">
                <div class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center mr-2 overflow-hidden">
                  <img src="./uploads/<?= $foto ?>" alt="" class="w-full h-full object-cover rounded-full">
                </div>
                <p class="text-sm font-medium text-white truncate"><?= $email ?></p>
              </div>
            </div>

            <!-- Opções -->
            <div class="py-1.5">
              <a href="#" class="group relative flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50">
                <div class="absolute left-0 top-0 h-full w-1 bg-green-500 rounded-r opacity-0 group-hover:opacity-100"></div>
                <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center mr-3 group-hover:bg-green-200">
                  <i data-lucide="user-circle" class="w-5 h-5 text-green-600 group-hover:text-green-700"></i>
                </div>
                <span class="font-medium group-hover:text-green-900">Perfil</span>
              </a>

              <a href="#" class="group relative flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50">
                <div class="absolute left-0 top-0 h-full w-1 bg-green-600 rounded-r opacity-0 group-hover:opacity-100"></div>
                <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center mr-3 group-hover:bg-green-200">
                  <i data-lucide="settings" class="h-5 w-5 text-green-600 group-hover:text-green-700"></i>
                </div>
                <span class="font-medium group-hover:text-green-900">Configurações</span>
              </a>

              <a href="../php/saida.php" class="group relative flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50">
                <div class="absolute left-0 top-0 h-full w-1 bg-red-500 rounded-r opacity-0 group-hover:opacity-100"></div>
                <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center mr-3 group-hover:bg-red-200">
                  <i data-lucide="log-out" class="h-5 w-5 text-red-500 group-hover:text-red-600"></i>
                </div>
                <span class="font-medium group-hover:text-red-600">Sair</span>
              </a>
            </div>
          </div>



        </div>
      </div>
    </nav>


    <!-- Main Content -->
    <div class="container mx-auto px-4 py-6">

      <!-- Welcome Section -->
      <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-green-400">
          Olá, <?= "$nomes'!'" ?>👋
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
            <div class="w-full">
              <p class="text-sm font-medium text-gray-400">Consumo de Água</p>
              <h3 class="text-2xl font-bold text-white mt-1">1.5L / 3L</h3>
              <div class="w-full bg-[#1f2937] h-2 rounded-full mt-2">
                <div class="bg-blue-500 h-2 rounded-full" style="width: 50%"></div>
              </div>
              <p class="text-sm text-blue-400 mt-1 flex items-center">
                <i class="fas fa-tint text-blue-400 w-4 h-4 mr-1"></i>
                Hidratação em andamento
              </p>

              <!-- Botões escondidos inicialmente -->
              <div id="botoes-agua" class="flex gap-2 mt-4 hidden">
                <button class="bg-[#1f2937] text-white px-3 py-1 rounded-lg border border-blue-500 hover:bg-blue-600 transition text-sm">
                  +250ml
                </button>
                <button class="bg-[#1f2937] text-white px-3 py-1 rounded-lg border border-blue-500 hover:bg-blue-600 transition text-sm">
                  +500ml
                </button>
              </div>
            </div>

            <!-- Ícone com clique -->
            <div class="bg-[#1f2937] p-3 rounded-lg ml-4 cursor-pointer" onclick="mostrarBotoesAgua()">
              <i class="fas fa-glass-water-droplet text-blue-400 text-xl"></i>
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
                <?= $porcentagem2 ?>
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
              <h3 class="text-2xl font-bold text-white mt-1"><?= number_format($pesoRecente, 1, ',', ''); ?> KG</h3>
              <p class="text-sm mt-1 flex items-center <?= $cor ?>">
                <i class="<?= $icone ?> w-4 h-4 mr-1"></i>
                <?= $diferenca ?>
              </p>
              <form id="form-peso" action="./api/index.php?entidade=historico_peso&acao=cadastrar" method="post">
                <input type="hidden" name="idusuario" value="<?= $idaluno ?>">
                <div id="input-peso" class="hidden mt-2">
                  <input type="text" name="peso" id="novo-peso" class="p-2 rounded-md" placeholder="Digite seu novo peso" required>
                  <button type="submit" class="bg-blue-500 text-white p-2 rounded-md mt-2">Salvar Peso</button>
                </div>
              </form>

            </div>
            <div class="bg-[#1f2937] p-3 rounded-lg cursor-pointer" onclick="mostrarInput()">
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
              <p class="text-sm <?= $classe_cor ?> mt-1 flex items-center">
                <i class="fas fa-clock <?= $classe_cor ?> w-4 h-4 mr-1"></i>
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
              <h2 class="text-lg font-semibold text-white">Seu progresso</h2>
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
  </div>

<div class="space-y-4">
  <?php
  if (isset($aula_agendada) && !empty($aula_agendada)) {
      $temTreino = false; // flag para saber se algum treino foi encontrado

      foreach ($aula_agendada as $aula) {
          $idtreino = $aula['idtreino'];
          $treino   = listarTreinoUsuario($idtreino);

          if (!empty($treino)) {
              foreach ($treino as $t) {
                  $exercicios = listarTreinoExercicioTreino($t['idtreino']);

                  if (!empty($exercicios)) {
                      $temTreino = true;

                      echo '
                      <div class="p-4 bg-[#111827] rounded-xl shadow-md mb-4">
                          <h3 class="text-lg font-semibold text-white mb-3">' . htmlspecialchars($t['descricao']) . '</h3>
                          <div class="space-y-3">';
                      
                      foreach ($exercicios as $ex) {
                          $serie     = $ex['series'];
                          $repeticao = $ex['repeticoes'];
                          $tempo     = $ex['intervalo_segundos'];

                          echo '
                          <div class="flex items-center p-3 bg-[#1f2937] rounded-lg transition hover:bg-gray-700" id="card-' . $t['idtreino'] . '">
                              <div class="bg-green-900 p-3 rounded-lg mr-4">
                                  <i data-lucide="dumbbell" class="h-6 w-6 text-green-400"></i>
                              </div>
                              <div class="flex-1">
                                  <h4 class="font-medium text-white">' . htmlspecialchars($ex['nome']) . '</h4>
                                  <p class="text-sm text-gray-400">' . $serie . ' séries x ' . $repeticao . ' repetições</p>
                              </div>
                              <div class="flex items-center">
                                  <span class="text-sm font-medium text-gray-300 mr-2">' . $tempo . 's</span>
                                  <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500 rounded focus:ring-green-500" onchange="concluirTreino(' . $t['idtreino'] . ')" />
                              </div>
                          </div>';
                      }

                      echo '</div></div>'; // fecha lista de exercícios + bloco treino
                  }
              }
          }
      }

      // Botão só aparece uma vez no final, se houver treino
      if ($temTreino) {
          echo '
          <button onclick="concluirTreinoTodos()" 
            class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg flex items-center justify-center">
              <i class="fa-regular fa-check-circle h-5 w-5 mr-2"></i>
              Concluir Treino
          </button>';
      } else {
          echo '<button id="btnStart"
            class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg flex items-center justify-center">                
              <i class="fa-regular fa-calendar h-5 w-5 mr-2"></i>
              Agende sua aula com Algum Professor
          </button>';
      }

  } else {
      echo '<p class="text-gray-400 text-center">Nenhum treino agendado para hoje.</p>';
      echo '<button id="btnStart"
            class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg flex items-center justify-center">                
              <i class="fa-regular fa-calendar h-5 w-5 mr-2"></i>
              Agende sua aula com Algum Professor
          </button>';
  }
  ?>
</div>


</div>

        </div>


        <!-- Right Column -->
        <div class="space-y-6">
          <!-- Goal Progress -->
          <div class="bg-[#111827] rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Metas</h2>
            <div class="space-y-6">
              <!-- <pre>
              // ? print_r($metasProcessadas) ?>
              </pre>; -->
              <!-- Metas Dinâmicas -->
              <?php
              $metasProcessadas = array_slice($metasProcessadas, 0, 5);
              foreach ($metasProcessadas as $meta): ?>
                <div>
                  <div class="flex justify-between mb-2">
                    <span class="text-sm font-medium text-gray-300">
                      <?= htmlspecialchars($meta['descricao']) ?>
                    </span>
                    <span class="text-sm font-medium 
            <?= $meta['progresso'] >= 80 ? 'text-green-400' : ($meta['progresso'] >= 50 ? 'text-yellow-400' : 'text-red-400') ?>">
                      <?= $meta['progresso'] ?>%
                    </span>
                  </div>

                  <div class="w-full bg-gray-700 rounded-full h-2.5">
                    <div class="
              <?= $meta['progresso'] >= 80 ? 'bg-green-500' : ($meta['progresso'] >= 50 ? 'bg-yellow-400' : 'bg-red-500') ?>
              h-2.5 rounded-full"
                      style="width: <?= $meta['progresso'] ?>%">
                    </div>
                  </div>

                  <div class="flex justify-between mt-1 text-xs text-gray-400">
                    <span>Início: <?= date("d/m/Y", strtotime($meta['inicio'])) ?></span>
                    <span>Limite: <?= $meta['limite'] ? date("d/m/Y", strtotime($meta['limite'])) : '—' ?></span>
                  </div>

                  <div class="flex justify-between mt-1 text-xs text-gray-400">
                    <span>Status: <?= ucfirst($meta['status']) ?></span>
                    <span>Usuário: <?= htmlspecialchars($meta['usuario']) ?></span>
                  </div>
                </div>
              <?php endforeach; ?>

              <!-- Botão -->
              <button
                id="btnAbrirModal"
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

            <!-- Modal -->
            <div
              id="modalForm"
              class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
              <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md">
                <h3 class="text-white text-xl mb-4">Nova Meta</h3>
                <form id="formMeta" class="space-y-4">
                  <input type="hidden" name="idusuario" value="<?= $idaluno ?>" />
                  <input type="hidden" name="status" value="ativa" />

                  <div>
                    <label class="block text-gray-300 mb-1" for="descricao">Descrição</label>
                    <textarea
                      id="descricao"
                      name="descricao"
                      required
                      rows="3"
                      class="w-full rounded-md border border-gray-600 bg-gray-900 px-3 py-2 text-white resize-none"
                      placeholder="Descreva sua meta aqui"></textarea>
                  </div>

                  <div>
                    <label class="block text-gray-300 mb-1" for="data_inicio">Data de Início</label>
                    <input
                      type="date"
                      id="data_inicio"
                      name="data_inicio"
                      required
                      class="w-full rounded-md border border-gray-600 bg-gray-900 px-3 py-2 text-white" />
                  </div>

                  <div>
                    <label class="block text-gray-300 mb-1" for="data_limite">Data Limite (opcional)</label>
                    <input
                      type="date"
                      id="data_limite"
                      name="data_limite"
                      class="w-full rounded-md border border-gray-600 bg-gray-900 px-3 py-2 text-white" />
                  </div>

                  <div class="flex justify-end space-x-3">
                    <button
                      type="button"
                      id="btnFecharModal"
                      class="px-4 py-2 rounded bg-gray-700 hover:bg-gray-600 text-white">
                      Cancelar
                    </button>
                    <button
                      type="submit"
                      class="px-4 py-2 rounded bg-green-600 hover:bg-green-700 text-white">
                      Salvar
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>



          <!-- Upcoming Classes -->
          <div class="bg-gray-900 rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Próximas Aulas</h2>
            <div class="space-y-4">

              <?php
              foreach ($aula_agendada as $a) {
                echo '<div class="flex items-center p-3 bg-gray-800 rounded-lg border-l-4 border-green-500">';
                echo '<div class="mr-4 text-center">';
                echo '<span class="block text-lg font-bold text-green-400">' . $a['data_aula'] . '</span>';
                echo '<span class="text-xs text-gray-400">' . $a['dia_semana'] . '</span>';
                echo '</div>';
                echo '<div class="flex-1">';
                echo '<h3 class="font-medium text-white">' . $a['treino_tipo'] . '</h3>';
                echo '<p class="text-sm text-gray-400">' . $a['hora_inicio'] . ' - ' . $a['hora_fim'] . '</p>';
                echo '</div>';
                echo '<button class="text-green-400 hover:text-green-300">';
                echo '<i class="fas fa-chevron-right text-lg"></i>';
                echo '</button>';
                echo '</div>';
              }
              ?>
              <!-- Botão Agenda Completa -->
              <button class="w-full mt-2 bg-transparent border border-green-500 text-green-400 hover:bg-green-500 hover:text-black py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                <i class="fas fa-calendar-alt mr-2"></i>
                Ver Agenda Completa
              </button>
            </div>
          </div>


          <div class="grid gap-6">
            <?php foreach ($dicas as $dica): ?>
              <div class="bg-gray-900 rounded-xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-white mb-4">Dica Nutricional</h2>
                <div class="bg-gray-800 p-4 rounded-lg">
                  <div class="flex items-center mb-3">
                    <div class="bg-<?php echo $dica['cor']; ?> bg-opacity-20 p-2 rounded-full mr-3">
                      <i class="<?php echo $dica['icone']; ?> text-<?php echo $dica['cor']; ?> text-lg"></i>
                    </div>
                    <h3 class="font-medium text-white"><?php echo $dica['titulos']; ?></h3>
                  </div>
                  <p class="text-sm text-gray-300">
                    <?php echo $dica['descricao']; ?>
                  </p>
                  <button
                    class="mt-3 text-sm text-<?php echo $dica['cor']; ?> font-medium hover:underline flex items-center hover:text-<?php echo str_replace("400", "300", $dica['cor']); ?>">
                    Ler mais
                    <i class="fas fa-chevron-right text-xs ml-1"></i>
                  </button>
                </div>
              </div>
            <?php endforeach; ?>
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


  <!-- Modal (fora do conteúdo principal para controlar blur) -->
  <div
    id="modal"
    class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-[#1e2a3a] rounded-2xl p-8 max-w-sm w-full text-center relative">
      <button
        id="btnClose"
        class="absolute top-4 right-4 text-gray-400 hover:text-gray-200 text-2xl font-bold">
        &times;
      </button>
      <h2 class="text-2xl text-white font-bold mb-6">Vemos que você ainda não tem nenhum professor. Deseja agendar com algum para ver quais serão seus treinos?</h2>
      <div class="flex flex-col space-y-4">
        <a
          href="professores.php"
          class="bg-blue-600 hover:bg-blue-700 py-2 rounded-xl font-semibold transition text-white">Sim, Vamos agendar Aula</a>
        <a
          href="#"
          onclick="closeModal()"
          class="bg-gray-600 hover:bg-gray-700 py-2 rounded-xl font-semibold transition text-white">Não quero Agendar Aula ainda</a>
      </div>
    </div>
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
  <!-- <script>
    document.addEventListener("DOMContentLoaded", () => {
      const botaoPerfil = document.getElementById("botaoPerfil");
      const menuPerfil = document.getElementById("menuPerfil");

      botaoPerfil.addEventListener("click", () => {
        menuPerfil.classList.toggle("hidden");
      });

      // Fecha o menu se clicar fora dele
      document.addEventListener("click", (event) => {
        if (!menuPerfil.contains(event.target) && !botaoPerfil.contains(event.target)) {
          menuPerfil.classList.add("hidden");
        }
      });
    });
    const btnAbrirModal = document.getElementById('btnAbrirModal');
    const btnFecharModal = document.getElementById('btnFecharModal');
    const modalForm = document.getElementById('modalForm');
    const formMeta = document.getElementById('formMeta');

    btnAbrirModal.addEventListener('click', () => {
      modalForm.classList.remove('hidden');
    });

    btnFecharModal.addEventListener('click', () => {
      modalForm.classList.add('hidden');
      formMeta.reset();
    });

    formMeta.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(formMeta);

      try {
        const res = await fetch('http://localhost:83/public/api/index.php?entidade=meta&acao=cadastrar', {
          method: 'POST',
          body: formData,
        });

        const texto = await res.text(); // pega a resposta crua
        console.log('Resposta do servidor:', texto);

        if (!res.ok) {
          alert(`Erro HTTP: ${res.status}`);
          return;
        }

        let data;
        try {
          data = JSON.parse(texto); // parse manual
        } catch (err) {
          alert('Resposta inválida do servidor, não é JSON.');
          console.error('Erro ao fazer parse do JSON:', err);
          return;
        }

        // Aqui mostro a mensagem que vier do backend, mesmo no sucesso ou erro
        if (data.mensagem) {
          alert(data.mensagem);
        } else if (data.sucesso) {
          alert('Operação realizada com sucesso!');
        } else {
          alert('Resposta inesperada do servidor.');
        }

        if (data.sucesso) {
          modalForm.classList.add('hidden');
          formMeta.reset();

          // Aqui pode atualizar a lista no dashboard se quiser
        }
      } catch (err) {
        alert('Erro ao conectar com o servidor.');
        console.error(err);
      }
    });

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

    function mostrarBotoesAgua() {
      const botoes = document.getElementById('botoes-agua');
      botoes.classList.toggle('hidden');
    }

    function mostrarInput() {
      const botoes = document.getElementById('input-peso');
      botoes.classList.toggle('hidden');
    }

    const btnStart = document.getElementById('btnStart');
    const modal = document.getElementById('modal');
    const btnClose = document.getElementById('btnClose');
    const mainContent = document.getElementById('main-content');

    function openModal() {
      modal.classList.remove('opacity-0', 'pointer-events-none');
      modal.classList.add('opacity-100');
      mainContent.classList.add('blur-sm', 'pointer-events-none'); // Aplica blur e bloqueia interação no fundo
    }

    function closeModal() {
      modal.classList.add('opacity-0', 'pointer-events-none');
      modal.classList.remove('opacity-100');
      mainContent.classList.remove('blur-sm', 'pointer-events-none'); // Remove blur e desbloqueia interação
    }

    btnStart.addEventListener('click', openModal);
    btnClose.addEventListener('click', closeModal);

    // Fecha o modal ao clicar fora do conteúdo (no backdrop)
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        closeModal();
      }
    });
    document.addEventListener("DOMContentLoaded", () => {
      const formPeso = document.getElementById("form-peso");

      formPeso.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(formPeso);

        try {
          const res = await fetch(formPeso.action, {
            method: "POST",
            body: formData,
          });

          const texto = await res.text();
          console.log("Resposta do servidor:", texto);

          if (!res.ok) {
            alert(`Erro HTTP: ${res.status}`);
            return;
          }

          let data;
          try {
            data = JSON.parse(texto);
          } catch (err) {
            alert("Resposta inválida do servidor, não é JSON.");
            console.error("Erro ao fazer parse do JSON:", err);
            return;
          }

          // Mostra a mensagem do backend
          if (data.mensagem) alert(data.mensagem);

          // Se der sucesso, recarrega a página
          if (data.sucesso) {
            location.reload();
          }

        } catch (err) {
          alert("Erro ao conectar com o servidor.");
          console.error(err);
        }
      });
    });


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
    lucide.createIcons();
  </script>
  <script src="./js/dashboard_usuario.js"></script>
  <script>
    function concluirTreino(id) {
      const card = document.getElementById("card-" + id);
      card.classList.toggle("concluido");
    }
  </script> -->
  <script src="./js/dashboard_usuario.js"></script>
</body>

</html>