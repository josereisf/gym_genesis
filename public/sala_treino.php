<?
require_once __DIR__ . "/../code/funcao.php";
$a = [];

$a['aula_agendada'] = listarAulaAgendada(null);
$a['aula_agendada_usuario'] = listarAulaAgendadaUsuario(1);
$a['exercicio'] = listarExercicio(null);
$a['treino'] = listarTreino(null);
$a['treino_exercicio'] = listarTreinoExercicio(null);
$a['historico_treino'] = listarHistoricoTreino(null);

// Organizar dados relacionados
$dados = [
  'aulas' => [
    'agendadas' => $a['aula_agendada'],
    'do_usuario' => $a['aula_agendada_usuario']
  ],
  'exercicios' => $a['exercicio'],
  'treinos' => [
    'treinos' => $a['treino'],
    'exercicios' => $a['treino_exercicio'],
    'historico' => $a['historico_treino']
  ]
];

// Descomente para debug:
 echo '<pre>'; print_r($dados); echo '</pre>';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tela de Treino</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-slate-900 to-slate-800 text-white min-h-screen flex flex-col">

  <!-- HEADER -->
  <header class="flex items-center justify-between px-8 py-4 border-b border-white/10 bg-slate-950/60 backdrop-blur-md">
    <div class="flex items-center gap-3">
      <img src="https://cdn-icons-png.flaticon.com/512/2964/2964514.png" class="w-10" alt="Logo" />
      <h1 class="text-2xl font-bold">Genesis Fit</h1>
    </div>
  </header>

  <!-- CONTEÚDO -->
  <div class="flex flex-1 overflow-hidden">

    <!-- SIDEBAR -->
    <aside id="sidebar" class="w-80 border-r border-white/10 bg-slate-900/70 backdrop-blur-md overflow-y-auto transition-all duration-300">
      <h2 class="px-6 py-4 text-lg font-semibold border-b border-white/10">Seus Treinos</h2>

      <div id="exerciseList" class="space-y-3 p-4">
        <!-- Cards serão inseridos via JS -->
      </div>
    </aside>

    <!-- ÁREA CENTRAL -->
    <main id="contentArea" class="flex-1 p-8 overflow-y-auto flex flex-col items-center justify-center">
      <div id="placeholder" class="text-center text-gray-300">
        <h2 class="text-3xl font-bold mb-2">👋 Bem-vindo(a) ao seu treino!</h2>
        <p class="text-lg text-gray-400">Escolha um exercício no menu ao lado e vamos começar sua jornada fitness 💪</p>
      </div>

    </main>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    const exercises = [{
      "idexercicio": 1,
      "nome": "Rosca Direta",
      "grupo_muscular": "Braços",
      "descricao": "Exercício para bíceps",
      "video_url": null
    }, {
      "idexercicio": 2,
      "nome": "Tríceps Testa",
      "grupo_muscular": "Braços",
      "descricao": "Exercício para tríceps",
      "video_url": null
    }, {
      "idexercicio": 3,
      "nome": "Leg Press",
      "grupo_muscular": "Pernas",
      "descricao": "Exercício para quadríceps",
      "video_url": null
    }, {
      "idexercicio": 4,
      "nome": "Flexão",
      "grupo_muscular": "Peitoral",
      "descricao": "Exercício de flexão de braços",
      "video_url": null
    }, {
      "idexercicio": 5,
      "nome": "Abdominal",
      "grupo_muscular": "Core",
      "descricao": "Exercício para abdômen",
      "video_url": null
    }, {
      "idexercicio": 6,
      "nome": "Remada Curvada",
      "grupo_muscular": "Costas",
      "descricao": "Exercício para dorsais",
      "video_url": null
    }, {
      "idexercicio": 7,
      "nome": "Desenvolvimento",
      "grupo_muscular": "Ombros",
      "descricao": "Exercício para deltoides",
      "video_url": null
    }, {
      "idexercicio": 8,
      "nome": "Panturrilha",
      "grupo_muscular": "Pernas",
      "descricao": "Exercício para panturrilhas",
      "video_url": null
    }, {
      "idexercicio": 9,
      "nome": "Elevação Lateral",
      "grupo_muscular": "Ombros",
      "descricao": "Exercício para ombros",
      "video_url": null
    }, {
      "idexercicio": 10,
      "nome": "Prancha",
      "grupo_muscular": "Core",
      "descricao": "Exercício de estabilidade",
      "video_url": null
    }, {
      "idexercicio": 11,
      "nome": "Stiff",
      "grupo_muscular": "Pernas",
      "descricao": "Exercício para posteriores",
      "video_url": null
    }, {
      "idexercicio": 12,
      "nome": "Pull Over",
      "grupo_muscular": "Costas",
      "descricao": "Exercício para dorsais",
      "video_url": null
    }, {
      "idexercicio": 13,
      "nome": "Crucifixo",
      "grupo_muscular": "Peitoral",
      "descricao": "Exercício para peitoral",
      "video_url": null
    }, {
      "idexercicio": 14,
      "nome": "Afundo",
      "grupo_muscular": "Pernas",
      "descricao": "Exercício para glúteos",
      "video_url": null
    }, {
      "idexercicio": 15,
      "nome": "Voador",
      "grupo_muscular": "Peitoral",
      "descricao": "Exercício para peitoral",
      "video_url": null
    }, {
      "idexercicio": 16,
      "nome": "Extensão de Pernas",
      "grupo_muscular": "Pernas",
      "descricao": "Exercício para quadríceps",
      "video_url": null
    }, {
      "idexercicio": 17,
      "nome": "Rosca Martelo",
      "grupo_muscular": "Braços",
      "descricao": "Exercício para antebraço",
      "video_url": null
    }, {
      "idexercicio": 18,
      "nome": "Supino",
      "grupo_muscular": "Peitoral",
      "descricao": "Exercício de supino reto",
      "video_url": null
    }, {
      "idexercicio": 19,
      "nome": "Agachamento",
      "grupo_muscular": "Pernas",
      "descricao": "Agachamento livre",
      "video_url": null
    }, {
      "idexercicio": 20,
      "nome": "Puxada na barra",
      "grupo_muscular": "Costas",
      "descricao": "Puxada frontal",
      "video_url": null
    }];

    $(document).ready(function() {
      const $listContainer = $('#exerciseList');
      const $contentArea = $('#contentArea');

      // Cria os cards do sidebar
      $.each(exercises, function(_, ex) {
        const $card = $(`
        <div class="bg-slate-800/70 p-3 rounded-xl hover:bg-slate-700 cursor-pointer transition">
          <video src="${ex.video}" class="rounded-lg mb-2 w-full h-32 object-cover"></video>
          <h3 class="font-semibold text-lg">${ex.nome}</h3>
          <p class="text-sm text-gray-400 mb-1">⏱ ${ex.tempo}</p>
          <p class="text-sm text-gray-300 line-clamp-2">${ex.descricao}</p>
          <button class="text-xs text-blue-400 hover:underline mt-1">Ler mais</button>
        </div>
      `);

        // Evento de clique no card
        $card.on('click', function() {
          showExercise(ex);
        });

        $listContainer.append($card);
      });

      // Função que exibe o conteúdo do exercício selecionado
      function showExercise(ex) {
        $contentArea.html(`
        <div class="max-w-3xl w-full bg-slate-800/70 rounded-2xl p-6 shadow-xl border border-white/10">
          <video id="exerciseVideo" src="${ex.video}" controls class="w-full rounded-xl mb-4"></video>
          <h2 class="text-3xl font-bold mb-2">${ex.nome}</h2>
          <p class="text-gray-400 mb-3">Duração: ${ex.tempo}</p>
          <p class="text-gray-200 mb-6">${ex.descricao}</p>
          <button id="startBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-xl shadow-lg transition">
            ▶️ Começar Exercício
          </button>
        </div>
      `);

        // Evento do botão "Começar"
        $('#startBtn').on('click', function() {
          $('#exerciseVideo')[0].play(null);
        });
      }
    });
  </script>


</body>

</html>