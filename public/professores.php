<?php
require_once __DIR__ . "/../code/funcao.php";
require_once __DIR__ . '/./php/verificarLogado.php';
session_start();
$usuario = $_SESSION['id'];
if (isset($_GET['tipo']) and $GET['tipo'] = 0) {
    $tipo = 0;
} else {
    $tipo = 1;
}

$professores = listarPerfilProfessor(null);
// var_dump($professores);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de professor</title>
    <script src="./js/loader.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuração customizada do Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: "#0a0a0a",
                        darkblue: "#0d1b2a",
                        neonred: "#ff2e63",
                        neongreen: "#39ff14",
                        darkgray: "#1a1a1a",
                    },
                    fontFamily: {
                        montserrat: ["Montserrat", "sans-serif"],
                    },
                },
            },
        };
    </script>

    <!-- CSS do DataTables (CDN) -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"
        onerror="this.onerror=null;this.href='./css/dataTable.css';">

    <!-- jQuery (CDN com fallback local) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        if (typeof jQuery === "undefined") {
            document.write('<script src="./js/jquery-3.7.1.min.js"><\/script>');
        }
    </script>

    <!-- DataTables (CDN com fallback local) -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        if (typeof $.fn.DataTable === "undefined") {
            document.write('<script src="./js/dataTables.min.js"><\/script>');
        }
    </script>

    <!-- CSS do Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- SwiperJS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- DataTables Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Animação para modais */
        .animate-scaleUp {
            animation: scaleUp 0.3s ease;
        }

        @keyframes scaleUp {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* 🎨 Customizações do DataTables */
        .dt-button {
            @apply px-4 py-2 rounded-lg font-semibold transition shadow-md;
            @apply bg-gradient-to-r from-[#22d3ee] to-[#3b82f6] text-white;
            margin-right: 0.5rem !important;
        }

        .dt-button:hover {
            @apply from-[#0ea5e9] to-[#2563eb] scale-105;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            @apply px-3 py-1 rounded-md text-sm font-medium text-gray-200 bg-[#1e293b] border border-[#22d3ee] transition;
            margin: 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-[#22d3ee] text-white border-[#22d3ee];
        }

        .dataTables_wrapper .dataTables_filter input {
            @apply px-3 py-2 rounded-md border border-[#22d3ee] bg-[#0f172a] text-gray-200 focus:outline-none focus:ring-2 focus:ring-[#22d3ee];
        }

        .dataTables_wrapper .dataTables_length select {
            @apply px-2 py-1 rounded-md border border-[#22d3ee] bg-[#0f172a] text-gray-200 focus:outline-none;
        }

        .dataTables_wrapper .dataTables_info {
            @apply text-gray-400 text-sm mt-2;
        }

        span {
            color: white;
        }
    </style>
    <link rel="stylesheet" href="./css/loader.css">

</head>


<body class="bg-gradient-to-br from-[#132237] via-[#1a2f4a] to-[#0d1625] text-[#f1f5f9] font-montserrat min-h-screen">
    <?php require_once __DIR__ . "/./php/loader.php" ?>

    <div class="p-6">
        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-black/60 backdrop-blur-md hidden flex items-center justify-center z-50">
            <div class="bg-[#1e293b] rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative animate-scaleUp border border-[#3b82f6]">

                <!-- Botão fechar -->
                <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-white text-2xl">&times;</button>

                <!-- Conteúdo do modal (dinâmico) -->
                <div id="modalContent"></div>
            </div>
        </div>



        <!-- Tabela -->
        <div class="bg-darkblue p-4 rounded-xl shadow-lg">
            <!-- Wrapper responsivo -->
            <div class="overflow-x-auto w-full">
                <table id="container_tabela" class="min-w-full text-sm text-white border-collapse">
                    <thead class="bg-darkgray text-[#f1f5f9]">
                        <tr>
                            <th class="px-4 py-2 text-left">Ações</th>
                            <th class="px-4 py-2 text-left">Foto de Perfil</th>
                            <th class="px-4 py-2 text-left">Nome</th>
                            <th class="px-4 py-2 text-left">Cargo</th>
                            <th class="px-4 py-2 text-left">Modalidade</th>
                            <th class="px-4 py-2 text-left">Avaliação</th>
                            <th class="px-4 py-2 text-left">Descrição</th>
                            <th class="px-4 py-2 text-left">Telefone</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Data da Aula</th>
                            <th class="px-4 py-2 text-left">Dia da Semana</th>
                            <th class="px-4 py-2 text-left">Horários Disponíveis</th>
                            <th class="px-4 py-2 text-left">Hora Início</th>
                            <th class="px-4 py-2 text-left">Hora Fim</th>
                            <?php if ($tipo == 0) { ?>
                                <th class="px-4 py-2 text-left">Salário</th>
                                <th class="px-4 py-2 text-left">ID Funcionário</th>
                                <th class="px-4 py-2 text-left">ID Aula</th>
                                <th class="px-4 py-2 text-left">ID Treino</th>
                                <th class="px-4 py-2 text-left">Data Atualização</th>
                                <th class="px-4 py-2 text-left">Data Contratação</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-darkgray">
                        <?php
                        foreach ($professores as $p) {
                        ?>
                            <tr class="hover:bg-darkgray/60 transition">
                                <!-- Certifique-se de ter o Font Awesome -->
                                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

                                <td class="px-4 py-2 flex gap-2">
                                    <!-- Botão de Detalhes -->
                                    <button
                                        onclick="openModal(this)"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded shadow-md transition"
                                        title="Ver Detalhes">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <!-- Botão de Selecionar -->
                                    <button
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded shadow-md transition"
                                        data-idprofessor="<?= $p['idaula'] ?>"
                                        title="Selecionar Professor">
                                        <i class="fa-solid fa-user-check"></i>
                                    </button>
                                </td>

                                <td class="px-4 py-2">
                                    <img src="./uploads/<?= $p['foto_perfil'] ?>"
                                        alt="Foto de Perfil"
                                        class="w-12 h-12 rounded-full border-2 border-neongreen object-cover" />
                                </td>
                                <td class="px-4 py-2"><?= $p['nome_professor'] ?></td>
                                <td class="px-4 py-2"><?= $p['cargo_professor'] ?></td>
                                <td class="px-4 py-2"><?= $p['modalidade'] ?></td>
                                <td class="px-4 py-2"><?= $p['avaliacao_media'] ?></td>
                                <td class="px-4 py-2"><?= $p['descricao'] ?></td>
                                <td class="px-4 py-2"><?= formatarTelefone($p['telefone_professor']) ?></td>
                                <td class="px-4 py-2"><?= $p['email_professor'] ?></td>
                                <td class="px-4 py-2"><?= $p['data_aula'] ?></td>
                                <td class="px-4 py-2"><?= $p['dia_semana'] ?></td>
                                <td class="px-4 py-2"><?= $p['horarios_disponiveis'] ?></td>
                                <td class="px-4 py-2"><?= $p['hora_inicio'] ?></td>
                                <td class="px-4 py-2"><?= $p['hora_fim'] ?></td>
                                <?php if ($tipo == 0) { ?>
                                    <td class="px-4 py-2"><?= $p['salario'] ?></td>
                                    <td class="px-4 py-2"><?= $p['funcionario_id'] ?></td>
                                    <td class="px-4 py-2"><?= $p['idaula'] ?></td>
                                    <td class="px-4 py-2"><?= $p['treino_id'] ?></td>
                                    <td class="px-4 py-2"><?= $p['data_atualizacao'] ?></td>
                                    <td class="px-4 py-2"><?= $p['data_contratacao'] ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Inicializando DataTable -->
    <?php if ($tipo == 0) { ?>
        <script>
            $(document).ready(function() {
                $('#container_tabela').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
                    },
                    paging: true, // Paginação ativada
                    pageLength: 10, // Mostra 10 por padrão
                    lengthMenu: [10, 25, 50, 100], // Opções de quantos itens por página
                    searching: true, // Campo de pesquisa
                    info: true, // Mostra "Mostrando X de Y"
                    ordering: true, // Ordenação ativada
                    responsive: true, // Responsivo (se ajustar em telas menores)
                    scrollX: true, // Scroll horizontal para muitas colunas
                    dom: 'Bfrtip', // Layout para incluir botões
                    buttons: [{
                            extend: 'copy',
                            text: 'Copiar'
                        },
                        {
                            extend: 'excel',
                            text: 'Exportar Excel'
                        },
                        {
                            extend: 'pdf',
                            text: 'Exportar PDF'
                        },
                        {
                            extend: 'print',
                            text: 'Imprimir'
                        }
                    ]
                });
            });
        </script>
    <?php } else { ?>

        <script>
            $(document).ready(function() {
                $('#container_tabela').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
                    },
                    paging: true,
                    searching: true,
                    info: true
                });
            });
        </script>

    <?php } ?>
    <!-- Modal -->
    <script>
        // Abrir modal pegando os dados direto da linha da tabela
        function openModal(botao) {
            // Acha a linha <tr> mais próxima do botão clicado
            const row = botao.closest("tr");
            const cells = row.querySelectorAll("td");

            // Pega os valores das colunas (ajuste os índices conforme sua tabela)
            const dados = {
                foto: row.querySelector("img").src,
                nome: cells[2].innerText,
                cargo: cells[3].innerText,
                modalidade: cells[4].innerText,
                avaliacao: cells[5].innerText,
                descricao: cells[6].innerText,
                telefone: cells[7].innerText,
                email: cells[8].innerText,
                dataAula: cells[9].innerText,
                diaSemana: cells[10].innerText,
                horarios: cells[11].innerText,
                horaInicio: cells[12].innerText,
                horaFim: cells[13].innerText,
                salario: cells[14] ? cells[14].innerText : "",
                funcionarioId: cells[15] ? cells[15].innerText : "",
                aulaId: cells[16] ? cells[16].innerText : "",
                treinoId: cells[17] ? cells[17].innerText : "",
                dataAtualizacao: cells[18] ? cells[18].innerText : "",
                dataContratacao: cells[19] ? cells[19].innerText : ""
            };

            // Monta o conteúdo do modal
            const modalContent = `
            <div class="flex items-center gap-4 border-b border-[#3b82f6] pb-4 mb-4">
                <img src="${dados.foto}" alt="Foto"
                    class="w-24 h-24 rounded-full shadow-lg border-2 border-[#a855f7]">
                <div>
                    <h2 class="text-2xl font-bold text-[#22d3ee]">${dados.nome}</h2>
                    <p class="text-gray-300">${dados.cargo}</p>
                    <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold text-dark bg-[#22d3ee] rounded-full">
                        ${dados.modalidade}
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-200">
                <p><span class="font-semibold text-[#22d3ee]">Avaliação:</span> ${dados.avaliacao}</p>
                <p><span class="font-semibold text-[#22d3ee]">Descrição:</span> ${dados.descricao}</p>
                <p><span class="font-semibold text-[#22d3ee]">Telefone:</span> ${dados.telefone}</p>
                <p><span class="font-semibold text-[#22d3ee]">Email:</span> ${dados.email}</p>
                <p><span class="font-semibold text-[#22d3ee]">Data da Aula:</span> ${dados.dataAula}</p>
                <p><span class="font-semibold text-[#22d3ee]">Dia da Semana:</span> ${dados.diaSemana}</p>
                <p><span class="font-semibold text-[#22d3ee]">Horários:</span> ${dados.horarios}</p>
                <p><span class="font-semibold text-[#22d3ee]">Hora Início:</span> ${dados.horaInicio}</p>
                <p><span class="font-semibold text-[#22d3ee]">Hora Fim:</span> ${dados.horaFim}</p>
                ${dados.salario ? `<p><span class="font-semibold text-[#22d3ee]">Salário:</span> ${dados.salario}</p>` : ""}
                ${dados.funcionarioId ? `<p><span class="font-semibold text-[#22d3ee]">ID Funcionário:</span> ${dados.funcionarioId}</p>` : ""}
                ${dados.aulaId ? `<p><span class="font-semibold text-[#22d3ee]">ID Aula:</span> ${dados.aulaId}</p>` : ""}
                ${dados.treinoId ? `<p><span class="font-semibold text-[#22d3ee]">ID Treino:</span> ${dados.treinoId}</p>` : ""}
                ${dados.dataAtualizacao ? `<p><span class="font-semibold text-[#22d3ee]">Data Atualização:</span> ${dados.dataAtualizacao}</p>` : ""}
                ${dados.dataContratacao ? `<p><span class="font-semibold text-[#22d3ee]">Data Contratação:</span> ${dados.dataContratacao}</p>` : ""}
            </div>
        `;

            document.getElementById("modalContent").innerHTML = modalContent;
            document.getElementById("modal").classList.remove("hidden");
            document.getElementById("modal").classList.add("flex");
        }

        // Fechar modal
        function closeModal() {
            document.getElementById("modal").classList.remove("flex");
            document.getElementById("modal").classList.add("hidden");
        }

</script>
<script>
document.addEventListener("click", (e) => {
    const botao = e.target.closest("button[data-idprofessor]");
    if (!botao) return;

    const idprofessor = botao.dataset.idprofessor;
    const idaluno = <?= $usuario ?>;

    console.log("Aula selecionada:", idprofessor, "Aluno:", idaluno);

    // Monta a URL com os parâmetros que você precisa passar
    const url = `exercicio.php?idaula=${encodeURIComponent(idprofessor)}&idaluno=${encodeURIComponent(idaluno)}`;

    // Redireciona o usuário para a página de exercícios
    window.location.href = url;
});
</script>

    <script src="./js/loader.js"></script>

</body>

</html>