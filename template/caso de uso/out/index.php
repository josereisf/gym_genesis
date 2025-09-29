<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gym Genesis | Transforme-se</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&amp;display=swap"
    rel="stylesheet" />
    
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
    class="fixed w-full z-50 bg-dark/80 backdrop-blur-md border-b border-white/10">
    <div
      class="container mx-auto px-4 py-4 flex justify-between items-center">
      <div class="logo text-2xl md:text-3xl">GYM GENESIS</div>

      <div class="hidden md:flex space-x-8">
        <a
          href="#sobre"
          class="text-white/80 hover:text-neongreen transition-colors">Sobre</a>
        <a
          href="#servicos"
          class="text-white/80 hover:text-neongreen transition-colors">Serviços</a>
        <a
          href="#planos"
          class="text-white/80 hover:text-neongreen transition-colors">Planos</a>
        <a
          href="#equipe"
          class="text-white/80 hover:text-neongreen transition-colors">Equipe</a>
        <a
          href="#contato"
          class="text-white/80 hover:text-neongreen transition-colors">Contato</a>
      </div>

      <button class="md:hidden text-white" id="menu-toggle">
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
            d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
  </nav>

  <!-- Mobile Menu -->
  <div
    class="mobile-menu fixed top-0 left-0 h-full w-64 bg-darkblue z-50 p-6 shadow-lg"
    id="mobile-menu">
    <div class="flex justify-between items-center mb-8">
      <div class="logo text-xl">GYM GENESIS</div>
      <button id="close-menu">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 text-white"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="flex flex-col space-y-4">
      <a
        href="#sobre"
        class="text-white/80 hover:text-neongreen transition-colors py-2">Sobre</a>
      <a
        href="#servicos"
        class="text-white/80 hover:text-neongreen transition-colors py-2">Serviços</a>
      <a
        href="#planos"
        class="text-white/80 hover:text-neongreen transition-colors py-2">Planos</a>
      <a
        href="#equipe"
        class="text-white/80 hover:text-neongreen transition-colors py-2">Equipe</a>
      <a
        href="#contato"
        class="text-white/80 hover:text-neongreen transition-colors py-2">Contato</a>
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
            "></div>
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
          id="btnStart">
          COMECE AGORA
        </button>
      </div>
    </div>

  </section>

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
      <h2 class="text-2xl font-bold mb-6">Você já possui cadastro?</h2>
      <div class="flex flex-col space-y-4">
        <a
          href="login.php"
          class="bg-blue-600 hover:bg-blue-700 py-2 rounded-xl font-semibold transition">Sim, já tenho</a>
        <a
          href="2-etapa.php"
          class="bg-gray-600 hover:bg-gray-700 py-2 rounded-xl font-semibold transition">Não, quero me cadastrar</a>
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
              class="absolute left-2 top-1/2 -translate-y-1/2 text-white bg-black/50 hover:bg-black px-3 py-1 rounded">
              ‹
            </button>
            <button
              id="nextBtn"
              class="absolute right-2 top-1/2 -translate-y-1/2 text-white bg-black/50 hover:bg-black px-3 py-1 rounded">
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
            class="w-16 h-16 bg-neonred/20 rounded-full flex items-center justify-center mb-6 mx-auto">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-8 w-8 text-neonred"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
            class="w-16 h-16 bg-neongreen/20 rounded-full flex items-center justify-center mb-6 mx-auto">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-8 w-8 text-neongreen"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
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
            class="w-16 h-16 bg-neonred/20 rounded-full flex items-center justify-center mb-6 mx-auto">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-8 w-8 text-neonred"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
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
            class="w-16 h-16 bg-neongreen/20 rounded-full flex items-center justify-center mb-6 mx-auto">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-8 w-8 text-neongreen"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
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
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Acesso à musculação
            </li>
            <li class="flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neonred mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Horário comercial
            </li>
            <li class="flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neonred mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Avaliação física mensal
            </li>
            <li class="flex items-center text-white/40">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-white/40 mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
              Aulas coletivas
            </li>
            <li class="flex items-center text-white/40">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-white/40 mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
              Personal trainer
            </li>
          </ul>
          <button
            class="w-full py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-lg transition-all"
            onclick="window.location.href='2-etapa.php'">
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
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Acesso à musculação
            </li>
            <li class="flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neonred mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Acesso 24 horas
            </li>
            <li class="flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neonred mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Avaliação física mensal
            </li>
            <li class="flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neonred mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Aulas coletivas
            </li>
            <li class="flex items-center text-white/40">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-white/40 mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
              Personal trainer
            </li>
          </ul>
          <button
            class="w-full py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-lg transition-all"
            onclick="window.location.href='2-etapa.php'">
            Assinar Agora
          </button>
        </div>

        <!-- Plano Premium -->
        <div
          class="plan-card premium-plan rounded-xl p-8 bg-darkblue reveal active">
          <div
            class="absolute -top-4 right-8 bg-neongreen text-dark px-4 py-1 rounded-full text-sm font-bold">
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
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Acesso à musculação
            </li>
            <li class="flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neongreen mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Acesso 24 horas
            </li>
            <li class="flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neongreen mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Avaliação física semanal
            </li>
            <li class="flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neongreen mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              Todas as aulas coletivas
            </li>
            <li class="flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-neongreen mr-2"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
              </svg>
              4 sessões de personal/mês
            </li>
          </ul>
          <button
            class="w-full py-3 bg-neongreen hover:bg-neongreen/90 text-dark font-bold rounded-lg transition-all"
            onclick="window.location.href='2-etapa.php'">
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
            class="w-40 h-40 rounded-full overflow-hidden mx-auto mb-4 border-4 border-neonred flex items-center justify-center bg-gray-900">
            <i class="fa-solid fa-user text-6xl text-gray-400"></i>
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
            class="w-40 h-40 rounded-full overflow-hidden mx-auto mb-4 border-4 border-neonred flex items-center justify-center bg-gray-900">
            <i class="fa-solid fa-user text-6xl text-gray-400"></i>
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
            class="w-40 h-40 rounded-full overflow-hidden mx-auto mb-4 border-4 border-neonred flex items-center justify-center bg-gray-900">
            <i class="fa-solid fa-user text-6xl text-gray-400"></i>
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
            class="w-40 h-40 rounded-full overflow-hidden mx-auto mb-4 border-4 border-neonred flex items-center justify-center bg-gray-900">
            <i class="fa-solid fa-user text-6xl text-gray-400"></i>
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
            class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-full overflow-hidden mr-4 flex items-center justify-center bg-gray-800">
                <i class="fa-solid fa-user text-gray-400 text-2xl"></i>
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
            class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-full overflow-hidden mr-4 flex items-center justify-center bg-gray-800">
                <i class="fa-solid fa-user text-gray-400 text-2xl"></i>
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
            class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-full overflow-hidden mr-4 flex items-center justify-center bg-gray-800">
                <i class="fa-solid fa-user text-gray-400 text-2xl"></i>
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
            class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-full overflow-hidden mr-4 flex items-center justify-center bg-gray-800">
                <i class="fa-solid fa-user text-gray-400 text-2xl"></i>
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
            class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-full overflow-hidden mr-4 flex items-center justify-center bg-gray-800">
                <i class="fa-solid fa-user text-gray-400 text-2xl"></i>
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
            class="min-w-[300px] md:min-w-[400px] p-6 mx-4 bg-dark rounded-xl">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-full overflow-hidden mr-4 flex items-center justify-center bg-gray-800">
                <i class="fa-solid fa-user text-gray-400 text-2xl"></i>
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
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>Av. Principal, 1000 - Centro</span>
          </div>
          <div class="flex items-center mb-3">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 text-neongreen mr-3"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
            <span>(11) 99999-9999</span>
          </div>
          <div class="flex items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 text-neongreen mr-3"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span>contato@gymgenesis.com</span>
          </div>
        </div>

        <!-- Horários -->
        <div>
          <h3 class="text-xl font-bold mb-6">Horário de Funcionamento</h3>
          <div
            class="flex justify-between mb-2 pb-2 border-b border-white/10">
            <span>Segunda - Sexta</span>
            <span class="text-neongreen">05:00 - 23:00</span>
          </div>
          <div
            class="flex justify-between mb-2 pb-2 border-b border-white/10">
            <span>Sábado</span>
            <span class="text-neongreen">07:00 - 20:00</span>
          </div>
          <div
            class="flex justify-between mb-2 pb-2 border-b border-white/10">
            <span>Domingo</span>
            <span class="text-neongreen">08:00 - 14:00</span>
          </div>
          <div class="mt-6">
            <h4 class="font-bold mb-2">Siga-nos</h4>
            <div class="flex space-x-4">
              <!-- instagram -->
              <a
                href="https://www.instagram.com/gym_gênesis/#"
                class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center  hover:text-dark transition-all">
                <i class="fa-brands fa-instagram text-2xl bg-gradient-to-r from-[#f58529] via-[#dd2a7b] to-[#8134af] bg-clip-text text-transparent"></i>

              </a>
              <!-- whatsapp -->
              <a
                href="https://api.whatsapp.com/send?phone=556286272764&text=Quero%20saber%20mais%20sobre%20a%20academia,%20por%20favor%20me%20responda."
                class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center  hover:text-dark transition-all">
                <i class="fa-brands fa-whatsapp text-green-500 text-xl"></i>
              </a>
              <a
                href="#"
                class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center  hover:text-dark transition-all">
                <div class="relative w-12 h-12 flex items-center justify-center">
                  <!-- sombra azul -->
                  <i class="fa-brands fa-tiktok absolute text-2xl -translate-x-0.5 translate-y-0.5 text-[#69C9D0]"></i>
                  <!-- sombra vermelha -->
                  <i class="fa-brands fa-tiktok absolute text-2xl translate-x-0.5 -translate-y-0.5 text-[#EE1D52]"></i>
                  <!-- ícone principal branco -->
                  <i class="fa-brands fa-tiktok absolute text-white text-2xl"></i>
                </div>


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
                class="text-white/70 hover:text-neongreen transition-colors flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 mr-2"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"></path>
                </svg>
                Sobre Nós
              </a>
            </li>
            <li>
              <a
                href="#servicos"
                class="text-white/70 hover:text-neongreen transition-colors flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 mr-2"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"></path>
                </svg>
                Serviços
              </a>
            </li>
            <li>
              <a
                href="#planos"
                class="text-white/70 hover:text-neongreen transition-colors flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 mr-2"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"></path>
                </svg>
                Planos
              </a>
            </li>
            <li>
              <a
                href="#equipe"
                class="text-white/70 hover:text-neongreen transition-colors flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 mr-2"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"></path>
                </svg>
                Equipe
              </a>
            </li>
            <li>
              <a
                href="#contato"
                class="text-white/70 hover:text-neongreen transition-colors flex items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 mr-2"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"></path>
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
              class="w-full py-2 bg-neonred hover:bg-neonred/90 text-white font-bold rounded-lg transition-all">
              <a href="#planos">Agendar Visita</a>
            </button>
          </div>
        </div>
      </div>

      <div
        class="border-t border-white/10 mt-12 pt-8 text-center text-white/50">
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