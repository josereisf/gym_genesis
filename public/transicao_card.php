<?php
require_once "../code/funcao.php";
$idaluno = $_SESSION["id"] ?? 0;

$professores = listarUsuarioTipo(2);

$tudojunto = [];

foreach ($professores as $prof) {
  $id = $prof['idusuario'];

  $perfil = listarPerfilUsuario($id);

  $cargo = listarCargo($id);

  $tudojunto[] = [
    'usuario' => $prof,
    'perfil' => $perfil,
    'cargo' => $cargo
  ];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>Carrossel Professores</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(to bottom right, #132237, #1a2f4a, #0d1625);
      transition: background 0.5s infinite;
    }

    @keyframes background {
      0% {
        background: linear-gradient(to bottom right, #132237, #1a2f4a, #0d1625);
      }

      50% {
        background: linear-gradient(to bottom right, #0d1625, #132237, #1a2f4a);
      }

      100% {
        background: linear-gradient(to bottom right, #132237, #1a2f4a, #0d1625);
      }
    }

    .carousel-wrapper {
      perspective: 1000px;
    }

    /* garante que bordas não aumentem o "tamanho" visual do card */
    .card {
      box-sizing: border-box;
      transition: transform 0.45s ease, opacity 0.45s ease, border 0.25s, box-shadow 0.25s;
      position: absolute;
      width: 285px;
      height: 397px;
      background-color: white;
      border-radius: 1rem;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      padding: 1rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      text-align: center;
      cursor: pointer;
      left: 50%;
      /* centraliza a base do card */
      top: 20px;
      /* pequena margem do topo do container */
      transform: translateX(-50%);
      /* base central, depois as classes ajustam */
    }

    .card img {
      width: 100%;
      height: 160px;
      border-radius: 0.75rem;
      object-fit: cover;
    }

    /* Posições no carrossel (não mudam o tamanho, só posição/escala leve) */
    .center {
      transform: translateX(-50%) translateY(-10px) scale(1);
      /* sobe levemente */
      z-index: 30;
      opacity: 1;
    }

    .left {
      transform: translateX(calc(-50% - 280px)) scale(0.92);
      z-index: 20;
      opacity: 0.65;
    }

    .right {
      transform: translateX(calc(-50% + 280px)) scale(0.92);
      z-index: 20;
      opacity: 0.65;
    }

    .hidden-card {
      opacity: 0;
      pointer-events: none;
    }

    /* Destaque quando selecionado (não afeta fluxo) */
    .selected {
      position: relative;
      /* para o ::after absoluto */
      border: 3px solid #22c55e;
      /* verde */
      box-shadow: 0 18px 36px rgba(34, 197, 94, 0.12);
    }

    .selected::after {
      content: "✓";
      position: absolute;
      top: 8px;
      right: 12px;
      color: #ffffff;
      background: #16a34a;
      width: 26px;
      height: 26px;
      border-radius: 9999px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 14px;
      box-shadow: 0 6px 12px rgba(16, 185, 129, 0.12);
    }

    /* evita overflow visual fora do contêiner */
    #carousel {
      overflow: visible;
    }

    /* melhora para botões */
    button:disabled {
      opacity: 0.9;
    }

    .fa-solid {
      color: black;
    }

    /* responsividade simples: reduzir espaçamento lateral em telas pequenas */
    @media (max-width: 480px) {
      .card {
        width: 220px;
        height: 320px;
      }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body class="bg-gradient-to-br from-[#132237] via-[#1a2f4a] to-[#0d1625] text-white flex flex-col items-center justify-center min-h-screen p-6">

  <form action="api/index.php?entidade=professor_aluno&acao=cadastrar" method="post"
    class="flex flex-col items-center space-y-6 w-full max-w-[920px]">

    <div class="relative w-full flex justify-center items-center mb-6 group" id="carouselContainer">
      <!-- Botão Esquerdo -->
      <button type="button"
        id="prevBtn"
        class="absolute left-4 z-40 bg-white text-black hover:bg-green-500 hover:text-white shadow-lg rounded-full w-12 h-12 flex items-center justify-center text-2xl transition-all duration-300">
        ←
      </button>

      <!-- Carrossel (contêiner relativo) -->
      <div class="relative w-[1000px] h-[400px] carousel-wrapper flex items-center justify-center">
        <div id="carousel" class="relative w-full h-full"></div>
      </div>

      <!-- Botão Direito -->
      <button type="button"
        id="nextBtn"
        class="absolute right-4 z-40 bg-white text-black hover:bg-green-500 hover:text-white shadow-lg rounded-full w-12 h-12 flex items-center justify-center text-2xl transition-all duration-300">
        →
      </button>
    </div>

    <!-- Input escondido -->
    <input type="hidden" name="professor_id" id="professorId">

    <!-- Resumo -->
    <p id="resumoEscolha" class="text-lg text-gray-200 font-medium"></p>

    <!-- Botão Confirmar -->
    <button type="submit" id="btnSubmit"
      disabled
      class="px-6 py-2 bg-gray-400 text-white rounded-xl shadow-md cursor-not-allowed transition-colors">
      Confirmar Professor
    </button>


  </form>
<!-- Modal global único -->

<!-- Modal Premium -->
<div id="modal_perfil" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl flex flex-col md:flex-row overflow-hidden relative transition-transform transform scale-95 md:scale-100">
    <!-- Fechar -->
    <button id="fechar_modal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl font-bold z-50">&times;</button>

    <!-- Conteúdo esquerdo -->
    <div class="md:w-2/3 p-8 overflow-y-auto max-h-[80vh]">
      <h2 class="text-3xl text-black font-bold mb-4" id="nome_professor">Nome do Professor</h2>

      <div class="space-y-4 text-gray-700 text-lg">
        <p><strong>Email:</strong> <span id="email_professor">email@exemplo.com</span></p>
        <p><strong>Telefone:</strong> <span id="telefone_professor">(00) 00000-0000</span></p>
        <p><strong>Função:</strong> <span id="funcao_professor">Instrutor</span></p>
        <p><strong>Classificação:</strong> <span id="classificacao_professor">⭐⭐⭐⭐☆</span></p>
        <p><strong>Treinos ligados:</strong> <span id="treinos_professor">Treino A, Treino B</span></p>
        <p><strong>Outras informações:</strong> <span id="outras_info">Lorem ipsum dolor sit amet...</span></p>
      </div>
    </div>

    <!-- Foto direita -->
    <div class="md:w-1/3 bg-gray-100 flex items-center justify-center p-4">
      <img id="foto_professor" src="./uploads/be85ede6b4e1405356077194445313e1.jpg" alt="Foto do Professor" class="rounded-xl shadow-lg w-full h-auto object-cover max-h-[80vh]">
    </div>
  </div>
</div>

<script>
  

  function abrirModal(professor) {
    document.getElementById("nome_professor").textContent = professor.nome || "Sem Nome";
    document.getElementById("email_professor").textContent = professor.email || "-";
    document.getElementById("telefone_professor").textContent = professor.telefone || "-";
    document.getElementById("funcao_professor").textContent = professor.funcao || "Instrutor";
    document.getElementById("classificacao_professor").textContent = professor.classificacao || "⭐⭐⭐⭐☆";
    document.getElementById("treinos_professor").textContent = (professor.treinos || []).join(", ") || "-";
    document.getElementById("outras_info").textContent = professor.outras_info || "-";
    document.getElementById("foto_professor").src = professor.foto || "./uploads/padrao.png";
    modal.classList.remove("hidden");
  }

  // Fechar modal
  btnFechar.addEventListener('click', () => modal.classList.add('hidden'));
  modal.addEventListener('click', (e) => { if (e.target === modal) modal.classList.add('hidden'); });
</script>

<script>
  const professores = <?php echo json_encode($tudojunto); ?>;
  let currentIndex = 0;
  let selectedId = "";

  const carousel = document.getElementById("carousel");
  const inputHidden = document.getElementById("professorId");
  const resumo = document.getElementById("resumoEscolha");
  const btnSubmit = document.getElementById("btnSubmit");

  const modal = document.getElementById('modal_perfil');
  const btnFechar = document.getElementById('fechar_modal');

  // Função para atualizar botão submit
  function updateSubmitState() {
    if (selectedId) {
      btnSubmit.disabled = false;
      btnSubmit.classList.remove("bg-gray-400", "cursor-not-allowed");
      btnSubmit.classList.add("bg-green-600", "hover:bg-green-700");
    } else {
      btnSubmit.disabled = true;
      btnSubmit.classList.remove("bg-green-600", "hover:bg-green-700");
      btnSubmit.classList.add("bg-gray-400", "cursor-not-allowed");
    }
  }

  // Renderiza os cards do carousel
  function renderCards() {
    carousel.innerHTML = "";

    professores.forEach((profObj, index) => {
      const prof = profObj.usuario;
      const perfil = (profObj.perfil && profObj.perfil[0]) || {};
      const cargo = (profObj.cargo && profObj.cargo[0]?.descricao) || "Professor";
      const nome_cargo = (profObj.cargo && profObj.cargo[0]?.nome) || "Professor";

      const div = document.createElement("div");
      div.className = "card";

      // Posição
      if (index === currentIndex) div.classList.add("center");
      else if (index === currentIndex - 1) div.classList.add("left");
      else if (index === currentIndex + 1) div.classList.add("right");
      else div.classList.add("hidden-card");

      div.innerHTML = `
        <div class="w-full h-full flex flex-col items-center">
          <div class="w-full flex items-center justify-center">
            <img
              src="./uploads/${perfil.foto_perfil ? perfil.foto_perfil : 'be85ede6b4e1405356077194445313e1.jpg'}"
              alt="${perfil.nome || 'Professor'}"
              class="w-20 h-20 object-cover rounded-xl shadow-md border-4 border-white"
              loading="lazy"
            />
          </div>

          <div class="mt-2 text-center px-4">
            <h2 class="text-lg font-semibold text-gray-900 leading-tight">${perfil.nome || "Sem Nome"}</h2>
            <div class="mt-2 flex items-center justify-center gap-2">
              <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full font-medium">${nome_cargo}</span>
            </div>

            <div class="mt-3 text-sm text-gray-700 space-y-2 text-left">
              <div class="flex items-center gap-2">
                <i class="fa-solid fa-envelope text-gray-500 w-4 h-4"></i>
                <a href="mailto:${prof.email}" class="truncate" title="${prof.email}">${prof.email}</a>
              </div>

              <div class="flex items-center gap-2">
                <i class="fa-solid fa-phone text-gray-500"></i>
                <a href="tel:${perfil.telefone}" class="truncate" title="${perfil.telefone}">${perfil.telefone}</a>
              </div>

              <div class="flex items-center gap-2">
                <i class="fa-solid fa-briefcase text-gray-500"></i>
                <span class="text-gray-600">${cargo}</span>
              </div>
            </div>

            <div class="mt-4 flex gap-3 justify-center">
              <button type="button" class="px-3 py-1 bg-white text-gray-800 rounded-md text-sm shadow-md hover:shadow-lg transition ver_perfil_btn">
                Ver perfil
              </button>

              <button type="button" class="px-3 py-1 bg-green-600 text-white rounded-md text-sm shadow-md hover:bg-green-700 transition select-btn" data-id="${prof.idusuario}">
                Selecionar
              </button>
            </div>
          </div>
        </div>
      `;

      // Seleção
      if (String(prof.idusuario) === String(selectedId)) div.classList.add("selected");

      // Clique no card central seleciona/desseleciona
      if (index === currentIndex) {
        div.addEventListener("click", () => {
          selectedId = String(prof.idusuario);
          inputHidden.value = selectedId;
          resumo.textContent = `Você selecionou: ${perfil.nome}`;
          updateSubmitState();
          renderCards();
        });

        div.addEventListener("dblclick", () => {
          if (String(selectedId) === String(prof.idusuario)) {
            selectedId = "";
            inputHidden.value = "";
            resumo.textContent = "Nenhum professor selecionado";
            updateSubmitState();
            renderCards();
          }
        });
      }

      // Abrir modal ao clicar em "Ver perfil"
      div.querySelector(".ver_perfil_btn").addEventListener("click", () => {
        document.getElementById("nome_professor").textContent = perfil.nome || "Sem Nome";
        document.getElementById("email_professor").textContent = prof.email || "-";
        document.getElementById("telefone_professor").textContent = perfil.telefone || "-";
        document.getElementById("funcao_professor").textContent = nome_cargo;
        document.getElementById("classificacao_professor").textContent = perfil.classificacao || "⭐⭐⭐⭐☆";
        document.getElementById("treinos_professor").textContent = (perfil.treinos || []).join(", ") || "-";
        document.getElementById("outras_info").textContent = perfil.outras_info || "-";
        modal.classList.remove("hidden");
      });

      carousel.appendChild(div);
    });

    if (selectedId) {
      const sel = professores.find(p => String(p.usuario.idusuario) === String(selectedId));
      if (sel) resumo.textContent = `Você selecionou: ${sel.perfil[0]?.nome || sel.usuario.nome}`;
    }
  }

  // Navegação do carousel
  function nextSlide() { if (currentIndex < professores.length - 1) { currentIndex++; renderCards(); } }
  function prevSlide() { if (currentIndex > 0) { currentIndex--; renderCards(); } }
  document.getElementById("nextBtn").addEventListener("click", nextSlide);
  document.getElementById("prevBtn").addEventListener("click", prevSlide);

  // Fechar modal
  btnFechar.addEventListener('click', () => modal.classList.add('hidden'));
  modal.addEventListener('click', (e) => { if (e.target === modal) modal.classList.add('hidden'); });

  // Inicializa
  updateSubmitState();
  renderCards();
</script>

</body>

</html>