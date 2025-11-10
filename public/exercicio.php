<?php
require_once __DIR__ . "/../code/funcao.php";
$idaula = $_GET['id'];
$dados = listarAulaAgendada($idaula);
$datastamp = strtotime($dados[0]['data_aula']);
$data = gmdate("d-m-Y", $datastamp);
?>
<div class="max-w-4xl mx-auto">
    <div id="workout-card" class="workout-card bg-transparent rounded-2xl p-8 cursor-pointer border border-white/20">
        <!-- Card Header -->
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-3xl font-bold text-neongreen mb-2"><?= isset($dados[0]['tipo']) ? htmlspecialchars($dados[0]['tipo'], ENT_QUOTES, 'UTF-8') : 'Aula' ?></h2>
                <span class="inline-block px-4 py-2 bg-darkblue/50 rounded-full text-neongreen font-semibold text-sm"><?= isset($dados[0]['tipo']) ? htmlspecialchars($dados[0]['tipo'], ENT_QUOTES, 'UTF-8') : 'Modalidade' ?></span>
            </div>
            <div class="text-right">
                <div class="text-white/80 text-sm">ID da Aula</div>
                <div class="text-white font-bold text-lg">#<?= htmlspecialchars($idaula, ENT_QUOTES, 'UTF-8') ?></div>
            </div>
        </div>

        <!-- Main Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <!-- Data e Dia -->
            <div class="info-badge rounded-xl p-4">
                <div class="flex items-center mb-2">
                    <div class="w-3 h-3 bg-neonred rounded-full mr-3"></div>
                    <span class="text-white/80 text-sm font-medium">Data</span>
                </div>
                <div class="text-white font-bold text-lg"><?= isset($data) ? htmlspecialchars($data, ENT_QUOTES, 'UTF-8') : '-' ?></div>
                <div class="text-white/90 text-sm"><?= isset($dados[0]['dia_semana']) ? htmlspecialchars($dados[0]['dia_semana'], ENT_QUOTES, 'UTF-8') : '-' ?></div>
            </div>

            <!-- Horário -->
            <div class="info-badge rounded-xl p-4">
                <div class="flex items-center mb-2">
                    <div class="w-3 h-3 bg-neongreen rounded-full mr-3"></div>
                    <span class="text-white/80 text-sm font-medium">Horário</span>
                </div>
                <div class="text-white font-bold text-lg"><?= (isset($dados[0]['hora_inicio']) ? htmlspecialchars($dados[0]['hora_inicio'], ENT_QUOTES, 'UTF-8') : '-') . ' - ' . (isset($dados[0]['hora_fim']) ? htmlspecialchars($dados[0]['hora_fim'], ENT_QUOTES, 'UTF-8') : '-') ?></div>
                <div class="text-white/90 text-sm">60 minutos</div>
            </div>

            <!-- Professor -->
            <div class="info-badge rounded-xl p-4 md:col-span-2 lg:col-span-1">
                <div class="flex items-center mb-2">
                    <div class="w-3 h-3 bg-neonred rounded-full mr-3"></div>
                    <span class="text-white/80 text-sm font-medium">Professor</span>
                </div>
                <div class="text-white font-bold text-lg"><?= isset($dados[0]['nome_usuario']) ? htmlspecialchars($dados[0]['nome_usuario'], ENT_QUOTES, 'UTF-8') : '-' ?></div>
                <div class="text-white/90 text-sm"><?= isset($dados[0]['nome_cargo']) ? htmlspecialchars($dados[0]['nome_cargo'], ENT_QUOTES, 'UTF-8') : '' ?></div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4">
            <button id="select-btn" class="flex-1 bg-darkblue/50 hover:bg-darkblue/70 text-neongreen font-semibold py-3 px-6 rounded-xl transition-all duration-300 border border-neongreen/40">
                ✓ Selecionar Aula
            </button>
            <button id="details-btn" class="flex-1 bg-neonred/70 hover:bg-neonred text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                Ver Detalhes
            </button>
        </div>
    </div>

    <!-- Selection Status -->
    <div id="selection-status" class="mt-8 text-center hidden">
        <div class="inline-block bg-neongreen/20 border border-neongreen/30 rounded-xl px-6 py-4">
            <div class="text-neongreen font-semibold text-lg">✓ Aula Selecionada!</div>
            <div class="text-neongreen/80 text-sm mt-1"><?= (isset($dados[0]['tipo']) ? htmlspecialchars($dados[0]['tipo'], ENT_QUOTES, 'UTF-8') : '-') . ' - ' . (isset($dados[0]['dia_semana']) ? htmlspecialchars($dados[0]['dia_semana'], ENT_QUOTES, 'UTF-8') : '-') . ', ' . (isset($data) ? htmlspecialchars($data, ENT_QUOTES, 'UTF-8') : '-') . ' às ' . (isset($dados[0]['hora_inicio']) ? htmlspecialchars($dados[0]['hora_inicio'], ENT_QUOTES, 'UTF-8') : '-') ?></div>
        </div>
    </div>
    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-3xl font-bold text-neongreen mb-2 nome_treino"><?= $dados[0]['tipo'] ?></h2>
            <span class="inline-block px-4 py-2 bg-darkblue/50 rounded-full text-neongreen font-semibold text-sm">Cardio</span>
        </div>
        <div class="text-right">
            <div class="text-white/80 text-sm">ID da Aula</div>
            <div class="text-white font-bold text-lg">#<?= $idaula ?></div>
        </div>
    </div>
    <!-- Main Info Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <!-- Data e Dia -->
        <div class="info-badge rounded-xl p-4">
            <div class="flex items-center mb-2">
                <div class="w-3 h-3 bg-neonred rounded-full mr-3"></div>
                <span class="text-white/80 text-sm font-medium">Data</span>
            </div>
            <div class="text-white font-bold text-lg"><?= $data ?></div>
            <div class="text-white/90 text-sm"><?= $dados[0]['dia_semana'] ?></div>
        </div>
        <!-- Horário -->
        <div class="info-badge rounded-xl p-4">
            <div class="flex items-center mb-2">
                <div class="w-3 h-3 bg-neongreen rounded-full mr-3"></div>
                <span class="text-white/80 text-sm font-medium">Horário</span>
            </div>
            <div class="text-white font-bold text-lg"><?= $dados[0]['hora_inicio'] ?> - <?= $dados[0]['hora_fim'] ?></div>
            <div class="text-white/90 text-sm">60 minutos</div>
        </div>
        <!-- Professor -->
        <div class="info-badge rounded-xl p-4 md:col-span-2 lg:col-span-1">
            <div class="flex items-center mb-2">
                <div class="w-3 h-3 bg-neonred rounded-full mr-3"></div>
                <span class="text-white/80 text-sm font-medium">Professor</span>
            </div>
            <div class="text-white font-bold text-lg"><?= $dados[0]['nome_usuario'] ?></div>
            <div class="text-white/90 text-sm"><?= $dados[0]['nome_cargo'] ?></div>
            =======
            <div class="max-w-4xl mx-auto">
                <div id="workout-card" class="workout-card bg-transparent rounded-2xl p-8 cursor-pointer border border-white/20">
                    <!-- Card Header -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-3xl font-bold text-neongreen mb-2">Elíptico</h2>
                            <span class="inline-block px-4 py-2 bg-darkblue/50 rounded-full text-neongreen font-semibold text-sm">Cardio</span>
                        </div>
                        <div class="text-right">
                            <div class="text-white/80 text-sm">ID da Aula</div>
                            <div class="text-white font-bold text-lg">#27</div>
                        </div>
                    </div>
                    <!-- Main Info Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                        <!-- Data e Dia -->
                        <div class="info-badge rounded-xl p-4">
                            <div class="flex items-center mb-2">
                                <div class="w-3 h-3 bg-neonred rounded-full mr-3"></div>
                                <span class="text-white/80 text-sm font-medium">Data</span>
                            </div>
                            <div class="text-white font-bold text-lg">27 de Maio</div>
                            <div class="text-white/90 text-sm">Terça-feira</div>
                        </div>
                        <!-- Horário -->
                        <div class="info-badge rounded-xl p-4">
                            <div class="flex items-center mb-2">
                                <div class="w-3 h-3 bg-neongreen rounded-full mr-3"></div>
                                <span class="text-white/80 text-sm font-medium">Horário</span>
                            </div>
                            <div class="text-white font-bold text-lg">07:30 - 08:30</div>
                            <div class="text-white/90 text-sm">60 minutos</div>
                        </div>
                        <!-- Professor -->
                        <div class="info-badge rounded-xl p-4 md:col-span-2 lg:col-span-1">
                            <div class="flex items-center mb-2">
                                <div class="w-3 h-3 bg-neonred rounded-full mr-3"></div>
                                <span class="text-white/80 text-sm font-medium">Professor</span>
                            </div>
                            <div class="text-white font-bold text-lg">Carlos Mendes</div>
                            <div class="text-white/90 text-sm">Instrutor Certificado</div>
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button id="select-btn" class="flex-1 bg-darkblue/50 hover:bg-darkblue/70 text-neongreen font-semibold py-3 px-6 rounded-xl transition-all duration-300 border border-neongreen/40">
                            ✓ Selecionar Aula
                        </button>
                        <button id="details-btn" class="flex-1 bg-neonred/70 hover:bg-neonred text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                            Ver Detalhes
                        </button>
                    </div>
                    >>>>>>> Stashed changes
                </div>

                <<<<<<< Updated upstream
                    <!-- Selection Status -->
                    <div id="selection-status" class="mt-8 text-center hidden">
                        <div class="inline-block bg-neongreen/20 border border-neongreen/30 rounded-xl px-6 py-4">
                            <div class="text-neongreen font-semibold text-lg">✓ Aula Selecionada!</div>
                            <div class="text-neongreen/80 text-sm mt-1"><?= $dados[0]['tipo'] ?> - <?= $dados[0]['dia_semana'] ?>, <?= $data ?> às <?= $dados[0]['hora_inicio'] ?></div>
                        </div>
                    </div>
                    =======
                    <!-- Selection Status -->
                    <div id="selection-status" class="mt-8 text-center hidden">
                        <div class="inline-block bg-neongreen/20 border border-neongreen/30 rounded-xl px-6 py-4">
                            <div class="text-neongreen font-semibold text-lg">✓ Aula Selecionada!</div>
                            <div class="text-neongreen/80 text-sm mt-1">Elíptico - Terça, 27/05 às 07:30</div>
                        </div>
                    </div>
                    >>>>>>> Stashed changes

                    <!-- Details Panel -->
                    <div id="details-panel" class="mt-8 bg-darkgray/50 backdrop-blur-lg rounded-2xl p-8 border border-white/20 hidden">
                        <h3 class="text-2xl font-bold text-neongreen mb-6">Detalhes da Aula</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-neongreen font-semibold mb-3">Informações Gerais</h4>
                                <div class="space-y-2 text-white/80">
                                    <div><span class="text-neongreen">Modalidade:</span> Exercício Cardiovascular</div>
                                    <div><span class="text-neongreen">Equipamento:</span> Elíptico</div>
                                    <div><span class="text-neongreen">Nível:</span> Iniciante a Avançado</div>
                                    <div><span class="text-neongreen">Vagas:</span> 8 disponíveis</div>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-neongreen font-semibold mb-3">Benefícios</h4>
                                <div class="space-y-2 text-white/80">
                                    <div>• Melhora da capacidade cardiovascular</div>
                                    <div>• Queima de calorias eficiente</div>
                                    <div>• Baixo impacto nas articulações</div>
                                    <div>• Fortalecimento de pernas e core</div>
                                </div>
                            </div>
                        </div>
                        <button id="close-details" class="mt-6 bg-darkblue/50 hover:bg-darkblue/70 text-neongreen font-semibold py-2 px-6 rounded-lg transition-colors">Fechar Detalhes</button>
                    </div>
            </div>

            <!-- Questions Section -->
            <div class="max-w-4xl mx-auto mt-16">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20">
                    <h3 class="text-2xl font-bold text-white mb-6">Personalize Seu Painel de Treinos</h3>
                    <p class="text-gray-300 mb-8">Ajude-nos a criar o painel perfeito para suas necessidades de treino:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="bg-white/5 rounded-xl p-4">
                                <h4 class="text-white font-semibold mb-2">🏋️ Nome do Sistema</h4>
                                <p class="text-gray-300 text-sm">Como você gostaria de chamar seu plano de treino? (ex: "Meu Fitness", "Academia Pro")</p>
                            </div>
                            <div class="bg-white/5 rounded-xl p-4">
                                <h4 class="text-white font-semibold mb-2">🎯 Categorias de Treino</h4>
                                <p class="text-gray-300 text-sm">Quais tipos de aula você oferece? (Cardio, Força, HIIT, Yoga, Pilates, Funcional, etc.)</p>
                            </div>
                            <div class="bg-white/5 rounded-xl p-4">
                                <h4 class="text-white font-semibold mb-2">⚙️ Opções de Personalização</h4>
                                <p class="text-gray-300 text-sm">Que configurações o usuário pode ajustar? (intensidade, duração, equipamento, nível)</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-white/5 rounded-xl p-4">
                                <h4 class="text-white font-semibold mb-2">📋 Itens Básicos e Extras</h4>
                                <p class="text-gray-300 text-sm">O que está incluído por padrão? Quais são os complementos opcionais? (carga, séries extras, aquecimento)</p>
                            </div>
                            <div class="bg-white/5 rounded-xl p-4">
                                <h4 class="text-white font-semibold mb-2">❤️ Preferências Especiais</h4>
                                <p class="text-gray-300 text-sm">Que filtros são importantes? (intensidade, cardio vs força, dias da semana, professor favorito)</p>
                            </div>
                            <div class="bg-white/5 rounded-xl p-4">
                                <h4 class="text-white font-semibold mb-2">👥 Informações dos Professores</h4>
                                <p class="text-gray-300 text-sm">Que dados mostrar sobre os instrutores? (especialidades, experiência, avaliações)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </main>
            <script>
                // Configuration object
                const defaultConfig = {
                    panel_title: "Minhas Aulas de Treino",
                    welcome_message: "Selecione sua aula ideal"
                };

                let config = {
                    ...defaultConfig
                };
                let isSelected = false;

                // DOM elements
                const workoutCard = document.getElementById('workout-card');
                const selectBtn = document.getElementById('select-btn');
                const detailsBtn = document.getElementById('details-btn');
                const selectionStatus = document.getElementById('selection-status');
                const detailsPanel = document.getElementById('details-panel');
                const closeDetailsBtn = document.getElementById('close-details');

                // Event listeners
                selectBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleSelection();
                });

                detailsBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleDetails();
                });

                closeDetailsBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    hideDetails();
                });

                workoutCard.addEventListener('click', function(e) {
                    if (e.target === workoutCard || e.target.closest('.info-badge')) {
                        toggleSelection();
                    }
                });

                function toggleSelection() {
                    isSelected = !isSelected;

                    if (isSelected) {
                        workoutCard.classList.add('selected-card', 'pulse-animation');
                        selectBtn.innerHTML = '✓ Selecionada';
                        selectBtn.classList.add('bg-green-500/30', 'border-green-400');
                        selectionStatus.classList.remove('hidden');
                    } else {
                        workoutCard.classList.remove('selected-card', 'pulse-animation');
                        selectBtn.innerHTML = '✓ Selecionar Aula';
                        selectBtn.classList.remove('bg-green-500/30', 'border-green-400');
                        selectionStatus.classList.add('hidden');
                    }
                }

                function toggleDetails() {
                    if (detailsPanel.classList.contains('hidden')) {
                        showDetails();
                    } else {
                        hideDetails();
                    }
                }

                function showDetails() {
                    detailsPanel.classList.remove('hidden');
                    detailsBtn.innerHTML = 'Ocultar Detalhes';
                    detailsPanel.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }

                function hideDetails() {
                    detailsPanel.classList.add('hidden');
                    detailsBtn.innerHTML = 'Ver Detalhes';
                }

                // Element SDK implementation
                async function onConfigChange(newConfig) {
                    config = {
                        ...config,
                        ...newConfig
                    };

                    // Update panel title
                    const titleElement = document.getElementById('panel-title');
                    if (titleElement) {
                        titleElement.textContent = config.panel_title || defaultConfig.panel_title;
                    }

                    // Update welcome message
                    const welcomeElement = document.getElementById('welcome-message');
                    if (welcomeElement) {
                        welcomeElement.textContent = config.welcome_message || defaultConfig.welcome_message;
                    }
                }

                function mapToCapabilities(config) {
                    return {
                        recolorables: [],
                        borderables: [],
                        fontEditable: undefined,
                        fontSizeable: undefined
                    };
                }

                function mapToEditPanelValues(config) {
                    return new Map([
                        ["panel_title", config.panel_title || defaultConfig.panel_title],
                        ["welcome_message", config.welcome_message || defaultConfig.welcome_message]
                    ]);
                }

                // Initialize Element SDK
                if (window.elementSdk) {
                    window.elementSdk.init({
                        defaultConfig,
                        onConfigChange,
                        mapToCapabilities,
                        mapToEditPanelValues
                    });
                }
            </script>
            <script>

            </script>
            </body>

            </html>