<?php
require_once __DIR__ . "/../code/funcao.php";
if (isset($_SESSION['tipo']) && $_SESSION['tipo'] != 0) {
  $_SESSION['erro_login'] = "Usuário não permitido!";
  header('Location: dashboard_usuario.php');
  exit;
}
if (isset($_GET['tipo_usuario']) && $_GET['tipo_usuario'] == 0) {
  $liberado = 1;
} else {
  $liberado = 0;
}

?>
<!DOCTYPE html>
<html lang="pt-br" class="bg-gray-900 text-white">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro | Gym Genesis</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="./js/jquery-3.7.1.min.js"></script>
  <script src="./js/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <style type="text/tailwindcss">
    /* Estilos gerais do input */
  .input {
    @apply w-full p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-green-400 mb-3;
  }

  /* Estilos de input ao focar */
  .input:focus {
    @apply focus:ring-2 focus:ring-green-400;
  }

  /* Estilos do grupo de inputs */
  .input-group {
    @apply relative flex items-center w-full;
  }

  /* Estilos do grupo de texto do input */
  .input-group-text {
    @apply flex items-center bg-gray-700 border-gray-600 p-2 rounded-l-md;
  }

  /* Estilos do checkbox dentro do grupo */
  .form-check-input {
    @apply mt-0 bg-gray-700 border-gray-600 rounded-l-md;
    margin-left: 0; /* Remove qualquer margem indesejada */
    margin-right: 0.5rem; /* Adiciona espaçamento entre o checkbox e o label */
    vertical-align: middle; /* Alinha verticalmente o checkbox */
  }

  /* Estilos do label dentro do grupo de texto do input */
  .input-group-text label {
    @apply text-white;
    margin-left: 0.25rem; /* Pequeno espaçamento entre o checkbox e o label */
    vertical-align: middle; /* Alinha verticalmente o texto */
  }

  /* Estilos de texto com cor personalizada */
  .text-neongreen {
    color: #39ff14;
  }

  /* Estilos de fundo com cor personalizada */
  .bg-neongreen {
    background-color: #39ff14;
  }

  .bg-neongreen:hover {
    background-color: #32e313;
  }

  /* Animação de shake */
  @keyframes shake {
    0%, 100% {
      transform: translateX(0);
    }
    25%, 75% {
      transform: translateX(-5px);
    }
    50% {
      transform: translateX(5px);
    }
  }

  .animate-shake {
    animation: shake 0.3s;
  }

  /* Estilos de exibição de etapas */
  .step {
    @apply transition-opacity duration-300 ease-in-out;
  }

  .step.hidden {
    @apply opacity-0 absolute pointer-events-none;
  }

  .step-label.active {
    @apply text-neongreen font-bold;
  }

  /* Margem no elemento mb-3 */
  .mb-3 {
    margin-bottom: 0.75rem;
  }

  /* Estilos adicionais para o formulário de checkbox */
  .form-check .form-check-input {
    float: left;
    margin-left: -1.5em;
  }
</style>




</head>

