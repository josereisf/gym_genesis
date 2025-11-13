<?php
session_start();
require_once __DIR__ . "/../code/funcao.php";
require_once __DIR__ . '/./php/verificarLogado.php';

// Pega os parâmetros da URL
$idaula = $_GET['idaula'] ?? null;
$idaluno = $_GET['idaluno'] ?? null;

// Armazena na sessão
$_SESSION['idaula'] = $idaula;
$_SESSION['idaluno'] = $idaluno;

// Verifica ID
if (!$idaula) {
    die("<p style='color: white; font-family: sans-serif; background:#111; padding:20px;'>❌ ID da aula não fornecido.</p>");
}

// Busca dados no banco
$dados = listarAulaAgendada($idaula);

if (!$dados || count($dados) === 0) {
    die("<p style='color: white; font-family: sans-serif; background:#111; padding:20px;'>⚠️ Nenhuma informação encontrada para esta aula.</p>");
}

// Converte data
$datastamp = strtotime($dados[0]['data_aula']);
$data = date("d/m/Y", $datastamp);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($dados[0]['tipo_treino'] ?? 'Detalhes da Aula', ENT_QUOTES, 'UTF-8') ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: radial-gradient(circle at top left, #001510, #000);
      color: #fff;
      font-family: 'Inter', sans-serif;
    }
    .selected-card {
      border-color: #00ff88;
      background-color: rgba(0, 255, 136, 0.08);
    }
    .pulse-animation {
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.8; }
    }
  </style>
</head>

