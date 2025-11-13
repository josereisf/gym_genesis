<?php
// Código PHP no início do arquivo

require_once __DIR__ . '/../code/funcao.php';

$tabela = listarTabelas();
if (isset($_GET['tabela'])) {
    $tabela = $_GET['tabela'];

    // 🔹 Remove tudo que não for letra, número ou sublinhado
    $tabela = preg_replace('/[^a-zA-Z0-9_]/', '', $tabela);

    header('Content-Type: application/json');
    echo json_encode(listarDados($tabela));
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Listar Tabelas</title>
  <script src="./js/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #d0eafc, #f5faff);
            /* nova cor */
            color: #333;
            padding: 40px;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 40px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        th,
        td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #e6e6e6;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-size: 0.9rem;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        tbody tr:hover {
            background-color: #f0f8ff;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fbfd;
        }

        td {
            font-size: 0.95rem;
            color: #333;
            transition: background-color 0.3s ease;
        }

        /* Tooltip nos dados */
        td:hover {
            background-color: #e9f3ff;
        }

        /* Responsivo para telas pequenas */
        @media (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead {
                display: none;
            }

            tbody tr {
                margin-bottom: 20px;
                background: white;
                border: 1px solid #ddd;
                border-radius: 12px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
                padding: 15px;
            }

            td {
                position: relative;
                padding-left: 50%;
                text-align: right;
                border: none;
                border-bottom: 1px solid #eee;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 16px;
                width: 45%;
                font-weight: bold;
                color: #555;
                text-align: left;
            }
        }

        /* Estilo para o select */
        #selectTabelas {
            display: block;
            width: 300px;
            max-width: 90%;
            margin: 0 auto 30px auto;
            padding: 12px 16px;
            font-size: 1rem;
            font-family: inherit;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9fbfd;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        #selectTabelas:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        #selectTabelas option {
            padding: 10px;
            background-color: white;
            color: #333;
        }

              /* .pais {
        display: grid;
        place-items: center;
        height: 100vh;
            } */
        /* Prior to using this loader, please ensure that you have set a background image or background color, as the text is transparent and not designed with a solid color. */
        .loader {
            --ANIMATION-DELAY-MULTIPLIER: 70ms;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;

            overflow: hidden;
        }

        .loader span {
            padding: 0;
            margin: 0;
            letter-spacing: -5rem;
            animation-delay: 0s;
            transform: translateY(4rem);
            animation: hideAndSeek 1s alternate infinite cubic-bezier(0.86, 0, 0.07, 1);
        }

        .loader .l {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 0);
        }

        .loader .o {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 1);
        }

        .loader .a {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 2);
        }

        .loader .d {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 3);
        }

        .loader .ispan {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 4);
        }

        .loader .n {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 5);
        }

        .loader .g {
            animation-delay: calc(var(--ANIMATION-DELAY-MULTIPLIER) * 6);
        }

        .letter {
            width: fit-content;
            height: 3rem;
        }

        .i {
            margin-inline: 5px;
        }

        @keyframes hideAndSeek {
            0% {
                transform: translateY(4rem);
            }

            100% {
                transform: translateY(0rem);
            }
        }

        .resultado-loading {
            height: 50vh;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .loading-spinner {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        color: #3498db;
        padding: 20px;
    }
    .loading-spinner:after {
        content: '...';
        animation: blink 1s infinite;
    }

    @keyframes blink {
        0% { content: '...'; }
        33% { content: '..'; }
        66% { content: '.'; }
    }
    </style>
</head>

<body>

    <h1>Listar dados da Tabela</h1>

    <select id="selectTabelas">
        <option value="">Selecione uma tabela</option>
        <?php foreach ($tabela as $t){
          echo '
          <option value='.$t['Tables_in_gym_genesis'].'">'.$t['Tables_in_gym_genesis'].'</option>';
        }
 ?>
    </select>

    <div id="resultado" style="margin-top:20px;"></div>

    <script>
$(document).ready(function() {
    $('#selectTabelas').on('change', function() {
        const tabelaSelecionada = $(this).val();
        const $resultado = $('#resultado');

        if (tabelaSelecionada) {
            // Exemplo opcional: mostrar um "carregando..."
            $resultado.html('<p>Carregando...</p>');

            $.ajax({
                url: '?tabela=' + tabelaSelecionada,
                method: 'GET',
                dataType: 'text', // Primeiro pegamos como texto para testar o JSON
                success: function(resposta) {
                    try {
                        const dados = JSON.parse(resposta);

                        // Delay opcional — aqui era 4 segundos no seu código, deixei 0 pra imediato
                        setTimeout(() => {
                            $resultado.empty();

                            if (dados.length > 0) {
                                let tabelaHtml = '<table border="1" cellpadding="5" cellspacing="0"><tr>';

                                // Cabeçalho
                                for (let coluna in dados[0]) {
                                    tabelaHtml += `<th>${coluna}</th>`;
                                }
                                tabelaHtml += '</tr>';

                                // Dados
                                dados.forEach(linha => {
                                    tabelaHtml += '<tr>';
                                    for (let coluna in linha) {
                                        tabelaHtml += `<td>${linha[coluna]}</td>`;
                                    }
                                    tabelaHtml += '</tr>';
                                });

                                tabelaHtml += '</table>';
                                $resultado.html(tabelaHtml);
                            } else {
                                $resultado.html('Nenhum dado encontrado.');
                            }
                        }, 0);
                    } catch (e) {
                        console.error('Erro ao analisar JSON:', e);
                        $resultado.html('Erro ao buscar dados: resposta não é um JSON válido.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro:', error);
                    $resultado.html('Erro ao buscar dados: ' + error);
                }
            });
        } else {
            $resultado.empty();
        }
    });
});

</script>

</body>

</html>