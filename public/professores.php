<?php
require_once "../code/funcao.php";
$tipo = 0;
if (isset($_GET['tipo'])) {
    $tipo = 0;
}
$professores = listarPerfilProfessor(null);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de professor</title>
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
</head>


<body class="bg-gradient-to-br from-[#132237] via-[#1a2f4a] to-[#0d1625] text-[#f1f5f9] font-montserrat min-h-screen">
    <div class="p-6">
        <button id="trocar"
            class="mb-6 px-5 py-2 rounded-lg bg-[#a855f7] hover:bg-[#3b82f6] transition text-white font-semibold shadow-lg">
            Trocar para Cards </button>

        <!-- Cards -->
        <div id="container_card" class="hidden grid grid-cols-1 md:grid-cols-3 gap-6 items-center justify-center min-h-screen px-6">

            <?php foreach ($professores as $p) { ?>
                <div class="bg-[#1e293b] shadow-xl rounded-xl p-6 max-w-xs text-center border border-[#3b82f6] hover:shadow-[#3b82f6]/40 transition">
                    <img src="./uploads/<?= $p['foto_perfil'] ?>"
                        alt="Foto de Perfil"
                        class="w-32 h-32 rounded-full mx-auto shadow-lg border-4 border-[#a855f7]">
                    <h2 class="mt-4 text-xl font-bold text-[#22d3ee]"><?= $p['nome_professor'] ?></h2>
                    <p class="text-[#cbd5e1] text-sm"><?= $p['cargo_professor'] ?></p>
                    <button onclick="openModal(0)"
                        class="mt-4 px-4 py-2 bg-[#3b82f6] text-white rounded-lg hover:bg-[#22d3ee] transition">
                        Ver mais
                    </button>
                </div>
            <?php } ?>
        </div>

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
                                <td class="px-4 py-2"><button>Botão 1</button><button>Botão 2</button><button>Botão 3</button></td>
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
                                <td class="px-4 py-2"><?= $p['telefone_professor'] ?></td>
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
    <!-- <script>
        function openModal() {
            document.getElementById("modal").classList.remove("hidden");
            document.getElementById("modal").classList.add("flex");
        }

        function closeModal() {
            document.getElementById("modal").classList.remove("flex");
            document.getElementById("modal").classList.add("hidden");
        }
    </script> -->

    <!-- Troca tabela/cards -->
    <script>
        const btnTrocar = document.getElementById("trocar");
        const tabelaWrapper = document.getElementById("container_tabela");
        const cards = document.getElementById("container_card");

        btnTrocar.addEventListener("click", () => {
            tabelaWrapper.classList.toggle("hidden");
            cards.classList.toggle("hidden");
            cards.classList.add("flex");

            if (tabelaWrapper.classList.contains("hidden")) {
                btnTrocar.innerText = "Trocar para Tabela";
            } else {
                btnTrocar.innerText = "Trocar para Cards";
            }
        });
    </script>
    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                }, // 2 cards no tablet
                1024: {
                    slidesPerView: 3
                }, // 3 cards no desktop
            }
        });
    </script>
    <script>
        // Dados dos instrutores
        const instrutores = [
            <?php foreach ($professores as $p) { ?> {
                    nome: "<?= $p['nome_professor'] ?>";
                    cargo: "<?= $p['cargo_professor'] ?>",
                    foto: "<?= $p['foto'] ?>",
                    modalidade: "<?= $p['modalidade'] ?>",
                    avaliacao: "<?= $p['avaliacao_media'] ?>",
                    telefone: "<?= $p['telefone_professor'] ?>",
                    email: "<?= $p['email_professor'] ?>",
                    dataAula: "<?= $p['data_aula'] ?>",
                    diaSemana: "<?= $p['dia_semana'] ?>",
                    horario: "<?= $p['horarios_disponiveis'] ?>",
                    salario: "<?= $p['salario'] ?>",
                    id: "#<?= $p['funcionario_id'] ?>"
                },
            <?php } ?> {
                nome: "Carlos Silva",
                cargo: "Professor de Yoga",
                foto: "https://randomuser.me/api/portraits/men/32.jpg",
                modalidade: "Presencial",
                avaliacao: "⭐⭐⭐⭐☆ (4.3)",
                telefone: "(62) 99999-2468",
                email: "carlos@academia.com",
                dataAula: "25/09/2025",
                diaSemana: "Sexta-feira",
                horario: "10:00 - 12:00",
                salario: "R$ 3.800,00",
                id: "#13579"
            }
        ];

        // Abrir modal com dados dinâmicos
        function openModal(index) {
            const i = instrutores[index];
            const modalContent = `
      <div class="flex items-center gap-4 border-b border-[#3b82f6] pb-4 mb-4">
        <img src="${i.foto}" alt="Foto"
          class="w-24 h-24 rounded-full shadow-lg border-2 border-[#a855f7]">
        <div>
          <h2 class="text-2xl font-bold text-[#22d3ee]">${i.nome}</h2>
          <p class="text-gray-300">${i.cargo}</p>
          <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold text-dark bg-[#22d3ee] rounded-full">
            ${i.modalidade}
          </span>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-200">
        <p><span class="font-semibold text-[#22d3ee]">Avaliação:</span> ${i.avaliacao}</p>
        <p><span class="font-semibold text-[#22d3ee]">Telefone:</span> ${i.telefone}</p>
        <p><span class="font-semibold text-[#22d3ee]">Email:</span> ${i.email}</p>
        <p><span class="font-semibold text-[#22d3ee]">Data da Aula:</span> ${i.dataAula}</p>
        <p><span class="font-semibold text-[#22d3ee]">Dia da Semana:</span> ${i.diaSemana}</p>
        <p><span class="font-semibold text-[#22d3ee]">Horário:</span> ${i.horario}</p>
        <p><span class="font-semibold text-[#22d3ee]">Salário:</span> ${i.salario}</p>
        <p><span class="font-semibold text-[#22d3ee]">ID Funcionário:</span> ${i.id}</p>
      </div>
    `;
            document.getElementById("modalContent").innerHTML = modalContent;
            document.getElementById("modal").classList.remove("hidden");
        }

        // Fechar modal
        function closeModal() {
            document.getElementById("modal").classList.add("hidden");
        }
    </script>
</body>

</html>