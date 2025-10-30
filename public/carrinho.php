<?php
require_once __DIR__ . "/../code/funcao.php";
session_start();
$carrinho = $_SESSION['carrinho'] ?? [];


function totalCarrinho($carrinho, $quantidade)
{
    $total = 0;
    foreach ($carrinho as $item) {
        $total += $item["preco"] * $quantidade;
    }
    return $total;
}


$subtotalCompra = 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrinho - Loja Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="../jquery-3.7.1.min.js"></script>
</head>

<body class="bg-gray-900 text-gray-100">
    <!-- Header -->
    <header class="bg-gray-800 shadow-md fixed w-full top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="loja.php" class="text-2xl font-bold flex items-center text-blue-400 hover:text-blue-300 transition">
                <i class="fas fa-dumbbell mr-2"></i> Loja<span class="text-purple-400">Fitness</span>
            </a>
            <a href="loja.php#produtos" class="bg-blue-500 px-4 py-2 rounded-lg text-white font-semibold hover:bg-blue-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>Voltar às compras
            </a>
        </div>
    </header>

    <!-- Carrinho -->
    <main class="max-w-7xl mx-auto px-4 py-24">
        <h2 class="text-3xl font-bold mb-8 flex items-center gap-3 text-yellow-400">
            <i class="fas fa-shopping-cart"></i> Meu Carrinho
        </h2>

        <?php if (empty($_SESSION['carrinho'])): ?>
            <div class="text-center py-20">
                <i class="fas fa-box-open text-6xl text-gray-600 mb-4"></i>
                <p class="text-lg text-gray-400">Seu carrinho está vazio.</p>
                <a href="loja.php#produtos" class="mt-6 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-600 transition">
                    <i class="fas fa-store mr-2"></i>Ver Produtos
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- LISTA DE PRODUTOS -->
                <div class="lg:col-span-2 space-y-6">
                    <?php foreach ($_SESSION['carrinho'] as $id => $quantidade):
                        // Recupera os dados do produto
                        $resultado = listarProdutos($id);


                        $nome  = $resultado[0]['nome'];
                        $preco = $resultado[0]['preco'];


                        $subtotal = $preco * $quantidade;
                        $subtotalFormatado = number_format($subtotal, 2, ',', '.'); 
                        $subtotalCompra += $subtotal;
                    ?>
                        <div class="flex items-center bg-gray-800 p-5 rounded-xl shadow-lg hover:shadow-blue-500/30 transition">
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-purple-500 text-white text-2xl">
                                <i class="fas"></i>
                            </div>
                            <div class="ml-4 flex-1">
                                <h4 class="text-lg font-semibold text-white"><?= $nome ?></h4>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-yellow-400 font-bold preco_produto">R$ <?= $preco ?></span>
                                    <button class="ml-2 text-sm text-blue-400 hover:underline">Editar preço</button>
                                </div>
                                <div class="flex items-center mt-3">
                                    <button class="bg-gray-700 px-2 py-1 rounded-l hover:bg-blue-500"><i class="fas fa-minus"></i></button>
                                    <input type="text" name="quantidade[<?= $id ?>]" value="<?= $quantidade ?>" data-id='<?= $id ?>' min='1' class="w-12 text-center border border-gray-600 bg-gray-900">
                                    <button class="bg-gray-700 px-2 py-1 rounded-r hover:bg-blue-500"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-yellow-400 subtotal_produto">R$ <?= $subtotal ?></p>
                                <button class="mt-2 text-red-400 hover:text-red-600 text-sm">
                                    <i class="fas fa-trash mr-1"></i> Remover
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- RESUMO -->
                <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-blue-500/30">
                    <h3 class="text-xl font-bold mb-4 text-white">Resumo da Compra</h3>

                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span class="text-yellow-400 subtotal_compra">R$ <?= $subtotalCompra ?></span>
                    </div>

                    <div class="flex items-center gap-2 mb-2">
                        <input type="checkbox" id="usarDesconto" class="w-4 h-4 accent-blue-500 cursor-pointer">
                        <label for="usarDesconto" class="text-gray-300 cursor-pointer hover:text-blue-400 transition">
                            Usar cupom de desconto
                        </label>
                    </div>

                    <div id="campoDesconto" class="hidden mb-2">
                        <input
                            type="text"
                            id="valorDesconto"
                            placeholder="Digite o valor do desconto"
                            class="w-full px-3 py-2 rounded-lg bg-gray-900 border border-gray-700 text-white 
                                   focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div class="flex justify-between mb-2">
                        <span>Frete</span>
                        <span class="text-green-400">Grátis</span>
                    </div>

                    <hr class="my-4 border-gray-600">

                    <div class="flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span id="totalCompra" class="text-yellow-400 transition-all duration-300 tota_compra">R$ <?= $subtotalCompra ?></span>
                    </div>

                    <button class="w-full mt-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-bold hover:scale-105 transition">
                        <i class="fas fa-credit-card mr-2"></i> Finalizar Compra
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <script>
        const checkbox = document.getElementById('usarDesconto');
        const campo = document.getElementById('campoDesconto');
        const inputDesconto = document.getElementById('valorDesconto');
        const totalEl = document.getElementById('totalCompra');
        let subtotal = <?= $subtotal ?>; // valor bruto, número

        checkbox.addEventListener('change', () => {
            campo.classList.toggle('hidden', !checkbox.checked);
            if (!checkbox.checked) {
                inputDesconto.value = '';
                totalEl.textContent = 'R$ ' + subtotal.toFixed(2).replace('.', ',');
            }
        });

        inputDesconto.addEventListener('input', () => {
            let desconto = parseFloat(inputDesconto.value.replace(',', '.')) || 0;
            let total = subtotal - desconto;
            if (total < 0) total = 0;

            totalEl.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
            totalEl.classList.add('text-green-400');
            setTimeout(() => totalEl.classList.remove('text-green-400'), 600);
        });
    </script>
</body>

</html>