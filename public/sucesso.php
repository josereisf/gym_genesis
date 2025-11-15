<?php
$tabela = $_GET['tabela'];
header("refresh:2;url=/public/listar.php?tabela=$tabela");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sucesso</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-10 rounded-2xl shadow-xl text-center max-w-md">
        <div class="mx-auto mb-4">
<!-- Ícone Font Awesome -->
<i class="fas fa-circle-check text-green-500 text-6xl mx-auto"></i>

        </div>

        <h2 class="text-2xl font-semibold text-green-600 mb-3">
            Sucesso!
        </h2>

        <p class="text-gray-600">
            Sua operação foi concluída com êxito.
        </p>

        <p class="text-gray-500 text-sm mt-4">
            Redirecionando…
        </p>

        <a 
            href="/public/listar.php?tabela=forum"
            class="block mt-6 text-blue-600 hover:underline text-sm"
        >
            Não foi redirecionado? Clique aqui
        </a>
    </div>

</body>
</html>
