<?php
require_once "../code/funcao.php";
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
  <style type="text/tailwindcss">

    .input {
        @apply w-full p-2 rounded bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-green-400 mb-3;
      }
      .step {
        @apply transition-opacity duration-300 ease-in-out;
      }
      .step.hidden {
        @apply opacity-0 absolute pointer-events-none;
      }
      .step-label.active {
        @apply text-neongreen font-bold;
      }
      .text-neongreen {
        color: #39ff14;
      }
      .bg-neongreen {
        background-color: #39ff14;
      }
      .bg-neongreen:hover {
        background-color: #32e313;
      }
      @keyframes shake {
        0%,
        100% {
          transform: translateX(0);
        }
        25%,
        75% {
          transform: translateX(-5px);
        }
        50% {
          transform: translateX(5px);
        }
      }

      .animate-shake {
        animation: shake 0.3s;
      }
    </style>

    
</head>

<body class="flex items-center justify-center min-h-screen px-4">
  <div
    class="bg-gray-800 rounded-2xl shadow-2xl p-8 w-full max-w-xl relative">
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
        <?php
        if ($liberado == 1) {
          echo '<label for="">Tipo de Usuário:</label> <br>';
          echo "<select name='tipo_usuario'>";
          echo '<option value="0">Administrador</option>';
          echo '<option value="1">Aluno</option>';
          echo '<option value="2">Professor</option>';
          echo '</select>';
          echo '<br>';
        } else {
          echo '<input type="hidden" name="tipo_usuario" value="1">';
        }
        ?>
        <label for="nome">Nome completo</label>
        <input id="nome" type="text" class="input error" name="nome" />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        <label for="email">Email</label>
        <input id="email" type="email" class="input" name="email" />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        <label for="cpf">CPF</label>
        <input
          id="cpf"
          type="text"
          class="input"
          placeholder="000.000.000-00"
          name="cpf" />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        <label for="telefone">Telefone</label>
        <input
          id="telefone"
          type="text"
          class="input"
          placeholder="(00) 00000-0000"
          name="telefone" />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>


        <label for="data_nascimento">Data Nascimento:</label>
        <input type="date" name="data" id="data" class="input">

      </div>

      <!-- Etapa 2 -->
      <div class="step hidden" data-step="2">
        <label>CEP</label>
        <input type="text" id="cep" class="input" name="cep" />
        <p class="error-message text-red-500 text-sm mt-1 hidden" id="erro"></p>

        <label>Rua</label>
        <input type="text" id="rua" class="input" name="rua" disabled />

        <label for="numero">Número</label>
        <input type="text" id="numero" class="input flex-1" name="numero" disabled />

        <label>Complemento</label>
        <input type="text" id="complemento" class="input" name="complemento" disabled />

        <label>Bairro</label>
        <input type="text" id="bairro" class="input" name="bairro" disabled />

        <label>Cidade</label>
        <input type="text" id="cidade" class="input" name="cidade" />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>

        <label>Estado</label>
        <input type="text" id="estado" class="input" name="estado" />
        <p class="error-message text-red-500 text-sm mt-1 hidden"></p>
      </div>

      <!-- Etapa 3 -->
      <div class="step hidden" data-step="3">
        <label>Senha</label>
        <div class="relative">
          <input type="password" class="input pr-10" id="senha" name="senha" />
          <button
            type="button"
            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500"
            onclick="toggleSenha('senha', this)">
            <i class="fa-regular fa-eye-slash"></i>

          </button>
        </div>

        <label>Confirmar senha</label>
        <div class="relative">
          <input type="password" class="input pr-10" id="confirmarSenha" name="confirmarSenha" />
          <button
            type="button"
            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500"
            onclick="toggleSenha('confirmarSenha', this)">
            <i class="fa-regular fa-eye-slash"></i>

          </button>
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

        <label class="inline-flex items-center mt-2">
          <input type="checkbox" class="mr-2" />
          <span class="text-sm">Aceito os termos e condições</span>
        </label>
      </div>

      <!-- Botões navegação -->
      <div class="flex justify-between pt-4">
        <button
          type="button"
          id="prevBtn"
          class="text-white px-4 py-2 rounded border border-white hover:bg-white/10">
          Voltar
        </button>
        <button
          type="button"
          id="nextBtn"
          class="bg-neongreen text-black font-bold px-6 py-2 rounded">
          Próximo
        </button>
      </div>
    </form>
  </div>
  <script src="./js/2-etapa.js"></script>
</body>

</html>