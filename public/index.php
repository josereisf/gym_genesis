<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gym Genesis | Transforme-se</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&amp;display=swap"
      rel="stylesheet"
    />
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
            },
            fontFamily: {
              montserrat: ["Montserrat", "sans-serif"],
            },
          },
        },
      };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/inicial.css" />
  </head>
  <body>
    <!-- Navbar -->
    <nav
      class="fixed w-full z-50 bg-dark/80 backdrop-blur-md border-b border-white/10"
    >
      <div
        class="container mx-auto px-4 py-4 flex justify-between items-center"
      >
        <div class="logo text-2xl md:text-3xl">GYM GENESIS</div>

        <div class="hidden md:flex space-x-8">
          <a
            href="#sobre"
            class="text-white/80 hover:text-neongreen transition-colors"
            >Sobre</a
          >
          <a
            href="#servicos"
            class="text-white/80 hover:text-neongreen transition-colors"
            >Serviços</a
          >
          <a
            href="#planos"
            class="text-white/80 hover:text-neongreen transition-colors"
            >Planos</a
          >
          <a
            href="#equipe"
            class="text-white/80 hover:text-neongreen transition-colors"
            >Equipe</a
          >
          <a
            href="#contato"
            class="text-white/80 hover:text-neongreen transition-colors"
            >Contato</a
          >
        </div>

        <button class="md:hidden text-white" id="menu-toggle">
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
              d="M4 6h16M4 12h16M4 18h16"
            ></path>
          </svg>
        </button>
      </div>
    </nav>

    <!-- Mobile Menu -->
    <div
      class="mobile-menu fixed top-0 left-0 h-full w-64 bg-darkblue z-50 p-6 shadow-lg"
      id="mobile-menu"
    >
      <div class="flex justify-between items-center mb-8">
        <div class="logo text-xl">GYM GENESIS</div>
        <button id="close-menu">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 text-white"
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
      <div class="flex flex-col space-y-4">
        <a
          href="#sobre"
          class="text-white/80 hover:text-neongreen transition-colors py-2"
          >Sobre</a
        >
        <a
          href="#servicos"
          class="text-white/80 hover:text-neongreen transition-colors py-2"
          >Serviços</a
        >
        <a
          href="#planos"
          class="text-white/80 hover:text-neongreen transition-colors py-2"
          >Planos</a
        >
        <a
          href="#equipe"
          class="text-white/80 hover:text-neongreen transition-colors py-2"
          >Equipe</a
        >
        <a
          href="#contato"
          class="text-white/80 hover:text-neongreen transition-colors py-2"
          >Contato</a
        >
      </div>
    </div>

<!-- Hero Section -->
<section class="hero-section flex items-center justify-center relative min-h-screen">

  <!-- Conteúdo principal (recebe blur ao abrir modal) -->
  <div id="main-content" class="w-full">
    <!-- partículas -->
    <div class="particles-container" id="particles">
      <!-- suas partículas aqui (mantive como estava) -->
      <div
        class="particle"
        style="
          width: 5.64668px;
          height: 5.64668px;
          left: 44.2907%;
          top: 92.1735%;
          animation: 11.9811s linear 1.32037s infinite normal none running float;
        "
      ></div>
      <!-- (adicione todas as outras partículas aqui do seu código) -->
    </div>

    <!-- conteúdo textual e botão -->
    <div class="container mx-auto px-4 z-10 text-center relative">
      <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6">
        <span class="typewriter inline-block" id="typewriter">Transforme seu corpo.</span>
      </h1>
      <p class="text-xl md:text-2xl text-white/70 mb-10 max-w-3xl mx-auto">
        Desperte seu potencial máximo e redefina seus limites
      </p>
      <button
        class="neon-button bg-neongreen text-dark font-bold py-3 px-8 rounded-full text-lg hover:bg-neongreen/90 transition-all"
        id="btnStart"
      >
        COMECE AGORA
      </button>
    </div>
  </div>

</section>

