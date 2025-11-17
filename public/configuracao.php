<?php
    require_once __DIR__ . "/../code/funcao.php";
    require_once __DIR__ ."/./php/verificarLogado.php";

$lista = listarUsuarioCompleto($_SESSION["id"]);

foreach ($lista as $usuario) {
    $foto = $usuario['foto_perfil'];
    $nome = $usuario['nome_usuario'];
    $email = $usuario['email'];
    $pesoAtual = $usuario['peso'];
    $pesoMeta = $usuario['peso'];
    $objMeta = $usuario['descricao_meta'];
    $notifTreino = true;
}

//  var_dump($lista);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="./css/dashboard_usuario.css">
        <!-- Tailwind CSS (para desenvolvimento rápido; depois, pode trocar pelo output.css) -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Font Montserrat -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

        <!-- Font Awesome (versão free, ícones) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

        <!-- Chart.js (para gráficos) -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Lucide Icons -->
        <script src="https://unpkg.com/lucide@latest"></script>
        <!-- <link rel="stylesheet" href="./css/tailwind-output.css"> -->

        <style>
            .concluido {
                opacity: 0.6;
                /* deixa mais apagado */
            }

            .concluido .descricao {
                text-decoration: line-through;
                /* risca o texto */
                color: #9ca3af;
                /* cinza claro */
            }
        </style>
    </head>

    <body class="bg-gradient-to-b from-gray-900 to-gray-800">

        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside class="w-72 bg-gradient-to-b from-gray-900 to-gray-800 p-6 flex flex-col shadow-xl border-r border-gray-700">
                <div class="flex flex-col items-center mb-8">
                    <img src="./uploads/<?= $foto ?>" alt="Avatar" class="mb-4 w-24 h-24 rounded-full border-4 border-indigo-500">
                    <h2 class="text-xl font-extrabold text-indigo-400">Configurações do Aluno</h2>
                </div>
                <nav class="flex-1 space-y-2">
                    <a href="dashboard_usuario.php" class="block px-4 py-2 rounded-lg text-gray-300 hover:bg-indigo-600 hover:text-white transition">🏠 Voltar ao Painel</a>
                </nav>
            </aside>

            <!-- Conteúdo -->
            <div class="flex-1 p-10 overflow-y-auto">
                <header class="mb-10">
                    <h1 class="text-3xl font-extrabold text-indigo-400">Minhas Configurações</h1>
                    <p class="text-gray-400">Ajuste seu perfil e preferências</p>
                </header>


                <!-- Configuração de Cards -->
                <div class="bg-[#111827] rounded-xl shadow-md p-6 mb-8">
                    <h2 class="text-xl font-semibold text-white mb-4">Configuração de Cards</h2>
                    <p class="text-gray-400 text-sm mb-6">Ative ou desative os cards que você deseja ver no seu painel:</p>

                    <?php

                    // Se o formulário for enviado
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Salva os números dos cards selecionados na sessão
                        $_SESSION['card'] = $_POST['card'] ?? [];
                    }

                    // Exemplo de array de cards
                    $cards = [
                        1 => 'Consumo de Água',
                        2 => 'Calorias Queimadas',
                        3 => 'Peso Atual',
                        4 => 'Plano',
                        5 => 'Fórum',
                        6 => 'Motivação',
                        7 => 'Produtos Disponíveis'
                    ];

                    // Inicializa o array de atributos para exibir o estado atual
                    $atributos = [];
                    foreach ($cards as $numero => $nome) {
                        $checked = (isset($_SESSION['card']) && in_array($numero, $_SESSION['card'])) ? 'checked' : '';
                        $atributos[$numero] = $checked;
                    }
                    ?>

                    <form method="POST" class="space-y-4">

<?php
foreach ($cards as $numero => $nome) {
    echo '<div class="flex items-center justify-between bg-[#1f2937] p-3 rounded-lg hover:bg-[#2d3748] transition">';
    echo '  <span class="text-gray-300">' . htmlspecialchars($nome) . '</span>';
    echo '  <label class="relative inline-flex items-center cursor-pointer">';
    echo '    <input type="checkbox" name="card[]" value="' . $numero . '" class="sr-only peer" ' . $atributos[$numero] . '>';
    echo '    <div class="w-11 h-6 bg-gray-600 rounded-full peer peer-checked:bg-indigo-500 after:content-[\'\'] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>';
    echo '  </label>';
    echo '</div>';
}
?>


                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg mt-4">
                            Salvar Preferências
                        </button>
                    </form>


                </div>


                <!-- Metas do Aluno -->
                <div class="bg-[#111827] rounded-xl shadow-md p-6 mb-8">
                    <h2 class="text-xl font-semibold text-white mb-4">Minhas Metas</h2>
                    <form action="api/salvar_metas.php" method="POST" class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-400 text-sm mb-1">Peso Atual (kg)</label>
                            <input type="number" name="peso_atual" value="<?= $pesoAtual ?>" class="w-full p-3 rounded-md bg-[#1f2937] text-white border border-gray-600">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-1">Peso Meta (kg)</label>
                            <input type="number" name="peso_meta" value="<?= $pesoMeta ?>" class="w-full p-3 rounded-md bg-[#1f2937] text-white border border-gray-600">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-400 text-sm mb-1">Objetivo</label>
                            <select name="objetivo" class="w-full p-3 rounded-md bg-[#1f2937] text-white border border-gray-600">
                                <option <?= $objMeta == "Emagrecimento" ? "selected" : "" ?>>Emagrecimento</option>
                                <option <?= $objMeta == "Hipertrofia" ? "selected" : "" ?>>Hipertrofia</option>
                                <option <?= $objMeta == "Condicionamento" ? "selected" : "" ?>>Condicionamento</option>
                            </select>
                        </div>
                        <button type="submit" class="col-span-2 bg-green-600 hover:bg-green-700 px-6 py-2 rounded-md text-white font-semibold">Salvar Metas</button>
                    </form>
                </div>
<!--  -->

    </body>

    </html>