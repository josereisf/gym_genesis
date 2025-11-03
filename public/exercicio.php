<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Aulas de Treino</title>

    <!-- SDKs -->
    <script src="/_sdk/element_sdk.js"></script>
    <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                dark: "#0a0a0a",
                darkblue: "#0d1b2a",
                neonred: "#ff2e63",
                neongreen: "#39ff14",
                darkgray: "#1a1a1a",
                cardbg: "#1f1f1f",
                infobadge: "rgba(255,255,255,0.2)",
              },
              fontFamily: {
                montserrat: ["Montserrat", "sans-serif"],
              },
            },
          },
        };
    </script>

    <!-- Custom CSS -->
    <style>
        body {
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
            background-color: #0d1b2a;
            color: white;
        }

        .workout-card {
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            background-color: #1f1f1f; /* cardbg */
            border-radius: 1rem;
            padding: 1rem;
        }

        .workout-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Gradientes baseados nas cores do site */
        .cardio-gradient {
            background: linear-gradient(135deg, #0d1b2a 0%, #39ff14 100%);
        }

        .strength-gradient {
            background: linear-gradient(135deg, #1a1a1a 0%, #ff2e63 100%);
        }

        .hiit-gradient {
            background: linear-gradient(135deg, #0a0a0a 0%, #ff2e63 100%);
        }

        .yoga-gradient {
            background: linear-gradient(135deg, #0d1b2a 0%, #39ff14 100%);
        }

        .info-badge {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.2); /* infobadge */
            padding: 0.25rem 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .selected-card {
            transform: translateY(-2px);
            border: 2px solid #39ff14; /* neongreen */
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>


<body class="min-h-full bg-gradient-to-br from-darkblue via-darkgray to-dark">
    <main class="container mx-auto px-6 py-8">
        <!-- Header -->
        <header class="text-center mb-12">
            <h1 id="panel-title" class="text-4xl font-bold text-white mb-4">Minhas Aulas de Treino</h1>
            <p id="welcome-message" class="text-xl text-gray-300">Selecione sua aula ideal</p>
        </header>
        <!-- Workout Card -->
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
    </div>

    <!-- Selection Status -->
    <div id="selection-status" class="mt-8 text-center hidden">
        <div class="inline-block bg-neongreen/20 border border-neongreen/30 rounded-xl px-6 py-4">
            <div class="text-neongreen font-semibold text-lg">✓ Aula Selecionada!</div>
            <div class="text-neongreen/80 text-sm mt-1">Elíptico - Terça, 27/05 às 07:30</div>
        </div>
    </div>

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

</body>

</html>