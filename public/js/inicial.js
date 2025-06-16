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

// carrosel na parte da sobre


  const ambientes = [
    {
      nome: "Área de Musculação",
      descricao: "Equipamentos modernos e espaço amplo para treinar.",
      imagem: "https://p2.trrsf.com/image/fget/cf/1200/1200/middle/images.terra.com/2024/07/04/1275438437-academia.jpg"
    },
    {
      nome: "Aulas Coletivas",
      descricao: "Zumba, funcional, spinning e muito mais.",
      imagem: "https://www.amlhr.com.br/assets/images/whatsapp-image-2024-03-15-at-17.40.35-1.webp"
    },
    {
      nome: "Cardio",
      descricao: "Esteiras, bicicletas e simuladores de escada.",
      imagem: "https://p2.trrsf.com/image/fget/cf/1200/1200/middle/images.terra.com/2024/07/04/1275438437-academia.jpg"
    },
    {
      nome: "Área Funcional",
      descricao: "Treinamentos de força, resistência e agilidade.",
      imagem: "https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
    },
    {
      nome: "Avaliação Física",
      descricao: "Acompanhamento individual com especialistas.",
      imagem: "https://blog.supertechfitness.com.br/wp-content/uploads/2023/06/espaco-academia-1024x768.jpeg"
    },
  ];

  let currentIndex = 0;
  let autoPlayInterval;
  const carousel = document.getElementById("carousel");
  const container = document.getElementById("carouselContainer");

  function renderCards() {
    carousel.innerHTML = "";

    ambientes.forEach((item, index) => {
      const div = document.createElement("div");
      div.className = "card";

      const leftIndex = (currentIndex - 1 + ambientes.length) % ambientes.length;
      const rightIndex = (currentIndex + 1) % ambientes.length;

      if (index === currentIndex) {
        div.classList.add("center");
      } else if (index === leftIndex) {
        div.classList.add("left");
      } else if (index === rightIndex) {
        div.classList.add("right");
      } else {
        div.classList.add("hidden-card");
      }

      div.innerHTML = `
        <img src="${item.imagem}" alt="${item.nome}" />
        <div class="p-3">
          <h2 class="text-lg font-bold text-gray-900">${item.nome}</h2>
          <p class="text-sm text-gray-700">${item.descricao}</p>
        </div>
      `;

      carousel.appendChild(div);
    });
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % ambientes.length;
    renderCards();
  }

  function prevSlide() {
    currentIndex = (currentIndex - 1 + ambientes.length) % ambientes.length;
    renderCards();
  }

  function startAutoplay() {
    autoPlayInterval = setInterval(nextSlide, 3500);
  }

  function stopAutoplay() {
    clearInterval(autoPlayInterval);
  }

  // Botões
  document.getElementById("nextBtn").addEventListener("click", nextSlide);
  document.getElementById("prevBtn").addEventListener("click", prevSlide);

  // Eventos desktop (mouse)
  container.addEventListener("mouseenter", stopAutoplay);
  container.addEventListener("mouseleave", startAutoplay);

  // Eventos mobile (toque)
  container.addEventListener("touchstart", stopAutoplay);
  container.addEventListener("touchend", startAutoplay);

  // Inicialização
  renderCards();
  startAutoplay();