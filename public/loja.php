<?php

require_once __DIR__ . '/../code/funcao.php';
require_once __DIR__ . "/./php/verificarLogado.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gym Gênesis</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./js/loja.js"></script>
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

    /* Scroll indicator */
    @keyframes bounce {

      0%,
      20%,
      50%,
      80%,
      100% {
        transform: translateY(0);
      }

      40% {
        transform: translateY(-10px);
      }

      60% {
        transform: translateY(-5px);
      }
    }

    .scroll-indicator {
      animation: bounce 2s infinite;
    }

    /* Pulse effect for CTA */
    @keyframes pulse-glow {
      0% {
        box-shadow: 0 0 0 0 rgba(57, 255, 20, 0.7);
      }

      70% {
        box-shadow: 0 0 0 10px rgba(57, 255, 20, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(57, 255, 20, 0);
      }
    }

    .animate-pulse-glow {
      animation: pulse-glow 2s infinite;
    }

    /* Product card shine effect */
    @keyframes shine {
      to {
        background-position: 200% center;
      }
    }

    /* Custom checkbox style */
    .category-checkbox:checked+span {
      background-color: #ff2e63;
      color: white;
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
  <!-- Header -->
  <header id="header" class="bg-white dark:bg-darkgray shadow-md fixed w-full top-0 left-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center">
        <!-- Logo com marca textual -->
        <h1 class="text-2xl font-bold text-neonred dark:text-neongreen flex items-center">
          <i class="fas fa-dumbbell mr-2"></i>Gym<span class="font-black">Gênesis</span>
        </h1>
      </div>

      <!-- Menu para desktop -->
      <nav class="hidden md:flex space-x-6 items-center">
        <a href="#" class="text-gray-700 dark:text-white hover:text-neonred dark:hover:text-neongreen transition-colors font-medium">Início</a>
        <a href="#produtos" class="text-gray-700 dark:text-white hover:text-neonred dark:hover:text-neongreen transition-colors font-medium">Produtos</a>
        <a href="#categorias" class="text-gray-700 dark:text-white hover:text-neonred dark:hover:text-neongreen transition-colors font-medium">Categorias</a>
        <a href="#contato" class="text-gray-700 dark:text-white hover:text-neonred dark:hover:text-neongreen transition-colors font-medium">Contato</a>
      </nav>

      <div class="flex items-center space-x-4">
        <!-- Botão de modo claro/escuro -->
        <button id="themeToggle" class="text-lg text-white bg-neonred w-10 h-10 rounded-full transition hover:bg-red-600 flex items-center justify-center">
          <i id="themeIcon" class="fas fa-moon"></i>
        </button>


        <button onclick="window.location.href='carrinho.php'"
          class="relative bg-neonred text-white w-10 h-10 rounded-full hover:bg-red-700 transition flex items-center justify-center">
          <i class="fas fa-shopping-cart"></i>
          <span class="absolute -top-1 -right-1 bg-neongreen text-black text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center notificar">0</span>
        </button>


        <!-- Menu mobile -->
        <button id="mobileMenuButton" class="md:hidden text-gray-700 dark:text-white">
          <i class="fas fa-bars text-xl"></i>
        </button>
      </div>
    </div>

    <!-- Menu mobile expandido -->
    <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-darkgray px-4 py-4 border-t border-gray-200 dark:border-gray-700">
      <div class="flex flex-col space-y-3">
        <a href="#" class="text-gray-700 dark:text-white hover:text-neonred dark:hover:text-neongreen transition-colors font-medium py-2">Início</a>
        <a href="#produtos" class="text-gray-700 dark:text-white hover:text-neonred dark:hover:text-neongreen transition-colors font-medium py-2">Produtos</a>
        <a href="#categorias" class="text-gray-700 dark:text-white hover:text-neonred dark:hover:text-neongreen transition-colors font-medium py-2">Categorias</a>
        <a href="#contato" class="text-gray-700 dark:text-white hover:text-neonred dark:hover:text-neongreen transition-colors font-medium py-2">Contato</a>
      </div>
    </div>
  </header>

  <!-- Banner -->
  <section class="relative h-[100vh] w-full overflow-hidden">
    <!-- Imagem de fundo com efeito Ken Burns -->
    <div class="absolute inset-0">
      <img
        src="./img/goli.jpg"
        alt="Academia"
        class="w-full h-full object-cover object-center scale-105 animate-kenburns" />
      <!-- Overlay escuro para melhor contraste -->
      <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>

    <!-- Conteúdo -->
    <div
      class="relative z-10 flex flex-col items-center justify-center h-full px-6 text-center max-w-4xl mx-auto text-white">
      <h2
        class="text-5xl md:text-7xl font-extrabold mb-6 bg-gradient-to-r from-neongreen via-neonred to-neongreen bg-clip-text text-transparent drop-shadow-xl animate-fadeInDown">
        Suplementos & Roupas Fitness
      </h2>

      <p
        class="text-xl md:text-2xl mb-10 max-w-xl drop-shadow-lg animate-fadeInUp">
        Alcance seus objetivos com produtos de alta performance. Treine forte, vista-se melhor.
      </p>

      <a
        href="#produtos"
        class="relative inline-block bg-neongreen px-8 py-4 rounded-full font-bold text-black shadow-lg hover:shadow-neongreen hover:scale-110 transform transition duration-300 animate-pulse-glow">
        Ver Produtos
      </a>
    </div>

    <!-- Indicador de scroll -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white scroll-indicator">
      <i class="fas fa-chevron-down text-2xl"></i>
    </div>
  </section>

  <!-- Seção de Categorias -->
  <section id="categorias" class="py-12 bg-gray-100 dark:bg-dark">
    <div class="max-w-7xl mx-auto px-4">
      <h3 class="text-3xl font-bold mb-8 text-center text-gray-800 dark:text-white">Categorias</h3>

      <div class="flex flex-wrap justify-center gap-4 mb-12">

        <?php
        $categoria = listarCategoriaProduto(null);

        foreach ($categoria as $c) {
          echo ' <label class="cursor-pointer flex-shrink-0">
  <input type="checkbox" class="category-checkbox hidden" name="category" value="' . $c['nome'] . '">
  <span class="px-4 py-2 rounded-full bg-white dark:bg-darkgray text-gray-800 dark:text-white shadow-md hover:shadow-lg transition-all duration-300 hover:bg-neonred hover:text-white dark:hover:bg-neongreen dark:hover:text-black">' . $c['nome'] . '</span>
</label>
        ';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Produtoss -->
  <main id="produtos" class="max-w-7xl mx-auto px-4 py-12">
    <h3 class="text-3xl font-bold mb-2 text-gray-800 dark:text-white">Nossos Produtos</h3>
    <p class="text-gray-600 dark:text-gray-400 mb-8">Encontre os melhores produtos para potencializar seus resultados</p>

    <?php
    echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">';

    $listar = listarProdutos(null);

    foreach ($listar as $l) {
      $badge = '';
      if ($l['preco'] < 50) {
        $badge = '<span class="absolute top-2 left-2 bg-neongreen text-black text-xs font-bold px-2 py-1 rounded z-20">PROMO</span>';
      } elseif ($l['idproduto'] % 5 == 0) {
        $badge = '<span class="absolute top-2 left-2 bg-neonred text-white text-xs font-bold px-2 py-1 rounded z-20">NOVO</span>';
      }

      echo '<div class="bg-white dark:bg-darkgray text-gray-900 dark:text-white shadow-lg rounded-xl overflow-hidden flex flex-col hover:shadow-2xl transition-all duration-300 group relative">';
      echo '  <div class="overflow-hidden relative">';
      echo      $badge;
      echo '    <img src="./uploads/' . $l['imagem'] . '" alt="Imagem de ' . $l['nome'] . '" class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500 -z-20">';
      echo '    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>';
      echo '  </div>';

      echo '  <div class="p-5 flex flex-col flex-grow">';
      echo '    <h4 class="text-xl font-semibold mb-1">' . htmlspecialchars($l['nome']) . '</h4>';
      echo '    <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">' . mb_strimwidth(htmlspecialchars($l['descricao']), 0, 60, '...') . '</p>';

      echo '    <div class="mt-auto flex items-center justify-between">';
      echo '      <p class="text-lg text-neonred dark:text-neongreen font-bold">R$ ' . number_format($l['preco'], 2, ',', '.') . '</p>';
      echo '      <button value="' . $l['idproduto'] . '" class="adicionar bg-neonred hover:bg-red-700 text-white font-medium w-10 h-10 rounded-full flex items-center justify-center transition-all group-hover:scale-110">';
      echo '        <i class="fas fa-cart-shopping"></i>';
      echo '      </button>';
      echo '    </div>';
      echo '  </div>';
      echo '</div>';
    }

    echo '</div>';
    ?>

  </main>


  <!-- Rodapé -->
  <footer id="contato" class="bg-gray-100 dark:bg-darkgray pt-12 pb-6">
    <div class="max-w-7xl mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
        <div>
          <h4 class="text-lg font-bold mb-4 text-neonred dark:text-neongreen">Loja Fitness</h4>
          <p class="text-gray-600 dark:text-gray-400 mb-4">Sua loja especializada em produtos de alta qualidade para o seu treino.</p>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">
              <i class="fab fa-twitter"></i>
            </a>
          </div>
        </div>

        <div>
          <h4 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">Produtos</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">Suplementos</a></li>
            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">Roupas</a></li>
            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">Acessórios</a></li>
            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">Ofertas</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">Ajuda</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">FAQ</a></li>
            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">Entregas</a></li>
            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">Devoluções</a></li>
            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-neonred dark:hover:text-neongreen">Pagamentos</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">Contato</h4>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i class="fas fa-map-marker-alt mr-2 text-neonred dark:text-neongreen mt-1"></i>
              <span class="text-gray-600 dark:text-gray-400">Av. Exercício, 123 - Fitness</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-phone-alt mr-2 text-neonred dark:text-neongreen mt-1"></i>
              <span class="text-gray-600 dark:text-gray-400">(11) 99999-9999</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-envelope mr-2 text-neonred dark:text-neongreen mt-1"></i>
              <span class="text-gray-600 dark:text-gray-400">contato@lojafitness.com</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="border-t border-gray-300 dark:border-gray-700 pt-6 text-center">
        <p class="text-gray-600 dark:text-gray-400 text-sm">&copy; 2025 Loja Fitness. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>

  <!-- Botão flutuante do WhatsApp -->
  <a href="https://wa.me/5511999999999" target="_blank" class="fixed bottom-6 right-6 w-14 h-14 bg-neongreen rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform">
    <i class="fab fa-whatsapp text-2xl text-black"></i>
  </a>

  <!-- Scripts JavaScript -->
  <script>
    // Tema claro/escuro
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

    // Menu mobile
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    // Header scroll behavior
    (function() {
      const header = document.getElementById('header');
      const main = document.getElementById('produtos');

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            header.classList.remove('shadow-lg');
            header.classList.add('shadow-md');
          } else {
            header.classList.remove('shadow-md');
            header.classList.add('shadow-lg');
          }
        });
      }, {
        root: null,
        threshold: 0.1
      });

      if (main) {
        observer.observe(main);
      }
    })();

    // Fechar menu ao clicar em um link
    document.querySelectorAll('#mobileMenu a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
      });
    });
  </script>
</body>

</html>