<body class="flex items-center justify-center min-h-screen px-4">
  <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 w-full max-w-xl relative">
    <h2 class="text-2xl font-bold text-center mb-6">
      Cadastro <span class="text-neongreen">Gym Genesis</span>
    </h2>

    <!-- Barra de progresso -->
    <div class="flex justify-between text-sm mb-6 text-white/60">
      <span class="step-label active" data-step="1">1. Pessoal</span>
      <span class="step-label" data-step="2">2. Endereço</span>
      <span class="step-label" data-step="3">3. Acesso</span>
    </div>

    <!-- Formulário -->
    <form action="" id="multiStepForm" class="space-y-4 relative min-h-[400px]">
      <!-- Etapa 1 -->
      <div class="step" data-step="1">
        <label for="nome">Nome completo</label>
        <input id="nome" type="text" autocomplete="on" class="input error" name="nome"
          placeholder="Digite seu nome completo" />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        <label for="email">Email</label>
        <input id="email" type="email" autocomplete="on" class="input" name="email"
          placeholder="Exemplo: usuario@dominio.com" />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        <label for="cpf">CPF</label>
        <input id="cpf" type="text" autocomplete="on" class="input" placeholder="000.000.000-00" name="cpf"
          maxlength="14" />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        <label for="telefone">Telefone</label>
        <input id="telefone" type="text" autocomplete="on" class="input" placeholder="(00) 00000-0000" name="telefone"
          maxlength="15" />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>


        <label for="data_nascimento">Data Nascimento:</label>
        <input type="date" name="data" id="data" autocomplete="on" class="input">

      </div>

      <!-- Etapa 2 -->
      <div class="step hidden" data-step="2">
        <label>CEP</label>
        <input type="text" id="cep" autocomplete="on" class="input" name="cep" pattern="\d{5}-\d{3}" maxlength="10"
          placeholder="00000-000" required />
        <p class="error-message text-red-500 text-sm mt-1 hidden" id="erro"></p>

        <label>Rua</label>
        <input type="text" id="rua" autocomplete="on" class="input" name="rua" placeholder="Digite a rua" required
          disabled />

        <label for="numero">Número</label>
        <div class="input-group mb-3">
          <!-- Checkbox com o ícone de entrada à esquerda -->

          <div class="input-group-text">
            <input class="form-check-input" type="checkbox" style="border-right: none;" id="sem_numero"
              onclick="toggleNumero()" aria-label="Checkbox for following text input">
            <label for="sem_numero">S/N</label>
          </div>

          <!-- Campo de texto que depende do checkbox -->
          <input type="text" autocomplete="on" class="input flex-1 my-3" id="numero" placeholder="Número da residência"
            aria-label="Text input with checkbox" disabled />
        </div>


        <label>Complemento</label>
        <input type="text" id="complemento" autocomplete="on" class="input" name="complemento"
          placeholder="Ex: Bloco, Apt, etc." required disabled />

        <label>Bairro</label>
        <input type="text" id="bairro" autocomplete="on" class="input" name="bairro" placeholder="Digite o bairro"
          required disabled />

        <label>Cidade</label>
        <input type="text" id="cidade" autocomplete="on" class="input" name="cidade" placeholder="Digite a cidade"
          required />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        <label>Estado</label>
        <input type="text" id="estado" autocomplete="on" class="input" name="estado" placeholder="Digite o estado"
          required />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>
      </div>


      <!-- Etapa 3 -->
      <div class="step hidden" data-step="3">
        <label for="senha">Senha</label>
        <div class="relative">
          <input type="password" class="input pr-10" id="senha" name="senha"
            oninput="verificarForcaSenha('senha')" />
          <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500"
            onclick="toggleSenha('senha', this)">
            <i class="fa-regular fa-eye-slash h-10"></i>
          </button>

          <p id="message" class="text-center text-sm font-medium text-gray-700"></p>

          <div class="w-full h-2 bg-gray-300 rounded-full mb-2">
            <div id="progress" class="h-full rounded-full"></div>
          </div>
        </div>

        <label for="confirmarSenha">Confirmar senha</label>
        <div class="relative">
          <input type="password" class="input pr-10" id="confirmarSenha" name="confirmarSenha"
            oninput="verificarForcaSenha('confirmarSenha')" />
          <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500"
            onclick="toggleSenha('confirmarSenha', this)">
            <i class="fa-regular fa-eye-slash h-10"></i>
          </button>

          <p id="message2" class="text-center text-sm font-medium text-gray-700"></p>

          <div class="w-full h-2 bg-gray-300 rounded-full mb-2">
            <div id="progress2" class="h-full rounded-full"></div>
          </div>
        </div>


        <label>Plano</label>
        <select class="input" id="plano" name="plano">
          <?php
          $idplano = 0;
          $planos = listarPlanos($idplano);
          foreach ($planos as $p) {
            echo "<option value='" . $p['idplano'] . "'>" . $p['tipo'] . "</option>";
          }
          ?>
        </select>

        <label class="inline-flex items-center mt-4 text-gray-300">
          <!-- Checkbox -->
          <input type="checkbox" class="form-checkbox text-green-500 rounded focus:ring-2 focus:ring-green-400 mr-2" />

          <!-- Texto ao lado do checkbox -->
          <span class="text-sm text-white">Aceito os termos e condições</span>
        </label>

      </div>

      <!-- Botões navegação -->
      <div class="flex justify-between pt-4">
        <button type="button" id="prevBtn" class="text-white px-4 py-2 rounded border border-white hover:bg-white/10">
          Voltar
        </button>
        <button type="button" id="nextBtn" class="bg-neongreen text-black font-bold px-6 py-2 rounded">
          Próximo
        </button>
      </div>
    </form>
  </div>
  <script src="./js/2-etapa.js"></script>
</body>

</html>