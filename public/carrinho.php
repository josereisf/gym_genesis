<?php
require_once __DIR__ . "/../code/funcao.php";
require_once __DIR__ . '/./php/verificarLogado.php';
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
    <title>Carrinho - Gym Genesis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/carrinho.js"></script>
</head>

<body class="bg-gray-900 text-gray-100">
    <!-- Header -->
    <header class="bg-gray-800 shadow-md fixed w-full top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="loja.php" class="text-2xl font-bold flex items-center text-blue-400 hover:text-blue-300 transition">
                <i class="fas fa-dumbbell mr-2"></i> Gym<span class="text-purple-400">Gênesis</span>
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

        <?php
        if (empty($_SESSION['carrinho'])) {
            echo '<div class="text-center py-20">';
            echo '  <i class="fas fa-box-open text-6xl text-gray-600 mb-4"></i>';
            echo '  <p class="text-lg text-gray-400">Seu carrinho está vazio.</p>';
            echo '  <a href="loja.php#produtos" class="mt-6 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-600 transition">';
            echo '    <i class="fas fa-store mr-2"></i>Ver Produtos';
            echo '  </a>';
            echo '</div>';
        } else {
            echo '<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">';

            // LISTA DE PRODUTOS
            echo '<div class="lg:col-span-2 space-y-6">';
            $subtotalCompra = 0;

            foreach ($_SESSION['carrinho'] as $id => $quantidade) {
                $resultado = listarProdutos($id);
                $nome  = $resultado[0]['nome'];
                $preco = $resultado[0]['preco'];
                $subtotal = $preco * $quantidade;
                $subtotalFormatado = number_format($subtotal, 2, ',', '.');
                $subtotalCompra += $subtotal;

                echo '<div class="flex items-center bg-gray-800 p-5 rounded-xl shadow-lg hover:shadow-blue-500/30 transition">';
                echo '  <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-purple-500 text-white text-2xl">';
                echo '    <i class="fas"></i>';
                echo '  </div>';

                echo '  <div class="ml-4 flex-1">';
                echo '    <h4 class="text-lg font-semibold text-white">' . htmlspecialchars($nome) . '</h4>';
                echo '    <div class="flex items-center gap-2 mt-1">';
                echo '      <span class="text-yellow-400 font-bold preco_produto" data-preco="' . $preco . '">';
                echo '        R$ ' . number_format($preco, 2, ',', '.') . '';
                echo '      </span>';
                echo '    </div>';

                echo '    <div class="flex items-center mt-3">';
                echo '      <button class="bg-gray-700 px-2 py-1 rounded-l hover:bg-blue-500 btn-minus">';
                echo '        <i class="fas fa-minus"></i>';
                echo '      </button>';
                echo '      <input type="text" name="quantidade[' . $id . ']" value="' . $quantidade . '" data-id="' . $id . '" min="1" class="w-12 text-center border border-gray-600 bg-gray-900 quantidade-input">';
                echo '      <button class="bg-gray-700 px-2 py-1 rounded-r hover:bg-blue-500 btn-plus">';
                echo '        <i class="fas fa-plus"></i>';
                echo '      </button>';
                echo '    </div>';
                echo '  </div>';

                echo '  <div class="text-right">';
                echo '    <p class="font-bold text-yellow-400 subtotal_produto">R$ ' . $subtotalFormatado . '</p>';
                echo '    <button value="' . $id . '" class="remover mt-2 text-red-400 hover:text-red-600 text-sm">';
                echo '      <i class="fas fa-trash mr-1"></i> Remover';
                echo '    </button>';
                echo '  </div>';
                echo '</div>';
            }
            echo '</div>';

            // RESUMO
            echo '<div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-blue-500/30">';
            echo '  <h3 class="text-xl font-bold mb-4 text-white">Resumo da Compra</h3>';

            echo '  <div class="flex justify-between mb-2">';
            echo '    <span>Subtotal</span>';
            echo '    <span class="text-yellow-400 subtotal_compra">';
            echo '      R$ ' . number_format($subtotalCompra, 2, ',', '.') . '';
            echo '    </span>';
            echo '  </div>';

            echo '  <div class="flex items-center gap-2 mb-2">';
            echo '    <input type="checkbox" id="usarDesconto" class="w-4 h-4 accent-blue-500 cursor-pointer">';
            echo '    <label for="usarDesconto" class="text-gray-300 cursor-pointer hover:text-blue-400 transition">';
            echo '      Usar cupom de desconto';
            echo '    </label>';
            echo '  </div>';

            echo '  <div id="campoDesconto" class="hidden mb-2">';
            echo '    <input type="text" id="valorDesconto" placeholder="Digite o valor do desconto" class="w-full px-3 py-2 rounded-lg bg-gray-900 border border-gray-700 text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-400">';
            echo '  </div>';

            echo '  <div class="flex justify-between mb-2">';
            echo '    <span>Frete</span>';
            echo '    <span class="text-green-400">Grátis</span>';
            echo '  </div>';

            echo '  <hr class="my-4 border-gray-600">';

            echo '  <div class="flex justify-between font-bold text-lg">';
            echo '    <span>Total</span>';
            echo '    <span id="totalCompra" class="text-yellow-400 transition-all duration-300 subtotal_compra">';
            echo '      R$ ' . number_format($subtotalCompra, 2, ',', '.') . '';
            echo '    </span>';
            echo '  </div>';

            echo '<button onclick="window.location.href=\'./pagina_pagamento.php\'" class="w-full mt-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-bold hover:scale-105 transition">';
            echo '  <i class="fas fa-credit-card mr-2"></i> Finalizar Compra';
            echo '</button>';
            echo '</div>';

            echo '</div>';
        }
        $_SESSION['compra'] = $subtotalCompra;

        ?>

    </main>
    <script>
        $(document).ready(function() {
            function enviarAtualizacaoSessao(id, quantidade) {
                $.ajax({
                    url: './php/atualizar_sessao_carrinho.php',
                    method: 'POST',
                    data: {
                        id: id,
                        quantidade: quantidade
                    },
                    success: function(res) {
                        // opcional: console.log("Sessão atualizada:", res);
                    },
                    error: function() {
                        console.error("Erro ao atualizar a sessão do carrinho.");
                    }
                });
            }

            // --- Atualiza o subtotal geral (toda a compra) ---
            function atualizarSubtotalGeral() {
                let total = 0;
                $('.subtotal_produto').each(function() {
                    let valor = parseFloat($(this).text().replace('R$', '').replace('.', '').replace(',', '.').trim());
                    total += valor || 0;
                });
                $('.subtotal_compra').text('R$ ' + total.toFixed(2).replace('.', ','));
            }

            // --- Recalcula o subtotal do produto atual ---
            function atualizarSubtotal(botao) {
                let container = botao.closest('.bg-gray-800'); // container principal do produto
                let preco = parseFloat(container.find('.preco_produto').data('preco'));
                let quantidade = parseInt(container.find('.quantidade-input').val()) || 0;
                let subtotal = preco * quantidade;
                container.find('.subtotal_produto').text('R$ ' + subtotal.toFixed(2).replace('.', ','));
                atualizarSubtotalGeral(); // atualiza o total geral
            }

            // Botão "+"
            $('.btn-plus').on('click', function() {
                let input = $(this).siblings('.quantidade-input');
                let valor = parseInt(input.val()) || 0;
                input.val(valor + 1);
                atualizarSubtotal($(this));
                enviarAtualizacaoSessao(input.data('id'), valor + 1);
            });

            // Botão "-"
            $('.btn-minus').on('click', function() {
                let input = $(this).siblings('.quantidade-input');
                let valor = parseInt(input.val()) || 0;
                if (valor > 1) {
                    input.val(valor - 1);
                    atualizarSubtotal($(this));
                    enviarAtualizacaoSessao(input.data('id'), valor - 1);
                }
            });

            // Quando o usuário digita manualmente
            $('.quantidade-input').on('input', function() {
                atualizarSubtotal($(this));
                enviarAtualizacaoSessao($(this).data('id'), $(this).val());
            });


            // --- Atualiza total geral ao carregar ---
            atualizarSubtotalGeral();
        });
        // Mostrar / ocultar campo de desconto
        $('#usarDesconto').on('change', function() {
            $('#campoDesconto').toggleClass('hidden', !this.checked);
            if (!this.checked) {
                $('#valorDesconto').val('');
                atualizarTotalGeral(); // volta ao total normal
            }
        });

        // Quando digitar o código do cupom
        $('#valorDesconto').on('blur', function() {
            let codigo = $(this).val().trim();
            if (codigo === '') return;

            // Faz requisição AJAX para validar o cupom
            $.ajax({
                url: './php/validar_codigo.php', // cria esse arquivo no PHP
                type: 'POST',
                data: {
                    codigo: codigo
                },
                dataType: 'json',
                success: function(res) {
                    if (res.valido) {
                        let totalAtual = 0;

                        $('.subtotal_produto').each(function() {
                            let valorTexto = $(this).text().replace('R$', '').replace('.', '').replace(',', '.').trim();
                            totalAtual += parseFloat(valorTexto) || 0;
                        });

                        let totalComDesconto = totalAtual;

                        if (res.tipo === 'percentual') {
                            totalComDesconto -= (totalAtual * (res.valor / 100));
                        } else if (res.tipo === 'fixo') {
                            totalComDesconto -= res.valor;
                        }

                        if (totalComDesconto < 0) totalComDesconto = 0;

                        $('#totalCompra').text('R$ ' + totalComDesconto.toFixed(2).replace('.', ','))
                            .addClass('text-green-400');

                        setTimeout(() => $('#totalCompra').removeClass('text-green-400'), 600);
                    } else {
                        alert('Cupom inválido ou expirado!');
                        $('#valorDesconto').val('');
                        atualizarTotalGeral();
                    }
                }
            });
        });
    </script>

</body>

</html>