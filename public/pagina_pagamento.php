<?php
require_once __DIR__ . "/./php/verificarLogado.php";
// Gerar código PIX
function gerarCodigoPix($tamanho = 32)
{
  $caracteres = array_merge(range('a', 'z'), range('0', '9'));
  $codigo = '';
  for ($i = 0; $i < $tamanho; $i++) {
    $codigo .= $caracteres[array_rand($caracteres)];
  }
  return $codigo;
}
print_r($_SESSION);

$idusuario = $_SESSION['id'];
$preco = $_SESSION['compra'];
$codigoPix = gerarCodigoPix();

$qrcodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=$codigoPix&size=200x200";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pagamento - Gym Genesis</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-black to-gray-800 text-gray-300 snap-y snap-mandatory overflow-y-scroll h-screen">

  <div class="max-w-3xl mx-auto p-8">
    <div class="bg-gray-900 bg-opacity-80 rounded-2xl shadow-2xl p-8">
      <h2 class="text-3xl font-bold text-center text-gray-100 mb-8">Pagamento - Gym Genesis</h2>

      <form id="pagamentoForm" action="./api/index.php?entidade=processar_pagamento&acao=cadastrar'" method="POST" class="space-y-6">

        <!-- Valor -->
        <div>
          <label class="block text-sm font-semibold text-gray-300 mb-1">Valor (R$)</label>
        <input  value="<?= number_format($preco, 2, '.', ''); ?>"
                type="number"
                name="valor"
                step="0.01"
                min="0.01"
                required
                disabled
                oninvalid="this.setCustomValidity('Digite um valor maior que R$ 0,00')"
                oninput="this.setCustomValidity('')"            
                class="w-full p-3 bg-gray-800 text-gray-100 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none" />
        </div>

        <!-- Tipo de Pagamento -->
        <div>
          <label class="block text-sm font-semibold text-gray-300 mb-1">Forma de Pagamento</label>
          <select name="tipo" id="tipo" required onchange="mostrarCampos()"
            class="w-full p-3 bg-gray-800 text-gray-100 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            <option value="" class="text-gray-500">Selecione</option>
            <option value="cartao">Cartão</option>
            <option value="pix">PIX</option>
            <option value="boleto">Boleto</option>
          </select>
        </div>

        <!-- Cartão -->
        <div id="cartaoFields" class="hidden space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Bandeira do Cartão</label>
            <input type="text" name="bandeira_cartao"
              class="w-full p-3 bg-gray-800 text-gray-100 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Últimos 4 Dígitos</label>
            <input type="text" name="ultimos_digitos" maxlength="4" pattern="\d{4}"
              class="w-full p-3 bg-gray-800 text-gray-100 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none" />
          </div>
        </div>

        <!-- PIX -->
        <div id="pixFields" class="hidden space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Código PIX</label>
            <input type="text" readonly value="<?php echo $codigoPix; ?>" name="codigo_pix"
              class="w-full p-3 bg-gray-700 text-green-400 border border-green-600 rounded-lg font-mono" />
          </div>
          <div class="flex justify-center">
            <img src="<?php echo $qrcodeUrl; ?>" alt="QR Code PIX" class="border border-green-600 rounded-lg shadow-lg">
          </div>
          <p class="text-center text-sm text-green-400">Escaneie o QR Code com seu app bancário para pagar</p>
        </div>

        <!-- Boleto -->
        <div id="boletoFields" class="hidden">
          <label class="block text-sm font-medium text-gray-300 mb-1">Linha Digitável do Boleto</label>
          <input type="text" name="linha_digitavel_boleto"
            class="w-full p-3 bg-gray-800 text-gray-100 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none" />
        </div>

        <!-- Botão -->
        <div class="text-center pt-4">
          <input type="submit"
            class="bg-blue-700 hover:bg-blue-800 text-white text-lg font-semibold px-8 py-3 rounded-xl transition duration-300 shadow-md">
            Confirmar Pagamento
          </input>
        </div>
      </form>

      <!-- Instruções -->
      <div id="instrucoes" class="mt-10 hidden">
        <h3 class="text-xl font-bold mb-3 text-gray-100">Como realizar o pagamento:</h3>
        <div id="instrCartao" class="hidden text-gray-300 space-y-2">
          <p>1. Escolha a forma de pagamento "Cartão".</p>
          <p>2. Preencha a bandeira e os 4 últimos dígitos do cartão.</p>
          <p>3. Clique em "Confirmar Pagamento" para processar.</p>
          <p>4. Aguarde a confirmação na tela.</p>
        </div>
        <div id="instrPix" class="hidden text-green-400 space-y-2">
          <p>1. Escolha a forma de pagamento "PIX".</p>
          <p>2. Copie o código gerado ou escaneie o QR Code com seu banco.</p>
          <p>3. Efetue o pagamento no aplicativo do banco.</p>
          <p>4. Após o pagamento, clique em "Confirmar Pagamento".</p>
        </div>
        <div id="instrBoleto" class="hidden text-gray-300 space-y-2">
          <p>1. Escolha a forma de pagamento "Boleto".</p>
          <p>2. Informe a linha digitável do boleto gerado.</p>
          <p>3. Clique em "Confirmar Pagamento".</p>
          <p>4. O pagamento será processado em até 3 dias úteis.</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    function mostrarCampos() {
      const tipo = document.getElementById("tipo").value;

      document.getElementById("cartaoFields").style.display = "none";
      document.getElementById("pixFields").style.display = "none";
      document.getElementById("boletoFields").style.display = "none";
      document.getElementById("instrucoes").style.display = "block";

      document.getElementById("instrCartao").style.display = "none";
      document.getElementById("instrPix").style.display = "none";
      document.getElementById("instrBoleto").style.display = "none";

      if (tipo === "cartao") {
        document.getElementById("cartaoFields").style.display = "block";
        document.getElementById("instrCartao").style.display = "block";
      } else if (tipo === "pix") {
        document.getElementById("pixFields").style.display = "block";
        document.getElementById("instrPix").style.display = "block";
      } else if (tipo === "boleto") {
        document.getElementById("boletoFields").style.display = "block";
        document.getElementById("instrBoleto").style.display = "block";
      } else {
        document.getElementById("instrucoes").style.display = "none";
      }
    }
    document.getElementById("pagamentoForm").addEventListener("submit", function(e) {
      const valor = parseFloat(document.querySelector('input[name="valor"]').value);
      if (isNaN(valor) || valor <= 0) {
        alert("Por favor, digite um valor maior que R$ 0,00.");
        e.preventDefault();
      }
    });
  </script>

</body>

</html>