<body class="min-h-screen">
  <main class="py-10 px-6">

    <div class="max-w-5xl mx-auto">
      <div id="workout-card" class="bg-gray-900/70 backdrop-blur-xl rounded-2xl p-8 border border-green-400/20 shadow-xl transition-all hover:shadow-green-400/10">

        <!-- Cabeçalho -->
        <div class="flex justify-between items-start mb-6">
          <div>
            <h2 class="text-3xl font-bold text-green-400 mb-1">
              <?= htmlspecialchars($dados[0]['tipo_treino'] ?? 'Aula', ENT_QUOTES, 'UTF-8') ?>
            </h2>
            <p class="text-white/70"><?= htmlspecialchars($dados[0]['descricao_treino'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
          </div>
          <div class="text-right">
            <span class="text-sm text-white/70 block">ID da Aula</span>
            <span class="text-lg font-bold text-green-400">#<?= htmlspecialchars($idaula, ENT_QUOTES, 'UTF-8') ?></span>
          </div>
        </div>

        <!-- Grade principal -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
          <!-- Data -->
          <div class="bg-white/5 p-4 rounded-xl">
            <div class="text-sm text-white/70 mb-1">📅 Data</div>
            <div class="text-lg font-semibold text-white"><?= htmlspecialchars($data, ENT_QUOTES, 'UTF-8') ?></div>
            <div class="text-sm text-green-400"><?= htmlspecialchars($dados[0]['dia_semana'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
          </div>

          <!-- Horário -->
          <div class="bg-white/5 p-4 rounded-xl">
            <div class="text-sm text-white/70 mb-1">⏰ Horário</div>
            <div class="text-lg font-semibold text-white">
              <?= htmlspecialchars($dados[0]['hora_inicio'] ?? '-', ENT_QUOTES, 'UTF-8') ?> - 
              <?= htmlspecialchars($dados[0]['hora_fim'] ?? '-', ENT_QUOTES, 'UTF-8') ?>
            </div>
          </div>

          <!-- Professor -->
          <div class="bg-white/5 p-4 rounded-xl flex items-center gap-4">
            <img src="./uploads/<?= htmlspecialchars($dados[0]['foto_perfil'] ?? 'padrao.png', ENT_QUOTES, 'UTF-8') ?>" 
                alt="Foto do Professor" class="w-14 h-14 rounded-full object-cover border border-green-400/30">
            <div>
              <div class="text-lg font-semibold text-white"><?= htmlspecialchars($dados[0]['nome_usuario'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
              <div class="text-sm text-green-400"><?= htmlspecialchars($dados[0]['nome_cargo'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
            </div>
          </div>
        </div>

        <!-- Descrição do professor -->
        <div class="bg-white/5 p-5 rounded-xl mb-8">
          <h3 class="text-green-400 font-semibold mb-2">👨‍🏫 Sobre o Professor</h3>
          <p class="text-white/80 leading-relaxed"><?= htmlspecialchars($dados[0]['descricao_professor'] ?? 'Sem descrição.', ENT_QUOTES, 'UTF-8') ?></p>
          <div class="text-sm text-white/60 mt-2">
            Avaliação média: ⭐ <?= htmlspecialchars($dados[0]['avaliacao_media'] ?? '0', ENT_QUOTES, 'UTF-8') ?> / 5 • 
            Modalidade: <?= htmlspecialchars($dados[0]['modalidade'] ?? '-', ENT_QUOTES, 'UTF-8') ?>
          </div>
        </div>

        <!-- Lista de Exercícios -->
        <div class="bg-white/5 p-6 rounded-xl mb-8">
          <h3 class="text-2xl font-bold text-green-400 mb-4">🏋️ Exercícios do Treino</h3>
<?php
foreach ($dados as $ex) {
    echo '<div class="border-b border-white/10 py-3 flex flex-col sm:flex-row sm:items-center justify-between">';
    echo '  <div class="flex-1">';
    echo '    <div class="text-white font-semibold text-lg">' . htmlspecialchars($ex['nome_exercicio'], ENT_QUOTES, 'UTF-8') . '</div>';
    echo '    <div class="text-sm text-white/60">' . htmlspecialchars($ex['grupo_muscular'], ENT_QUOTES, 'UTF-8') . '</div>';
    echo '    <p class="text-white/70 text-sm">' . htmlspecialchars($ex['descricao_exercicio'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';
    echo '  </div>';

    echo '  <div class="text-sm text-white/80 text-right mt-2 sm:mt-0 w-52">';
    echo '    <div>🎯 Séries: ' . htmlspecialchars($ex['series'] ?? '-', ENT_QUOTES, 'UTF-8') . '</div>';
    echo '    <div>🔁 Repetições: ' . htmlspecialchars($ex['repeticoes'] ?? '-', ENT_QUOTES, 'UTF-8') . '</div>';
    echo '    <div>⚖️ Carga: ' . htmlspecialchars($ex['carga'] ?? '-', ENT_QUOTES, 'UTF-8') . ' kg</div>';
    echo '    <div>⏱️ Intervalo: ' . htmlspecialchars($ex['intervalo_segundos'] ?? '-', ENT_QUOTES, 'UTF-8') . ' seg</div>';
    echo '  </div>';
    echo '</div>';

    if (!empty($ex['video_url'])) {
        echo '<div class="mt-3 mb-6">';
        echo '  <video class="rounded-lg border border-white/10 w-full max-h-72" controls>';
        echo '    <source src="' . htmlspecialchars($ex['video_url'], ENT_QUOTES, 'UTF-8') . '" type="video/mp4">';
        echo '    Seu navegador não suporta vídeos.';
        echo '  </video>';
        echo '</div>';
    }
}
?>

        </div>

        <!-- Botões -->
        <div class="flex flex-col sm:flex-row gap-4">
          <button id="select-btn" class="flex-1 bg-green-500/10 border border-green-400/40 hover:bg-green-500/20 text-green-400 font-semibold py-3 px-6 rounded-xl transition-all duration-300">
            ✓ Selecionar Aula
          </button>
          <button id="back-btn" class="flex-1 bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 font-semibold py-3 px-6 rounded-xl transition-all duration-300">
            ⬅ Voltar
          </button>
        </div>

      </div>
    </div>
  </main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  const selectBtn = document.getElementById('select-btn');
  const backBtn = document.getElementById('back-btn');
  const card = document.getElementById('workout-card');
  let selected = false;

  selectBtn.addEventListener('click', () => {
    selected = !selected;
    if (selected) {
      aula_usuario();
      card.classList.add('selected-card', 'pulse-animation');
      selectBtn.innerText = '✓ Aula Selecionada';
    } else {
      card.classList.remove('selected-card', 'pulse-animation');
      selectBtn.innerText = '✓ Selecionar Aula';
    }
  });

  if (backBtn) {
    backBtn.addEventListener('click', () => window.history.back());
  }

  async function aula_usuario() {
    try {
      const response = await fetch(
        'http://localhost:83/public/api/index.php?entidade=aula_usuario&acao=cadastrar',
        {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({
            idaula: '<?= htmlspecialchars($idaula, ENT_QUOTES, 'UTF-8') ?>',
            idaluno: '<?= htmlspecialchars($idaluno, ENT_QUOTES, 'UTF-8') ?>'
          })
        }
      );

      if (!response.ok) throw new Error('Erro na requisição');
      const data = await response.json();

      console.log('Aula selecionada com sucesso:', data);
      window.location.href = 'dashboard_usuario.php';
    } catch (error) {
      console.error('Erro ao selecionar aula:', error);
    }
  }
</script>

</body>
</html>
