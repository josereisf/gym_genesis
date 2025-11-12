<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Teste API - Editar Usuário</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md">
    <h1 class="text-2xl font-bold text-center mb-4 text-gray-700">
      🧪 Teste de Requisição API
    </h1>

    <form id="apiForm" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Entidade:</label>
        <input
          type="text"
          id="entidade"
          name="entidade"
          placeholder="Ex: usuario"
          class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
          required />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Dados (JSON):</label>
        <textarea
          id="dados"
          name="dados"
          placeholder='Ex: {"id": 1, "nome": "Teste"}'
          class="mt-1 w-full p-2 border rounded-lg h-24 focus:ring-2 focus:ring-blue-500"
          required></textarea>
      </div>

      <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
        Enviar Requisição
      </button>
    </form>

    <div id="resultado" class="mt-6 bg-gray-50 p-4 rounded-lg text-sm text-gray-800 overflow-x-auto"></div>
  </div>

  <script>
    document.getElementById("apiForm").addEventListener("submit", async (e) => {
      e.preventDefault();

      const entidade = document.getElementById("entidade").value.trim();
      const dados = document.getElementById("dados").value.trim();
      const resultadoDiv = document.getElementById("resultado");

      resultadoDiv.innerHTML = "<p class='text-gray-500'>⏳ Enviando...</p>";

      try {
        const response = await fetch(
          `http://localhost:83/public/api/index.php?entidade=${encodeURIComponent(
            entidade
          )}&acao=editar`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: dados,
          }
        );

        const text = await response.text();
        resultadoDiv.innerHTML = `<pre class="text-green-700">${text}</pre>`;
      } catch (error) {
        resultadoDiv.innerHTML = `<p class="text-red-600">❌ Erro: ${error.message}</p>`;
      }
    });
  </script>
</body>

</html>