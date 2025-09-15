<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Loja Fitness</title>

<style>
  /* Ken Burns Zoom animation */
  @keyframes kenburns {
    0% {
      transform: scale(1.05);
    }
    100% {
      transform: scale(1.15);
    }
  }

  .animate-kenburns {
    animation: kenburns 20s ease-in-out infinite alternate;
  }

  /* Fade in down */
  @keyframes fadeInDown {
    0% {
      opacity: 0;
      transform: translateY(-20px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fadeInDown {
    animation: fadeInDown 1s ease forwards;
  }

  /* Fade in up */
  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(20px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fadeInUp {
    animation: fadeInUp 1.2s ease forwards;
  }
</style>



  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Tailwind custom config -->
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            dark: '#0a0a0a',
            darkblue: '#0d1b2a',
            neonred: '#ff2e63',
            neongreen: '#39ff14',
            darkgray: '#1a1a1a',
          }
        }
      }
    };
  </script>

  <!-- Aplica o tema salvo (antes do DOM carregar) -->
  <script>
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.classList.add('dark');
    }
  </script>
</head>

<body class="bg-white text-gray-800 dark:bg-dark dark:text-neongreen transition duration-300">
<header id="header" class="bg-gray-100 dark:bg-darkgray shadow fixed w-full top-0 left-0 z-50 transition-transform duration-300 transition-opacity duration-300">
  <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-neonred dark:text-neongreen">Loja Fitness</h1>
    
    <nav class="space-x-4 flex items-center">
      <!-- Botão de modo claro/escuro -->
      <button id="themeToggle" class="text-xl text-white bg-neonred px-3 py-2 rounded transition hover:bg-red-600 flex items-center gap-2">
        <i id="themeIcon" class="fas fa-moon"></i>
        <span class="hidden sm:inline">Modo Escuro</span>
      </button>

      <a href="#" class="text-gray-700 dark:text-white hover:text-neonred">Início</a>
      <a href="#" class="text-gray-700 dark:text-white hover:text-neonred">Produtos</a>
      <a href="#" class="text-gray-700 dark:text-white hover:text-neonred">Contato</a>

      <button class="bg-neonred text-white px-4 py-2 rounded hover:bg-red-700 transition">Carrinho</button>
    </nav>
  </div>
</header>



  <!-- Banner -->
<section class="relative h-[100vh] w-full overflow-hidden">
  <!-- Imagem de fundo com efeito Ken Burns -->
  <div class="absolute inset-0">
    <img
      src="./img/goli.jpg"
      alt="Academia"
      class="w-full h-full object-cover object-center scale-105 animate-kenburns"
    />
    <!-- Gradiente escuro e neon -->
    
  </div>

  <!-- Conteúdo -->
  <div
    class="relative z-10 flex flex-col items-center justify-center h-full px-6 text-center max-w-4xl mx-auto text-white"
  >
    <h2
      class="text-5xl md:text-7xl font-extrabold mb-6 bg-gradient-to-r from-neongreen via-neonred to-neongreen bg-clip-text text-transparent drop-shadow-xl animate-fadeInDown"
    >
      Suplementos & Roupas Fitness
    </h2>

    <p
      class="text-xl md:text-2xl mb-10 max-w-xl drop-shadow-lg animate-fadeInUp"
    >
      Alcance seus objetivos com produtos de alta performance. Treine forte, vista-se melhor.
    </p>

    <a
      href="#produtos"
      class="relative inline-block bg-neongreen px-8 py-4 rounded-full font-bold text-black shadow-lg hover:shadow-neongreen hover:scale-110 transform transition duration-300 animate-pulse"
    >
      Ver Produtos
    </a>
  </div>
</section>

  <!-- Produtos -->
  <main id="main" class="max-w-7xl mx-auto px-4 py-12">
    <h3 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">Nossos Produtos</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      <?php
      require_once __DIR__ . '/../code/funcao.php';
      $listar = listarProdutos(null);

      foreach ($listar as $l) {
        echo '
          <div class="bg-white dark:bg-darkgray text-gray-900 dark:text-white shadow-lg rounded-lg overflow-hidden flex flex-col hover:shadow-xl transition-shadow duration-300">
              <div class="overflow-hidden">
                  <img 
                      src="./img/' .$l['imagem']. '" 
                      alt="Imagem de ' . htmlspecialchars($l['nome']) . '" 
                      class="w-full h-48 object-cover transform hover:scale-105 transition-transform duration-300"
                  >
              </div>

              <div class="p-4 flex flex-col flex-grow text-center">
                  <h4 class="text-xl font-semibold mb-1">' . htmlspecialchars($l['nome']) . '</h4>

                  <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">'
                    . mb_strimwidth(htmlspecialchars($l['descricao']), 0, 60, '...') . '
                  </p>

                  <p class="text-lg text-neonred dark:text-neongreen font-bold mb-4">
                      R$ ' . number_format($l['preco'], 2, ',', '.') . '
                  </p>

                  <button class="mt-auto bg-neonred hover:bg-red-700 text-white font-medium py-2 px-4 rounded flex items-center justify-center gap-2 transition">
                      <i class="fas fa-cart-shopping"></i>
                      Adicionar ao Carrinho
                  </button>
              </div>
          </div>';
      }
      ?>
    </div>
  </main>

  <!-- Rodapé -->
  <footer class="bg-gray-100 dark:bg-darkgray text-center py-6 border-t border-gray-300 dark:border-gray-700">
    <p class="text-gray-600 dark:text-gray-400 text-sm">&copy; 2025 Loja Fitness. Todos os direitos reservados.</p>
  </footer>

  <!-- Script para alternar tema -->
  <script>
    const toggleButton = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');

    function updateIcon() {
      const isDark = document.documentElement.classList.contains('dark');
      themeIcon.classList.toggle('fa-moon', !isDark);
      themeIcon.classList.toggle('fa-sun', isDark);
    }

    // Atualiza ícone no carregamento
    updateIcon();

    toggleButton.addEventListener('click', () => {
      document.documentElement.classList.toggle('dark');

      // Atualiza localStorage e ícone
      const isDark = document.documentElement.classList.contains('dark');
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
      updateIcon();
    });
  </script>

<script>
  (function() {
    const header = document.getElementById('header');
    const main = document.getElementById('main');

    // Inicialmente escondido (se quiser pode mostrar no começo)
    // header.style.transform = 'translateY(-100%)';
    // header.style.opacity = '0';

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Quando main está visível, mostrar header
          header.style.transform = 'translateY(0)';
          header.style.opacity = '1';
          header.style.boxShadow = '0 2px 8px rgba(0,0,0,0.15)';
        } else {
          // Quando main não está visível, esconder header
          header.style.transform = 'translateY(-100%)';
          header.style.opacity = '0';
          header.style.boxShadow = 'none';
        }
      });
    }, {
      root: null,       // viewport
      threshold: 0.1    // 10% do main visível para disparar
    });

    observer.observe(main);
  })();
</script>

</body>
</html>
