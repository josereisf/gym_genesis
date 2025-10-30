    function atualizar_total() {
            let total = 0;

            $('span.total_unitario').each(function() {
                const valor = parseFloat($(this).text());
                total += valor;
            });

            $('#total').text(total);
        }

        function somar() {
            const linha = $(this).closest('tr');
            const preco_unitario = linha.find('span.preco_venda').text();
            const quantidade = $(this).val();
            const id = $(this).data('id');

            console.log("id é:", id);

            const total = parseFloat(preco_unitario) * parseInt(quantidade);

            const total_unitario = linha.find('span.total_unitario');
            total_unitario.text(total);

            /* Atualizar o valor total da compra */
            atualizar_total();

            /* Enviar requição para atualiza_carrinho.php para modificar sessão  */
            console.log("atualizando...");

            const dados_enviados = new URLSearchParams();
            dados_enviados.append('id', id);
            dados_enviados.append('quantidade', quantidade);

            console.log("dados:", dados_enviados);

            fetch('atualiza_carrinho.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: dados_enviados.toString()
                })
                .then(response => response.text())
                .catch(error => console.log('Houve erro:', error));
        }
        $("input[type='number']").change(somar);