<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Meta - Gym Genesis</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center p-6">
  <div class="bg-gray-800 rounded-2xl shadow-lg w-full max-w-2xl p-8">
    <h1 class="text-3xl font-bold text-center mb-2">🏁 Defina sua Meta</h1>
    <p class="text-center text-gray-400 mb-6">Preencha as informações abaixo para registrar sua meta.</p>

    <form action="salvar_meta.php" method="POST" class="space-y-6">
      <!-- Descrição -->
      <div>
        <label for="descricao" class="block mb-1 font-medium">Descrição da Meta</label>
        <textarea id="descricao" name="descricao" required
          class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-400"
          placeholder="Ex: Ganhar 5kg de massa magra"></textarea>
      </div>

      <!-- Data de Início e Data Limite lado a lado -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="data_inicio" class="block mb-1 font-medium">Data de Início</label>
          <input type="date" id="data_inicio" name="data_inicio" required
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>
        <div>
          <label for="data_limite" class="block mb-1 font-medium">Data Limite</label>
          <input type="date" id="data_limite" name="data_limite"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>
      </div>

      <!-- Status -->
      <div>
        <label for="status" class="block mb-1 font-medium">Status</label>
        <select id="status" name="status"
          class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-400">
          <option value="ativa" selected>Ativa</option>
          <option value="concluída">Concluída</option>
          <option value="cancelada">Cancelada</option>
        </select>
      </div>

      <!-- Botão -->
      <div class="text-center">
        <button type="submit"
          class="bg-green-500 hover:bg-green-600 px-8 py-3 rounded-full text-white font-semibold transition-all duration-200">
          💾 Salvar Meta
        </button>
      </div>
    </form>
  </div>
</body>
</html>
