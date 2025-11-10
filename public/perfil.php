<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Perfil | Gym Genesis</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    * { font-family: 'Nunito', sans-serif; }
    /* Estilos do modal de upload */
    .modal {
      position: fixed; inset: 0;
      background: rgba(0, 0, 0, 0.7);
      display: none; align-items: center; justify-content: center;
      z-index: 50;
    }
    .modal[data-state="1"],
    .modal[data-state="2"],
    .modal[data-state="3"],
    .modal[data-ready="true"] {
      display: flex;
    }
    .modal__body {
      background: #1f2937;
      border: 1px solid #374151;
      border-radius: 1rem;
      padding: 2rem;
      max-width: 480px;
      width: 100%;
      color: white;
      box-shadow: 0 0 30px rgba(0,0,0,0.4);
      position: relative;
      animation: fadeIn 0.3s ease;
    }
    .modal__header {
      display: flex; justify-content: flex-end;
    }
    .modal__close-button {
      background: transparent;
      border: none;
      color: #9ca3af;
      cursor: pointer;
    }
    .modal__button {
      background: #4f46e5;
      color: white;
      border: none;
      padding: 0.7rem 1.5rem;
      border-radius: 0.5rem;
      cursor: pointer;
      transition: background 0.2s;
    }
    .modal__button:hover {
      background: #6366f1;
    }
    .modal__progress-bar {
      height: 8px;
      width: 100%;
      background: #374151;
      border-radius: 8px;
      overflow: hidden;
    }
    .modal__progress-fill {
      height: 8px;
      background: #4f46e5;
      transform: translateX(-100%);
      transition: transform 0.2s linear;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 text-white flex items-center justify-center p-6">

  <div class="w-full max-w-3xl bg-gray-800/60 backdrop-blur-md border border-gray-700 rounded-2xl shadow-2xl p-8">
    <h2 class="text-2xl font-semibold mb-6">Editar Perfil</h2>

    <form action="salvar_perfil.php" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <div>
        <label class="block text-sm text-gray-400 mb-1">Nome completo</label>
        <input type="text" name="nome" class="w-full bg-gray-900/80 border border-gray-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none" required>
      </div>

      <div>
        <label class="block text-sm text-gray-400 mb-1">CPF</label>
        <input type="text" name="cpf" maxlength="14" class="w-full bg-gray-900/80 border border-gray-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none" required>
      </div>

      <div>
        <label class="block text-sm text-gray-400 mb-1">Telefone</label>
        <input type="text" name="telefone" maxlength="20" class="w-full bg-gray-900/80 border border-gray-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
      </div>

      <div>
        <label class="block text-sm text-gray-400 mb-1">Data de nascimento</label>
        <input type="date" name="data_nascimento" class="w-full bg-gray-900/80 border border-gray-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none" required>
      </div>

      <div>
        <label class="block text-sm text-gray-400 mb-1">Número de matrícula</label>
        <input type="text" name="numero_matricula" class="w-full bg-gray-900/80 border border-gray-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none" required>
      </div>

      <div>
        <label class="block text-sm text-gray-400 mb-1">Email</label>
        <input type="email" name="email" class="w-full bg-gray-900/80 border border-gray-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none" required>
      </div>

      <div>
        <label class="block text-sm text-gray-400 mb-1">Senha</label>
        <input type="password" name="senha" class="w-full bg-gray-900/80 border border-gray-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none" required>
      </div>

      <!-- Botão de Upload animado -->
      <div class="col-span-1 md:col-span-2 flex flex-col gap-3">
        <label class="block text-sm text-gray-400 mb-1">Foto de perfil</label>
        <button type="button" onclick="openUploadModal()" class="bg-indigo-600 hover:bg-indigo-700 transition-colors text-white font-semibold py-3 px-6 rounded-xl shadow-lg w-fit">
          Enviar foto
        </button>
        <input id="foto_perfil" type="file" name="foto_perfil" hidden accept="image/*">
      </div>

      <div class="col-span-1 md:col-span-2 mt-6 flex justify-end">
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 transition-colors text-white font-semibold py-3 px-8 rounded-xl shadow-lg">
          Salvar alterações
        </button>
      </div>
    </form>
  </div>

  <!-- MODAL DE UPLOAD -->
  <div id="upload" class="modal" data-state="0" data-ready="false">
    <div class="modal__body">
      <div class="modal__header">
        <button class="modal__close-button" onclick="closeUploadModal()">✕</button>
      </div>
      <div class="text-center space-y-4">
        <h2 class="text-xl font-semibold">Enviar Foto de Perfil</h2>
        <p class="text-gray-400">Selecione uma imagem do seu dispositivo.</p>
        <div>
          <button class="modal__button" onclick="selectFile()">Escolher arquivo</button>
        </div>
        <div class="modal__progress-bar mt-4">
          <div class="modal__progress-fill" id="progressFill"></div>
        </div>
        <p id="progressValue" class="text-sm text-gray-400">0%</p>
      </div>
    </div>
  </div>

  <script>
    const modal = document.getElementById("upload");
    const fileInput = document.getElementById("foto_perfil");
    const progressFill = document.getElementById("progressFill");
    const progressValue = document.getElementById("progressValue");

    function openUploadModal() {
      modal.style.display = "flex";
    }

    function closeUploadModal() {
      modal.style.display = "none";
    }

    function selectFile() {
      fileInput.click();
    }

    fileInput.addEventListener("change", () => {
      const file = fileInput.files[0];
      if (file) simulateUpload();
    });

    function simulateUpload() {
      let progress = 0;
      const interval = setInterval(() => {
        progress += 5;
        progressFill.style.transform = `translateX(${progress - 100}%)`;
        progressValue.textContent = progress + "%";

        if (progress >= 100) {
          clearInterval(interval);
          progressValue.textContent = "Upload concluído!";
          setTimeout(closeUploadModal, 1000);
        }
      }, 80);
    }
  </script>

</body>
</html>