<!-- Modal (fora do conteúdo principal para controlar blur) -->
<div
  id="modal"
  class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300"
>
  <div class="bg-[#1e2a3a] rounded-2xl p-8 max-w-sm w-full text-center relative">
    <button
      id="btnClose"
      class="absolute top-4 right-4 text-gray-400 hover:text-gray-200 text-2xl font-bold"
    >
      &times;
    </button>
    <h2 class="text-2xl font-bold mb-6">Você já possui cadastro?</h2>
    <div class="flex flex-col space-y-4">
      <a
        href="login.html"
        class="bg-blue-600 hover:bg-blue-700 py-2 rounded-xl font-semibold transition"
        >Sim, já tenho</a
      >
      <a
        href="2-etapa.php"
        class="bg-gray-600 hover:bg-gray-700 py-2 rounded-xl font-semibold transition"
        >Não, quero me cadastrar</a
      >
    </div>
  </div>
</div>

<!-- Script para controlar modal e blur -->
<script>
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
</script>


    <!-- Sobre Nós -->
    <section id="sobre" class="py-20 bg-darkgray">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-10">
          <!-- Texto da Esquerda -->
          <div class="md:w-1/2 reveal active">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 relative text-white">
              A Essência da <span class="text-neongreen">Gym Genesis</span>
              <span class="block w-20 h-1 bg-neongreen mt-4"></span>
            </h2>
            <p class="text-lg text-white/80 mb-6">
              Na Gym Genesis, acreditamos que cada treino é o início de uma nova
              versão de você mesmo. Com estrutura de ponta, profissionais
              qualificados e uma comunidade motivadora, somos mais que uma
              academia — somos o seu ponto de virada.
            </p>
            <p class="text-lg text-white/80">
              Nossa missão é transformar vidas através do movimento, da disciplina e
              da superação diária. Aqui, seus objetivos se tornam nossa prioridade.
            </p>
          </div>

    <!-- Carrossel 3D da Direita com novo layout -->
    <div class="md:w-1/2 reveal active">
      <!-- Carrossel de Ambientes -->
      <div id="carouselContainer" class="relative w-full h-80 flex items-center justify-center overflow-hidden group">
        <div id="carousel" class="flex items-center justify-center gap-4 w-full h-full relative"></div>

        <!-- Botões -->
        <button
          id="prevBtn"
          class="absolute left-2 top-1/2 -translate-y-1/2 text-white bg-black/50 hover:bg-black px-3 py-1 rounded"
        >
        ‹
        </button>
        <button
          id="nextBtn"
          class="absolute right-2 top-1/2 -translate-y-1/2 text-white bg-black/50 hover:bg-black px-3 py-1 rounded"
        >
          ›
        </button>
      </div>
    </div>

        </div>
      </div>
    </section>

    <!-- Serviços -->
    <section id="servicos" class="py-20 bg-dark">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16 reveal active">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Nossos <span class="text-neonred">Serviços</span>
          </h2>
          <p class="text-lg text-white/70 max-w-2xl mx-auto">
            Oferecemos uma variedade de programas de treinamento para atender a
            todos os níveis de condicionamento físico e objetivos
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Serviço 1 -->
          <div class="service-card rounded-xl p-6 reveal active">
            <div
              class="w-16 h-16 bg-neonred/20 rounded-full flex items-center justify-center mb-6 mx-auto"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 text-neonred"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                ></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-center">Musculação</h3>
            <p class="text-white/70 text-center">
              Equipamentos de última geração e orientação especializada para
              ganho de massa muscular e definição.
            </p>
          </div>

          <!-- Serviço 2 -->
          <div class="service-card rounded-xl p-6 reveal active">
            <div
              class="w-16 h-16 bg-neongreen/20 rounded-full flex items-center justify-center mb-6 mx-auto"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 text-neongreen"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M13 10V3L4 14h7v7l9-11h-7z"
                ></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-center">
              Treinamento Funcional
            </h3>
            <p class="text-white/70 text-center">
              Melhore sua força, equilíbrio e mobilidade com exercícios que
              simulam movimentos do dia a dia.
            </p>
          </div>

          <!-- Serviço 3 -->
          <div class="service-card rounded-xl p-6 reveal active">
            <div
              class="w-16 h-16 bg-neonred/20 rounded-full flex items-center justify-center mb-6 mx-auto"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 text-neonred"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                ></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-center">Aulas Coletivas</h3>
            <p class="text-white/70 text-center">
              Diversas modalidades como HIIT, Spinning, Dança e Pilates para
              treinar em grupo e manter a motivação.
            </p>
          </div>

          <!-- Serviço 4 -->
          <div class="service-card rounded-xl p-6 reveal active">
            <div
              class="w-16 h-16 bg-neongreen/20 rounded-full flex items-center justify-center mb-6 mx-auto"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 text-neongreen"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                ></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-center">Avaliação Física</h3>
            <p class="text-white/70 text-center">
              Análise completa do seu corpo e condicionamento para criar um
              plano personalizado e acompanhar resultados.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Planos -->
    <section id="planos" class="py-20 bg-darkgray">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16 reveal active">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Planos e <span class="text-neongreen">Assinaturas</span>
          </h2>
          <p class="text-lg text-white/70 max-w-2xl mx-auto">
            Escolha o plano ideal para seus objetivos e comece sua transformação
            hoje mesmo
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Plano Básico -->
          <div class="plan-card rounded-xl p-8 bg-darkblue reveal active">
            <h3 class="text-2xl font-bold mb-2">Plano Básico</h3>
            <div class="text-neonred text-4xl font-bold mb-6">
              R$ 89<span class="text-sm text-white/60">/mês</span>
            </div>
            <ul class="mb-8 space-y-3">
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neonred mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Acesso à musculação
              </li>
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neonred mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Horário comercial
              </li>
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neonred mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Avaliação física mensal
              </li>
              <li class="flex items-center text-white/40">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-white/40 mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Aulas coletivas
              </li>
              <li class="flex items-center text-white/40">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-white/40 mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Personal trainer
              </li>
            </ul>
            <button
              class="w-full py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-lg transition-all"
              onclick="window.location.href='2-etapa.php'"
            >
              Assinar Agora
            </button>
          </div>

          <!-- Plano Intermediário -->
          <div class="plan-card rounded-xl p-8 bg-darkblue reveal active">
            <h3 class="text-2xl font-bold mb-2">Plano Intermediário</h3>
            <div class="text-neonred text-4xl font-bold mb-6">
              R$ 129<span class="text-sm text-white/60">/mês</span>
            </div>
            <ul class="mb-8 space-y-3">
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neonred mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Acesso à musculação
              </li>
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neonred mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Acesso 24 horas
              </li>
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neonred mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Avaliação física mensal
              </li>
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neonred mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Aulas coletivas
              </li>
              <li class="flex items-center text-white/40">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-white/40 mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Personal trainer
              </li>
            </ul>
            <button
              class="w-full py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-lg transition-all"
              onclick="window.location.href='2-etapa.php'"
            >
              Assinar Agora
            </button>
          </div>

          <!-- Plano Premium -->
          <div
            class="plan-card premium-plan rounded-xl p-8 bg-darkblue reveal active"
          >
            <div
              class="absolute -top-4 right-8 bg-neongreen text-dark px-4 py-1 rounded-full text-sm font-bold"
            >
              MAIS POPULAR
            </div>
            <h3 class="text-2xl font-bold mb-2">Plano Premium</h3>
            <div class="text-neongreen text-4xl font-bold mb-6">
              R$ 199<span class="text-sm text-white/60">/mês</span>
            </div>
            <ul class="mb-8 space-y-3">
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neongreen mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Acesso à musculação
              </li>
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neongreen mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Acesso 24 horas
              </li>
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neongreen mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Avaliação física semanal
              </li>
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neongreen mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                Todas as aulas coletivas
              </li>
              <li class="flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-neongreen mr-2"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                4 sessões de personal/mês
              </li>
            </ul>
            <button
              class="w-full py-3 bg-neongreen hover:bg-neongreen/90 text-dark font-bold rounded-lg transition-all"
              onclick="window.location.href='2-etapa.php'"
            >
              Assinar Agora
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Equipe -->
    <section id="equipe" class="py-20 bg-dark">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16 reveal active">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Nossa <span class="text-neonred">Equipe</span>
          </h2>
          <p class="text-lg text-white/70 max-w-2xl mx-auto">
            Profissionais qualificados e apaixonados por transformar vidas
            através do exercício físico
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Treinador 1 -->
          <div class="trainer-card text-center reveal active">
            <div
              class="w-40 h-40 rounded-full overflow-hidden mx-auto mb-4 border-4 border-neonred"
            >
              <svg
                class="w-full h-full"
                viewBox="0 0 200 200"
                xmlns="http://www.w3.org/2000/svg"
              >
                <rect width="200" height="200" fill="#333"></rect>
                <circle cx="100" cy="70" r="40" fill="#555"></circle>
                <rect x="60" y="110" width="80" height="90" fill="#555"></rect>
              </svg>
            </div>
            <h3 class="text-xl font-bold">Carlos Silva</h3>
            <p class="text-neonred">Personal Trainer</p>
            <p class="text-white/70 mt-2">
              Especialista em hipertrofia e emagrecimento, com 10 anos de
              experiência.
            </p>
          </div>

          <!-- Treinador 2 -->
          <div class="trainer-card text-center reveal active">
            <div
              class="w-40 h-40 rounded-full overflow-hidden mx-auto mb-4 border-4 border-neongreen"
            >
              <svg
                class="w-full h-full"
                viewBox="0 0 200 200"
                xmlns="http://www.w3.org/2000/svg"
              >
                <rect width="200" height="200" fill="#333"></rect>
                <circle cx="100" cy="70" r="40" fill="#555"></circle>
                <rect x="60" y="110" width="80" height="90" fill="#555"></rect>
              </svg>
            </div>
            <h3 class="text-xl font-bold">Ana Oliveira</h3>
            <p class="text-neongreen">Funcional e HIIT</p>
            <p class="text-white/70 mt-2">
              Especializada em treinamento funcional de alta intensidade e
              condicionamento físico.
            </p>
          </div>

          <!-- Treinador 3 -->
          <div class="trainer-card text-center reveal active">
            <div
              class="w-40 h-40 rounded-full overflow-hidden mx-auto mb-4 border-4 border-neonred"
            >
              <svg
                class="w-full h-full"
                viewBox="0 0 200 200"
                xmlns="http://www.w3.org/2000/svg"
              >
                <rect width="200" height="200" fill="#333"></rect>
                <circle cx="100" cy="70" r="40" fill="#555"></circle>
                <rect x="60" y="110" width="80" height="90" fill="#555"></rect>
              </svg>
            </div>
            <h3 class="text-xl font-bold">Marcos Santos</h3>
            <p class="text-neonred">Nutricionista Esportivo</p>
            <p class="text-white/70 mt-2">
              Especialista em nutrição esportiva para maximizar resultados e
              performance.
            </p>
          </div>

          <!-- Treinador 4 -->
          <div class="trainer-card text-center reveal active">
            <div
              class="w-40 h-40 rounded-full overflow-hidden mx-auto mb-4 border-4 border-neongreen"
            >
              <svg
                class="w-full h-full"
                viewBox="0 0 200 200"
                xmlns="http://www.w3.org/2000/svg"
              >
                <rect width="200" height="200" fill="#333"></rect>
                <circle cx="100" cy="70" r="40" fill="#555"></circle>
                <rect x="60" y="110" width="80" height="90" fill="#555"></rect>
              </svg>
            </div>
            <h3 class="text-xl font-bold">Juliana Costa</h3>
            <p class="text-neongreen">Pilates e Yoga</p>
            <p class="text-white/70 mt-2">
              Especialista em técnicas de alongamento, mobilidade e consciência
              corporal.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Depoimentos -->
    <section class="py-20 bg-darkgray">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16 reveal active">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Depoimentos de <span class="text-neongreen">Alunos</span>
          </h2>
          <p class="text-lg text-white/70 max-w-2xl mx-auto">
            Veja o que nossos alunos têm a dizer sobre sua experiência na Gym
            Genesis
          </p>
        </div>

        <div class="testimonial-slider reveal active">
          <div class="testimonial-track">
            <!-- Depoimento 1 -->
            <div
              class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl"
            >
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                  <svg
                    class="w-full h-full"
                    viewBox="0 0 50 50"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <rect width="50" height="50" fill="#555"></rect>
                    <circle cx="25" cy="20" r="10" fill="#777"></circle>
                    <rect
                      x="15"
                      y="30"
                      width="20"
                      height="20"
                      fill="#777"
                    ></rect>
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold">Roberto Almeida</h4>
                  <p class="text-neonred text-sm">Aluno há 8 meses</p>
                </div>
              </div>
              <p class="text-white/80 italic">
                "Perdi 15kg em 6 meses com o acompanhamento da equipe da Gym
                Genesis. A combinação de treino e nutrição fez toda a
                diferença!"
              </p>
            </div>

            <!-- Depoimento 2 -->
            <div
              class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl"
            >
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                  <svg
                    class="w-full h-full"
                    viewBox="0 0 50 50"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <rect width="50" height="50" fill="#555"></rect>
                    <circle cx="25" cy="20" r="10" fill="#777"></circle>
                    <rect
                      x="15"
                      y="30"
                      width="20"
                      height="20"
                      fill="#777"
                    ></rect>
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold">Camila Ferreira</h4>
                  <p class="text-neongreen text-sm">Aluna há 1 ano</p>
                </div>
              </div>
              <p class="text-white/80 italic">
                "As aulas de funcional da Ana são incríveis! Nunca me senti tão
                disposta e forte. A energia da academia é contagiante!"
              </p>
            </div>

            <!-- Depoimento 3 -->
            <div
              class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl"
            >
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                  <svg
                    class="w-full h-full"
                    viewBox="0 0 50 50"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <rect width="50" height="50" fill="#555"></rect>
                    <circle cx="25" cy="20" r="10" fill="#777"></circle>
                    <rect
                      x="15"
                      y="30"
                      width="20"
                      height="20"
                      fill="#777"
                    ></rect>
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold">Lucas Mendes</h4>
                  <p class="text-neonred text-sm">Aluno há 6 meses</p>
                </div>
              </div>
              <p class="text-white/80 italic">
                "Comecei no plano premium e valeu cada centavo. As sessões com
                personal trainer aceleraram meus resultados de forma
                impressionante."
              </p>
            </div>

            <!-- Depoimento 4 -->
            <div
              class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl"
            >
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                  <svg
                    class="w-full h-full"
                    viewBox="0 0 50 50"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <rect width="50" height="50" fill="#555"></rect>
                    <circle cx="25" cy="20" r="10" fill="#777"></circle>
                    <rect
                      x="15"
                      y="30"
                      width="20"
                      height="20"
                      fill="#777"
                    ></rect>
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold">Fernanda Lima</h4>
                  <p class="text-neongreen text-sm">Aluna há 3 meses</p>
                </div>
              </div>
              <p class="text-white/80 italic">
                "A estrutura da academia é incrível e o ambiente é super
                motivador. Finalmente encontrei um lugar onde me sinto bem para
                treinar!"
              </p>
            </div>

            <!-- Duplicados para o efeito infinito -->
            <div
              class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl"
            >
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                  <svg
                    class="w-full h-full"
                    viewBox="0 0 50 50"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <rect width="50" height="50" fill="#555"></rect>
                    <circle cx="25" cy="20" r="10" fill="#777"></circle>
                    <rect
                      x="15"
                      y="30"
                      width="20"
                      height="20"
                      fill="#777"
                    ></rect>
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold">Roberto Almeida</h4>
                  <p class="text-neonred text-sm">Aluno há 8 meses</p>
                </div>
              </div>
              <p class="text-white/80 italic">
                "Perdi 15kg em 6 meses com o acompanhamento da equipe da Gym
                Genesis. A combinação de treino e nutrição fez toda a
                diferença!"
              </p>
            </div>

            <div
              class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl"
            >
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                  <svg
                    class="w-full h-full"
                    viewBox="0 0 50 50"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <rect width="50" height="50" fill="#555"></rect>
                    <circle cx="25" cy="20" r="10" fill="#777"></circle>
                    <rect
                      x="15"
                      y="30"
                      width="20"
                      height="20"
                      fill="#777"
                    ></rect>
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold">Camila Ferreira</h4>
                  <p class="text-neongreen text-sm">Aluna há 1 ano</p>
                </div>
              </div>
              <p class="text-white/80 italic">
                "As aulas de funcional da Ana são incríveis! Nunca me senti tão
                disposta e forte. A energia da academia é contagiante!"
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer id="contato" class="bg-darkblue py-16">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
          <!-- Informações de Contato -->
          <div>
            <h3 class="text-2xl font-bold mb-6 logo">GYM GENESIS</h3>
            <p class="text-white/70 mb-4">
              Transformando vidas através do movimento e da superação diária.
            </p>
            <div class="flex items-center mb-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neongreen mr-3"
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
              <span>Av. Principal, 1000 - Centro</span>
            </div>
            <div class="flex items-center mb-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neongreen mr-3"
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
              <span>(11) 99999-9999</span>
            </div>
            <div class="flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neongreen mr-3"
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
              <span>contato@gymgenesis.com</span>
            </div>
          </div>

          <!-- Horários -->
          <div>
            <h3 class="text-xl font-bold mb-6">Horário de Funcionamento</h3>
            <div
              class="flex justify-between mb-2 pb-2 border-b border-white/10"
            >
              <span>Segunda - Sexta</span>
              <span class="text-neongreen">05:00 - 23:00</span>
            </div>
            <div
              class="flex justify-between mb-2 pb-2 border-b border-white/10"
            >
              <span>Sábado</span>
              <span class="text-neongreen">07:00 - 20:00</span>
            </div>
            <div
              class="flex justify-between mb-2 pb-2 border-b border-white/10"
            >
              <span>Domingo</span>
              <span class="text-neongreen">08:00 - 14:00</span>
            </div>
            <div class="mt-6">
              <h4 class="font-bold mb-2">Siga-nos</h4>
              <div class="flex space-x-4">
                <!-- instagram -->
                <a
                  href="https://www.instagram.com/gym_gênesis/#"
                  class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-neongreen hover:text-dark transition-all"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    fill="currentColor"
                    class="bi bi-instagram"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"
                    ></path>
                  </svg>
                </a>
                <!-- whatsapp -->
                <a
                  href="https://api.whatsapp.com/send?phone=556286272764&text=Quero%20saber%20mais%20sobre%20a%20academia,%20por%20favor%20me%20responda."
                  class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-neongreen hover:text-dark transition-all"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    fill="currentColor"
                    class="bi bi-whatsapp"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"
                    ></path>
                  </svg>
                </a>
                <a
                  href="#"
                  class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-neongreen hover:text-dark transition-all"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    fill="currentColor"
                    class="bi bi-tiktok"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"
                    ></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>

          <!-- Links Rápidos -->
          <div>
            <h3 class="text-xl font-bold mb-6">Links Rápidos</h3>
            <ul class="space-y-3">
              <li>
                <a
                  href="#sobre"
                  class="text-white/70 hover:text-neongreen transition-colors flex items-center"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-2"
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
                  Sobre Nós
                </a>
              </li>
              <li>
                <a
                  href="#servicos"
                  class="text-white/70 hover:text-neongreen transition-colors flex items-center"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-2"
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
                  Serviços
                </a>
              </li>
              <li>
                <a
                  href="#planos"
                  class="text-white/70 hover:text-neongreen transition-colors flex items-center"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-2"
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
                  Planos
                </a>
              </li>
              <li>
                <a
                  href="#equipe"
                  class="text-white/70 hover:text-neongreen transition-colors flex items-center"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-2"
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
                  Equipe
                </a>
              </li>
              <li>
                <a
                  href="#contato"
                  class="text-white/70 hover:text-neongreen transition-colors flex items-center"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-2"
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
                  Contato
                </a>
              </li>
            </ul>
            <div class="mt-8 p-4 bg-dark/50 rounded-lg">
              <h4 class="font-bold mb-2">Primeira Aula Grátis</h4>
              <p class="text-white/70 text-sm mb-4">
                Experimente a Gym Genesis sem compromisso. Venha conhecer nossa
                estrutura!
              </p>
              <button
                class="w-full py-2 bg-neonred hover:bg-neonred/90 text-white font-bold rounded-lg transition-all"
              >
                <a href="#planos">Agendar Visita</a>
              </button>
            </div>
          </div>
        </div>

        <div
          class="border-t border-white/10 mt-12 pt-8 text-center text-white/50"
        >
          <p>© 2023 Gym Genesis. Todos os direitos reservados.</p>
        </div>
      </div>
    </footer>
    <!-- 
    <script>
      // Criar partículas para o fundo
      function createParticles() {
        const container = document.getElementById("particles");
        const particleCount = 50;

        for (let i = 0; i < particleCount; i++) {
          const particle = document.createElement("div");
          particle.classList.add("particle");

          // Tamanho aleatório
          const size = Math.random() * 5 + 2;
          particle.style.width = `${size}px`;
          particle.style.height = `${size}px`;

          // Posição inicial aleatória
          const posX = Math.random() * 100;
          const posY = Math.random() * 100;
          particle.style.left = `${posX}%`;
          particle.style.top = `${posY}%`;

          // Duração e delay aleatórios
          const duration = Math.random() * 20 + 10;
          const delay = Math.random() * 5;
          particle.style.animation = `float ${duration}s ${delay}s infinite linear`;

          container.appendChild(particle);
        }
      }

      // Efeito de digitação
      function typeWriter() {
        const text = "";
        const element = document.getElementById("typewriter");
        let i = 0;

        function type() {
          if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
            setTimeout(type, 50);
          }
        }

        type();
      }

      // Revelar elementos ao rolar
      function revealOnScroll() {
        const reveals = document.querySelectorAll(".reveal");

        for (let i = 0; i < reveals.length; i++) {
          const windowHeight = window.innerHeight;
          const elementTop = reveals[i].getBoundingClientRect().top;
          const elementVisible = 150;

          if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("active");
          }
        }
      }

      // Mobile menu toggle
      function setupMobileMenu() {
        const menuToggle = document.getElementById("menu-toggle");
        const closeMenu = document.getElementById("close-menu");
        const mobileMenu = document.getElementById("mobile-menu");
        const mobileLinks = mobileMenu.querySelectorAll("a");

        menuToggle.addEventListener("click", () => {
          mobileMenu.classList.add("active");
        });

        closeMenu.addEventListener("click", () => {
          mobileMenu.classList.remove("active");
        });

        mobileLinks.forEach((link) => {
          link.addEventListener("click", () => {
            mobileMenu.classList.remove("active");
          });
        });
      }

      // Inicializar
      document.addEventListener("DOMContentLoaded", function () {
        createParticles();
        typeWriter();
        setupMobileMenu();

        window.addEventListener("scroll", revealOnScroll);
        revealOnScroll();
      });
    </script>
    <script>
      (function () {
        function c() {
          var b = a.contentDocument || a.contentWindow.document;
          if (b) {
            var d = b.createElement("script");
            d.innerHTML =
              "window.__CF$cv$params={r:'94c4b46f479afe12',t:'MTc0OTM0NzA3NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
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
    </script> -->

<script src="./js/inicial.js"></script>
  </body>
</html>
