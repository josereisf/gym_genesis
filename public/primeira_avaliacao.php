<?

require_once __DIR__ . "/php/verificarLogado.php";

$id = $_SESSION['id']; // Simulando um ID de usuário para testes, remova em produção
$nome = $_SESSION['nome']; // Simulando um ID de usuário para testes, remova em produção
$tipo = $_SESSION['email']; // Simulando um ID de usuário para testes, remova em produção
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Boas-Vindas - Gym Genesis</title>
  <script src="./js/jquery-3.7.1.min.js"></script>
  <script src="./js/jquery.validate.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Tailwind custom animation (adicione no seu <style> ou CSS global) -->
  <style>
    @keyframes fade-in-up {
      0% {
        opacity: 0;
        transform: translateY(30px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out both;
    }
  </style>
</head>

<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
  <form id="formulario" method="POST" enctype="multipart/form-data" action="./php/primeira_avaliacao.php" class="w-full max-w-xl bg-gray-800 rounded-2xl p-8 space-y-8 shadow-xl">
    <div class="w-full bg-gray-700 rounded-full h-2 mb-4">
      <div id="barra-progresso" class="bg-indigo-500 h-2 rounded-full transition-all duration-500" style="width: 16.6%;"></div>
    </div>

    <input type="hidden" name="idusuario" value="<?= htmlspecialchars($id) ?>">
    <input type="hidden" name="nome" value="<?= htmlspecialchars($nome) ?>">
    <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipo) ?>">

    <!-- Etapa 1: Saudação -->
    <!-- Etapa 1: Boas-vindas com animação -->
    <div class="etapa text-center animate-fade-in-up">
      <h1 class="text-3xl font-bold mb-4">👋 Olá, <?= $nome ?>!</h1>
      <p class="text-lg mb-6">
        Bem-vindo à <span class="text-indigo-400 font-semibold">Gym Genesis</span>! Vamos configurar seu perfil.
        Para isso, vamos coletar algumas informações suas para personalizar sua experiência e indicar os melhores profissionais, garantindo o seu máximo desempenho.
      </p>
      <div class="text-center mt-6">
        <button type="button" onclick="proximaEtapa()" class="bg-indigo-500 hover:bg-indigo-600 px-6 py-2 rounded-full">Continuar</button>
      </div>

    </div>

    <!-- Etapa 2: Peso e Altura -->
    <div class="etapa hidden">
      <h2 class="text-2xl font-semibold mb-4">📏 Seu corpo hoje</h2>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block mb-2">Peso (kg)</label>
          <input name="peso" type="number" step="0.1" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                  <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        </div>
        <div>
          <label class="block mb-2">Altura (cm)</label>
          <input name="altura" type="number" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                  <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        </div>
        <div>
          <label class="block mb-2">Percentual de Gordura</label>
          <input name="percentual_gordura" type="number" step="0.1" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                  <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        </div>
      </div>
      <div class="text-center mt-6">
        <div class="text-center mt-6">
          <button type="button" onclick="etapaAnterior()" class="bg-gray-600 hover:bg-gray-700 px-6 py-2 rounded-full mr-2">Voltar</button>
          <button type="button" onclick="proximaEtapa()" class="bg-indigo-500 hover:bg-indigo-600 px-6 py-2 rounded-full">Continuar</button>
        </div>
      </div>
    </div>

    <!-- Etapa 3: Objetivo -->
    <div class="etapa hidden text-center">
      <h2 class="text-2xl font-semibold mb-6">🎯 Seu objetivo</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

        <!-- Ganhar Massa Muscular -->
        <label class="cursor-pointer relative">
          <input type="checkbox" name="objetivo[]" value="ganho_massa" class="peer hidden">
          <div class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105 
                  peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105">
            <div class="text-xl">💪 Ganhar Massa</div>
          </div>
        </label>

        <!-- Perder Peso -->
        <label class="cursor-pointer relative">
          <input type="checkbox" name="objetivo[]" value="perda_peso" class="peer hidden">
          <div class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105 
                  peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105">
            <div class="text-xl">⚖️ Perder Peso</div>
          </div>
        </label>

        <!-- Manter Forma -->
        <label class="cursor-pointer relative">
          <input type="checkbox" name="objetivo[]" value="manter_condicao" class="peer hidden">
          <div class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105 
                  peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105">
            <div class="text-xl">🛡️ Manter Forma</div>
          </div>
        </label>

        <!-- Ganhar Energia -->
        <label class="cursor-pointer relative">
          <input type="checkbox" name="objetivo[]" value="ganhar_energia" class="peer hidden">
          <div class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105 
                  peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105">
            <div class="text-xl">⚡ Ganhar Energia</div>
          </div>
        </label>

        <!-- Reabilitação -->
        <label class="cursor-pointer relative">
          <input type="checkbox" name="objetivo[]" value="reabilitacao" class="peer hidden">
          <div class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105 
                  peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105">
            <div class="text-xl">🩺 Reabilitação Física</div>
          </div>
        </label>

        <!-- Melhorar Saúde Mental -->
        <label class="cursor-pointer relative">
          <input type="checkbox" name="objetivo[]" value="saude_mental" class="peer hidden">
          <div class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105 
                  peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105">
            <div class="text-xl">🧠 Saúde Mental</div>
          </div>
        </label>
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

      </div>

      <!-- Botão Continuar -->
      <div class="mt-6 hidden" id="btn-continuar">
        <div class="text-center mt-6">
          <button type="button" onclick="etapaAnterior()" class="bg-gray-600 hover:bg-gray-700 px-6 py-2 rounded-full mr-2">Voltar</button>
          <button type="button" onclick="proximaEtapa()" class="bg-indigo-500 hover:bg-indigo-600 px-6 py-2 rounded-full">Continuar</button>
        </div>

      </div>
    </div>

    <!-- Etapa 4: Meta -->
    <div class="etapa hidden">
      <h2 class="text-2xl font-semibold mb-4">🏁 Sua meta</h2>
      <p class="mb-4">Qual a sua meta de peso ou ganho muscular?</p>
      <input name="meta" type="text" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
      <div class="text-center mt-6">        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        <button type="button" onclick="proximaEtapa()" class="bg-indigo-500 hover:bg-indigo-600 px-6 py-2 rounded-full">Continuar</button>
      </div>
    </div>

    <!-- Etapa: Dias de Treino com peer/checked -->
    <div class="etapa hidden text-center animate-fade-in-up">
      <h2 class="text-2xl font-semibold mb-4">📅 Quando você costuma treinar?</h2>
      <p class="mb-6 text-gray-300">Selecione os dias da semana em que costuma treinar:</p>

      <div class="grid grid-cols-3 sm:grid-cols-4 gap-4 max-w-xl mx-auto">
        <!-- Modelo de dia -->
        <label class="cursor-pointer">
          <input type="checkbox" name="dias_semana[]" value="Segunda" class="peer hidden">
          <div
            class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105
               peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105
               text-lg font-medium select-none">
            Seg
          </div>
        </label>

        <label class="cursor-pointer">
          <input type="checkbox" name="dias_semana[]" value="Terca" class="peer hidden">
          <div
            class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105
               peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105
               text-lg font-medium select-none">
            Ter
          </div>
        </label>

        <label class="cursor-pointer">
          <input type="checkbox" name="dias_semana[]" value="Quarta" class="peer hidden">
          <div
            class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105
               peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105
               text-lg font-medium select-none">
            Qua
          </div>
        </label>

        <label class="cursor-pointer">
          <input type="checkbox" name="dias_semana[]" value="Quinta" class="peer hidden">
          <div
            class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105
               peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105
               text-lg font-medium select-none">
            Qui
          </div>
        </label>

        <label class="cursor-pointer">
          <input type="checkbox" name="dias_semana[]" value="Sexta" class="peer hidden">
          <div
            class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105
               peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105
               text-lg font-medium select-none">
            Sex
          </div>
        </label>

        <label class="cursor-pointer">
          <input type="checkbox" name="dias_semana[]" value="Sabado" class="peer hidden">
          <div
            class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105
               peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105
               text-lg font-medium select-none">
            Sáb
          </div>
        </label>

        <label class="cursor-pointer col-span-3 sm:col-span-1">
          <input type="checkbox" name="dias_semana[]" value="Domingo" class="peer hidden">
          <div
            class="bg-gray-700 hover:bg-gray-600 p-6 rounded-2xl transition-all duration-200 transform hover:scale-105
               peer-checked:bg-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-400 peer-checked:scale-105
               text-lg font-medium select-none">
            Dom
          </div>
        </label>
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

      </div>
      <!-- Botão continuar -->
      <div class="mt-6">
        <div class="text-center mt-6">
          <button type="button" onclick="etapaAnterior()" class="bg-gray-600 hover:bg-gray-700 px-6 py-2 rounded-full mr-2">Voltar</button>
          <button type="button" onclick="proximaEtapa()" class="bg-indigo-500 hover:bg-indigo-600 px-6 py-2 rounded-full">Continuar</button>
        </div>

      </div>
    </div>

    <!-- Estilo opcional para animação -->
    <style>
      @keyframes fade-in-up {
        from {
          opacity: 0;
          transform: translateY(20px);
        }

        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out both;
      }
    </style>

    <!-- Etapa 6: Preferência de horário -->
    <div class="etapa hidden">
      <h2 class="text-2xl font-semibold mb-4">⏰ Melhor horário para treinar</h2>
      <select name="horario_preferido" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
        <option value="manha">Manhã</option>
        <option value="tarde">Tarde</option>
        <option value="noite">Noite</option>
      </select>
              <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

      <div class="text-center mt-6">
        <div class="text-center mt-6">
          <button type="button" onclick="etapaAnterior()" class="bg-gray-600 hover:bg-gray-700 px-6 py-2 rounded-full mr-2">Voltar</button>
          <button type="button" onclick="proximaEtapa()" class="bg-indigo-500 hover:bg-indigo-600 px-6 py-2 rounded-full">Continuar</button>
        </div>
      </div>
    </div>

    <!-- Etapa 7: Tirar Foto -->
    <div class="etapa hidden" id="etapa-foto">
      <h2 class="text-2xl font-semibold mb-4">📸 Tire uma foto do aluno</h2>
      <p class="mb-4 text-gray-300">Essa foto será usada para identificar o aluno nos registros.</p>

      <video id="preview" autoplay class="w-full aspect-video rounded-md border border-gray-600"></video>

      <button
        type="button"
        onclick="tirarFoto()"
        class="w-full mt-4 bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-semibold transition">
        <i class="fas fa-camera mr-2"></i>Tirar Foto
      </button>

      <div id="previewFoto" class="hidden mt-4">
        <p class="text-sm text-gray-400 mb-2">📷 Foto capturada:</p>
        <img id="imgPreview" class="rounded-md border border-gray-600 shadow w-full" />
      </div>

      <canvas id="canvas" class="hidden"></canvas>

      <!-- Input file escondido para guardar a imagem capturada -->
      <input type="file" id="foto_input" name="foto" accept="image/png, image/jpeg" class="hidden" />

      <div class="text-center mt-6">
        <div class="text-center mt-6">
          <button type="button" onclick="etapaAnterior()" class="bg-gray-600 hover:bg-gray-700 px-6 py-2 rounded-full mr-2">Voltar</button>
          <button type="button" onclick="proximaEtapa()" class="bg-indigo-500 hover:bg-indigo-600 px-6 py-2 rounded-full">Continuar</button>
        </div>

      </div>
    </div>

    <!-- Etapa 8: Conclusão -->
    <div class="etapa hidden text-center">
      <h2 class="text-2xl font-bold mb-4">🚀 Pronto para começar!</h2>
      <p class="mb-6">Seu painel está pronto com base no que você nos contou.</p>
      <input type="submit" value="Ir para meu Dashboard" class="bg-green-500 hover:bg-green-600 px-8 py-3 rounded-full font-semibold">
    </div>

  </form>
<script src="./js/primeira_avaliacao.js" defer></script>

</body>

</html>