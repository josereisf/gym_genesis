<?php
require_once __DIR__ . "/../code/funcao.php";

$idaula = $_GET['id'] ?? null;
if (!$idaula) {
    die("ID da aula não fornecido");
}

$dados = listarAulaAgendada($idaula);
if (!$dados) {
    die("Aula não encontrada");
}

$datastamp = strtotime($dados[0]['data_aula']);
$data = date("d/m/Y", $datastamp);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Aula</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .selected-card {
            border-color: #00ff88;
            background-color: rgba(0, 255, 136, 0.1);
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
<body class="bg-gray-900">
    <main class="py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <div id="workout-card" class="workout-card bg-transparent rounded-2xl p-8 cursor-pointer border border-white/20">
                <!-- Card Header -->
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-3xl font-bold text-green-400 mb-2"><?= htmlspecialchars($dados[0]['tipo'] ?? 'Aula', ENT_QUOTES, 'UTF-8') ?></h2>
                        <span class="inline-block px-4 py-2 bg-blue-900/50 rounded-full text-green-400 font-semibold text-sm"><?= htmlspecialchars($dados[0]['tipo'] ?? 'Cardio', ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <div class="text-right">
                        <div class="text-white/80 text-sm">ID da Aula</div>
                        <div class="text-white font-bold text-lg">#<?= htmlspecialchars($idaula, ENT_QUOTES, 'UTF-8') ?></div>
                    </div>
                </div>

                <!-- Main Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Data e Dia -->
                    <div class="info-badge rounded-xl p-4 bg-white/5">
                        <div class="flex items-center mb-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                            <span class="text-white/80 text-sm font-medium">Data</span>
                        </div>
                        <div class="text-white font-bold text-lg"><?= htmlspecialchars($data, ENT_QUOTES, 'UTF-8') ?></div>
                        <div class="text-white/90 text-sm"><?= htmlspecialchars($dados[0]['dia_semana'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                    </div>

                    <!-- Horário -->
                    <div class="info-badge rounded-xl p-4 bg-white/5">
                        <div class="flex items-center mb-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full mr-3"></div>
                            <span class="text-white/80 text-sm font-medium">Horário</span>
                        </div>
                        <div class="text-white font-bold text-lg">
                            <?= htmlspecialchars($dados[0]['hora_inicio'] ?? '-', ENT_QUOTES, 'UTF-8') ?> - 
                            <?= htmlspecialchars($dados[0]['hora_fim'] ?? '-', ENT_QUOTES, 'UTF-8') ?>
                        </div>
                        <div class="text-white/90 text-sm">60 minutos</div>
                    </div>

                    <!-- Professor -->
                    <div class="info-badge rounded-xl p-4 bg-white/5 md:col-span-2 lg:col-span-1">
                        <div class="flex items-center mb-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                            <span class="text-white/80 text-sm font-medium">Professor</span>
                        </div>
                        <div class="text-white font-bold text-lg"><?= htmlspecialchars($dados[0]['nome_usuario'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                        <div class="text-white/90 text-sm"><?= htmlspecialchars($dados[0]['nome_cargo'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button id="select-btn" class="flex-1 bg-blue-900/50 hover:bg-blue-900/70 text-green-400 font-semibold py-3 px-6 rounded-xl transition-all duration-300 border border-green-400/40">
                        ✓ Selecionar Aula
                    </button>
                    <button id="details-btn" class="flex-1 bg-red-600/70 hover:bg-red-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                        Ver Detalhes
                    </button>
                </div>

                <!-- Selection Status -->
                <div id="selection-status" class="mt-8 text-center hidden">
                    <div class="inline-block bg-green-400/20 border border-green-400/30 rounded-xl px-6 py-4">
                        <div class="text-green-400 font-semibold text-lg">✓ Aula Selecionada!</div>
                        <div class="text-green-400/80 text-sm mt-1">
                            <?= htmlspecialchars($dados[0]['tipo'] ?? '-', ENT_QUOTES, 'UTF-8') ?> - 
                            <?= htmlspecialchars($dados[0]['dia_semana'] ?? '-', ENT_QUOTES, 'UTF-8') ?>, 
                            <?= htmlspecialchars($data, ENT_QUOTES, 'UTF-8') ?> às 
                            <?= htmlspecialchars($dados[0]['hora_inicio'] ?? '-', ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    </div>
                </div>

                <!-- Details Panel -->
                <div id="details-panel" class="mt-8 bg-gray-800/50 backdrop-blur-lg rounded-2xl p-8 border border-white/20 hidden">
                    <h3 class="text-2xl font-bold text-green-400 mb-6">Detalhes da Aula</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-green-400 font-semibold mb-3">Informações Gerais</h4>
                            <div class="space-y-2 text-white/80">
                                <div><span class="text-green-400">Modalidade:</span> <?= htmlspecialchars($dados[0]['tipo'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                <div><span class="text-green-400">Instrutor:</span> <?= htmlspecialchars($dados[0]['nome_usuario'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                <div><span class="text-green-400">Data:</span> <?= htmlspecialchars($data, ENT_QUOTES, 'UTF-8') ?></div>
                                <div><span class="text-green-400">Horário:</span> <?= htmlspecialchars($dados[0]['hora_inicio'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-green-400 font-semibold mb-3">Ações</h4>
                            <button id="close-details" class="bg-blue-900/50 hover:bg-blue-900/70 text-green-400 font-semibold py-2 px-6 rounded-lg transition-colors">Fechar Detalhes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const selectBtn = document.getElementById('select-btn');
        const detailsBtn = document.getElementById('details-btn');
        const closeDetailsBtn = document.getElementById('close-details');
        const selectionStatus = document.getElementById('selection-status');
        const detailsPanel = document.getElementById('details-panel');
        const workoutCard = document.getElementById('workout-card');
        let isSelected = false;

        selectBtn.addEventListener('click', toggleSelection);
        detailsBtn.addEventListener('click', toggleDetails);
        closeDetailsBtn.addEventListener('click', hideDetails);

        function toggleSelection() {
            isSelected = !isSelected;
            if (isSelected) {
                workoutCard.classList.add('selected-card', 'pulse-animation');
                selectBtn.innerHTML = '✓ Selecionada';
                selectionStatus.classList.remove('hidden');
            } else {
                workoutCard.classList.remove('selected-card', 'pulse-animation');
                selectBtn.innerHTML = '✓ Selecionar Aula';
                selectionStatus.classList.add('hidden');
            }
        }

        function toggleDetails() {
            detailsPanel.classList.contains('hidden') ? showDetails() : hideDetails();
        }

        function showDetails() {
            detailsPanel.classList.remove('hidden');
            detailsBtn.innerHTML = 'Ocultar Detalhes';
        }

        function hideDetails() {
            detailsPanel.classList.add('hidden');
            detailsBtn.innerHTML = 'Ver Detalhes';
        }
    </script>
</body>
</html>