<?php
require_once __DIR__ . "/../code/funcao.php";

$email = $_GET['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trocar Senha</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <!-- Modal do código -->
  <div id="modalCodigo" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-8 max-w-md w-full text-center shadow-lg">
      <h2 class="text-2xl font-bold text-purple-700 mb-4">Verificação de Código</h2>
      <p class="mb-6 text-gray-700">Digite o código de 6 dígitos enviado para seu e-mail:</p>
      <div class="flex justify-center mb-6 space-x-2" id="codigoInputs">
        <input type="text" maxlength="1" class="codigo border rounded w-12 h-12 text-center text-xl focus:outline-none focus:ring-2 focus:ring-purple-500" />
        <input type="text" maxlength="1" class="codigo border rounded w-12 h-12 text-center text-xl focus:outline-none focus:ring-2 focus:ring-purple-500" />
        <input type="text" maxlength="1" class="codigo border rounded w-12 h-12 text-center text-xl focus:outline-none focus:ring-2 focus:ring-purple-500" />
        <input type="text" maxlength="1" class="codigo border rounded w-12 h-12 text-center text-xl focus:outline-none focus:ring-2 focus:ring-purple-500" />
        <input type="text" maxlength="1" class="codigo border rounded w-12 h-12 text-center text-xl focus:outline-none focus:ring-2 focus:ring-purple-500" />
        <input type="text" maxlength="1" class="codigo border rounded w-12 h-12 text-center text-xl focus:outline-none focus:ring-2 focus:ring-purple-500" />
      </div>
      <button id="verificarCodigo" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">Verificar Código</button>
      <div id="mensagemModal" class="mt-4 text-sm font-medium"></div>
    </div>
  </div>

  <!-- Formulário para nova senha -->
  <div id="formNovaSenha" class="hidden bg-white rounded-xl p-8 max-w-md w-full shadow-lg">
    <h2 class="text-2xl font-bold text-purple-700 mb-4 text-center">Nova Senha</h2>
    <input type="password" id="novaSenha" placeholder="Nova senha" class="border rounded w-full p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
    <input type="password" id="confirmaSenha" placeholder="Confirmar nova senha" class="border rounded w-full p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
    <button id="atualizarSenha" class="bg-purple-600 text-white w-full py-3 rounded hover:bg-purple-700 transition">Atualizar Senha</button>
    <div id="mensagemForm" class="mt-4 text-sm font-medium text-center"></div>
  </div>

  <script>
    $(document).ready(function() {
      // Navegação entre inputs do código
      $('.codigo').on('input', function() {
        if (this.value.length === 1) {
          $(this).next('.codigo').focus();
        }
      });

      // Verificação do código
      $('#verificarCodigo').on('click', function() {
        let codigo = '';
        $('.codigo').each(function() {
          codigo += $(this).val();
        });
        if (codigo.length < 6) {
          $('#mensagemModal').removeClass('text-green-600').addClass('text-red-600').text('Digite todos os 6 dígitos');
          return;
        }

        $('#mensagemModal').removeClass('text-red-600').addClass('text-gray-700').text('Verificando...');

        $.ajax({
          url: './php/verificar_codigo.php',
          method: 'POST',
          data: {
            email: '<?php echo $email; ?>',
            codigo: codigo
          },
          dataType: 'json',
          success: function(res) {
            if (res.status === 'sucesso') {
              $('#mensagemModal').removeClass('text-red-600 text-gray-700').addClass('text-green-600').text(res.mensagem);
              $('#modalCodigo').fadeOut();
              $('#formNovaSenha').fadeIn();
            } else {
              $('#mensagemModal').removeClass('text-green-600 text-gray-700').addClass('text-red-600').text(res.mensagem);
            }
          },
          error: function() {
            $('#mensagemModal').removeClass('text-green-600 text-gray-700').addClass('text-red-600').text('Erro ao verificar código.');
          }
        });
      });

      // Atualização da senha
      $('#atualizarSenha').on('click', function() {
        let novaSenha = $('#novaSenha').val();
        let confirmaSenha = $('#confirmaSenha').val();

        if (novaSenha.length < 6) {
          $('#mensagemForm').removeClass('text-green-600').addClass('text-red-600').text('A senha deve ter pelo menos 6 caracteres.');
          return;
        }
        if (novaSenha !== confirmaSenha) {
          $('#mensagemForm').removeClass('text-green-600').addClass('text-red-600').text('As senhas não coincidem.');
          return;
        }

        $('#mensagemForm').removeClass('text-red-600').addClass('text-gray-700').text('Atualizando senha...');

        $.ajax({
          url: '',
          method: 'POST',
          data: {
            email: '<?php echo $email; ?>',
            senha: novaSenha
          },
          dataType: 'json',
          success: function(res) {
            if (res.status === 'sucesso') {
              $('#mensagemForm').removeClass('text-red-600 text-gray-700').addClass('text-green-600').text(res.mensagem);
            } else {
              $('#mensagemForm').removeClass('text-green-600 text-gray-700').addClass('text-red-600').text(res.mensagem);
            }
          },
          error: function() {
            $('#mensagemForm').removeClass('text-green-600 text-gray-700').addClass('text-red-600').text('Erro ao atualizar senha.');
          }
        });
      });
    });
  </script>

</body>

</html>