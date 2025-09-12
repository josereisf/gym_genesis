<?php
require_once __DIR__ . '/../code/funcao.php';
require_once "../php/verificarLogado.php";

if ($_SESSION['tipo'] == 2) {
    $_SESSION['erro_login'] = "Usuário não permitido!";
    header('Location: dashboard_professor.php');
    exit;
}

$idaluno = $_SESSION["id"] ?? 0;

// Pega todos os usuários do tipo professor
$professores = listarUsuarioTipo(2);

// Inicializa array final
$tudojunto = [];

foreach ($professores as $prof) {
    $id = $prof['idusuario'];

    // Pega perfil do funcionário
    $perfil_funcionario = listarFuncionarios($id); // array
    $cargo = listarCargo($id);                     // array com cargos

    // Pega perfil específico do professor
    $perfil_professor = listarPerfilProfessor($id); // array

    // Monta o array unificado
    $tudojunto[] = [
        'usuario' => $prof,
        'perfil_funcionario' => $perfil_funcionario,
        'cargo' => $cargo,
        'perfil_professor' => $perfil_professor
    ];
}

// Função para gerar iniciais a partir do nome
function gerarIniciais($nome)
{
    $nomes = explode(' ', $nome);
    $iniciais = '';
    $count = 0;

    foreach ($nomes as $n) {
        if (trim($n) && $count < 2) {
            $iniciais .= strtoupper(substr($n, 0, 1));
            $count++;
        }
    }

    return $iniciais;
}

// Função para gerar cor baseada no nome
function gerarCor($nome)
{
    $cores = ['blue', 'pink', 'yellow', 'green', 'red', 'purple', 'indigo'];
    $hash = crc32($nome);
    return $cores[abs($hash) % count($cores)];
}

var_dump($tudojunto)
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores - Sistema Acadêmico</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .dt-hasChild {
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .dt-hasChild:hover {
            background-color: #f9fafb;
        }

        .dt-hasChild.dtr-expanded {
            background-color: #eff6ff;
        }

        .dt-hasChild.dtr-expanded .expand-icon {
            transform: rotate(45deg);
            color: #ef4444;
        }

        .expand-icon {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .dt-child {
            background-color: #f8fafc;
        }

        .dt-child.hidden {
            display: none;
        }

        .dt-child td {
            border-top: 2px solid #e2e8f0;
        }

        .card-view {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .table-view {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .active-view {
            display: block;
            opacity: 1;
        }

        .btn-active {
            background-color: #3b82f6;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            color: white;
            font-size: 18px;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .bg-blue {
            background-color: #3b82f6;
        }

        .bg-pink {
            background-color: #ec4899;
        }

        .bg-yellow {
            background-color: #eab308;
        }

        .bg-green {
            background-color: #22c55e;
        }

        .bg-red {
            background-color: #ef4444;
        }

        .bg-purple {
            background-color: #a855f7;
        }

        .bg-indigo {
            background-color: #6366f1;
        }

        .dataTables_filter {
            margin-bottom: 0 !important;
        }

        .dataTables_filter label {
            display: flex !important;
            align-items: center !important;
            margin-bottom: 0 !important;
        }

        .dataTables_filter input {
            width: 250px !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 1rem 0.5rem 2.5rem !important;
            border: 1px solid #d1d5db !important;
            transition: all 0.2s ease-in-out !important;
        }

        .dataTables_filter input:focus {
            outline: none !important;
            ring: 2px !important;
            ring-color: #3b82f6 !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        .dataTables_length label {
            display: flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
        }

        .dataTables_length select {
            border-radius: 0.5rem !important;
            padding: 0.25rem 2rem 0.25rem 0.5rem !important;
            border: 1px solid #d1d5db !important;
        }

        /* Estilos para a paginação */
        .dataTables_paginate {
            display: flex !important;
            gap: 0.5rem !important;
        }

        .paginate_button {
            padding: 0.25rem 0.75rem !important;
            border-radius: 0.5rem !important;
            border: 1px solid #d1d5db !important;
            cursor: pointer !important;
            transition: all 0.2s ease-in-out !important;
        }

        .paginate_button:hover {
            background-color: #3b82f6 !important;
            color: white !important;
            border-color: #3b82f6 !important;
        }

        .paginate_button.current {
            background-color: #3b82f6 !important;
            color: white !important;
            border-color: #3b82f6 !important;
        }

        .dataTables_info {
            padding: 0.5rem 1rem !important;
            background-color: #eff6ff !important;
            border: 1px solid #dbeafe !important;
            border-radius: 0.5rem !important;
            font-size: 0.875rem !important;
            color: #374151 !important;
            display: flex !important;
            align-items: center !important;
        }

        .info-box {
            display: flex !important;
            align-items: center !important;
            margin-bottom: 1rem !important;
        }

        @media (min-width: 768px) {
            .info-box {
                margin-bottom: 0 !important;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-2 text-gray-800">Sistema de Gerenciamento de Professores</h1>
        <p class="text-center text-gray-600 mb-10">Visualize e gerencie todos os professores cadastrados</p>

        <div class="bg-white rounded-xl shadow-xl p-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">
                    <i class="fas fa-chalkboard-teacher mr-3 text-blue-500"></i>Lista de Professores
                    <span class="text-sm font-normal text-gray-500 ml-2">(<?php echo count($tudojunto); ?> professores)</span>
                </h2>
                <div class="flex space-x-3 bg-gray-100 p-2 rounded-xl">
                    <button id="tableViewBtn" class="px-5 py-3 rounded-xl transition-all duration-300 btn-active flex items-center">
                        <i class="fas fa-table mr-2"></i>Tabela
                    </button>
                    <button id="cardViewBtn" class="px-5 py-3 rounded-xl transition-all duration-300 bg-gray-200 text-gray-700 hover:bg-gray-300 flex items-center">
                        <i class="fas fa-th-large mr-2"></i>Cards
                    </button>
                </div>
            </div>

            <!-- Table View -->
            <div id="tableView" class="table-view active-view fade-in">
                <div class="rounded-lg overflow-hidden border border-gray-200 shadow">
                    <table id="usersTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Professor</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contato</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avaliação</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($tudojunto as $professor): ?>
                                <?php
                                if (!empty($professor['perfil_funcionario']) && !empty($professor['perfil_professor'])):
                                    $funcionario = $professor['perfil_funcionario'][0];
                                    $perfil = $professor['perfil_professor'][0];
                                    $iniciais = gerarIniciais($funcionario['nome']);
                                    $cor = gerarCor($funcionario['nome']);
                                ?>
                                    <tr class="dt-hasChild">
                                        <td class="px-6 py-4 dtr-control" tabindex="0">
                                            <i class="fas fa-plus-circle text-blue-500 cursor-pointer expand-icon"></i>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="user-avatar bg-<?php echo $cor; ?>-500"><?php echo $iniciais; ?></div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($funcionario['nome']); ?></div>
                                                    <div class="text-sm text-gray-500">ID: <?php echo $professor['usuario']['idusuario']; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($funcionario['email']); ?></div>
                                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($funcionario['telefone']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($funcionario['nome_cargo']); ?></div>
                                            <div class="text-sm text-gray-500">Salário: R$ <?php echo number_format($funcionario['salario'], 2, ',', '.'); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
                                                <span class="text-sm font-medium text-gray-900"><?php echo $perfil['avaliacao_media']; ?></span>
                                                <span class="text-sm text-gray-500 ml-1">/5.0</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Ativo
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button class="text-blue-500 hover:text-blue-700 mr-3" title="Ver detalhes">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-green-500 hover:text-green-700 mr-3" title="Enviar mensagem">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="text-purple-500 hover:text-purple-700" title="Agendar aula">
                                                <i class="fas fa-calendar-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="dt-child hidden">
                                        <td colspan="7" class="px-6 py-4 bg-gray-50">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                                        Informações do Professor
                                                    </h4>
                                                    <div class="space-y-2 text-sm">
                                                        <p><span class="font-medium">Modalidade:</span> <?php echo htmlspecialchars($perfil['modalidade']); ?></p>
                                                        <p><span class="font-medium">Horários:</span> <?php echo htmlspecialchars($perfil['horarios_disponiveis']); ?></p>
                                                        <p><span class="font-medium">Data Contratação:</span> <?php echo date('d/m/Y', strtotime($funcionario['data_contratacao'])); ?></p>
                                                        <p><span class="font-medium">Descrição:</span> <?php echo htmlspecialchars($perfil['descricao']); ?></p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                                        <i class="fas fa-chart-bar mr-2 text-green-500"></i>
                                                        Estatísticas
                                                    </h4>
                                                    <div class="space-y-2 text-sm">
                                                        <p><span class="font-medium">Avaliação Média:</span>
                                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                <?php echo $perfil['avaliacao_media']; ?> ⭐
                                                            </span>
                                                        </p>
                                                        <p><span class="font-medium">Última Atualização:</span> <?php echo date('d/m/Y H:i', strtotime($perfil['data_atualizacao'])); ?></p>
                                                        <p><span class="font-medium">Cargo ID:</span> <?php echo $funcionario['cargo_id']; ?></p>
                                                        <p><span class="font-medium">Usuário ID:</span> <?php echo $funcionario['usuario_id']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 pt-4 border-t border-gray-200">
                                                <div class="flex space-x-3">
                                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors flex items-center">
                                                        <i class="fas fa-edit mr-2"></i> Editar Perfil
                                                    </button>
                                                    <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors flex items-center">
                                                        <i class="fas fa-comment mr-2"></i> Enviar Mensagem
                                                    </button>
                                                    <button class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors flex items-center">
                                                        <i class="fas fa-calendar-check mr-2"></i> Agendar Aula
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Card View -->
            <div id="cardView" class="card-view grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <?php foreach ($tudojunto as $professor): ?>
                    <?php
                    if (!empty($professor['perfil_funcionario']) && !empty($professor['perfil_professor'])):
                        $funcionario = $professor['perfil_funcionario'][0];
                        $perfil = $professor['perfil_professor'][0];
                        $iniciais = gerarIniciais($funcionario['nome']);
                        $cor = gerarCor($funcionario['nome']);
                    ?>
                        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-5 card-hover">
                            <div class="flex items-center mb-5">
                                <div class="user-avatar bg-<?php echo $cor; ?>-500"><?php echo $iniciais; ?></div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-lg text-gray-800"><?php echo htmlspecialchars($funcionario['nome']); ?></h3>
                                    <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($funcionario['nome_cargo']); ?></p>
                                </div>
                            </div>
                            <div class="mb-5">
                                <p class="text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2 text-blue-500"></i><?php echo htmlspecialchars($funcionario['email']); ?>
                                </p>
                                <p class="text-gray-700 mb-2">
                                    <i class="fas fa-phone mr-2 text-blue-500"></i><?php echo htmlspecialchars($funcionario['telefone']); ?>
                                </p>
                                <p class="text-gray-700 mb-2">
                                    <i class="fas fa-money-bill-wave mr-2 text-blue-500"></i>R$ <?php echo number_format($funcionario['salario'], 2, ',', '.'); ?>
                                </p>
                                <p class="text-gray-700">
                                    <i class="fas fa-star mr-2 text-yellow-500"></i>Avaliação: <?php echo $perfil['avaliacao_media']; ?>/5.0
                                </p>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-1"><strong>Modalidade:</strong> <?php echo htmlspecialchars($perfil['modalidade']); ?></p>
                                <p class="text-sm text-gray-600"><strong>Horários:</strong> <?php echo htmlspecialchars($perfil['horarios_disponiveis']); ?></p>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i> Ativo
                                </span>
                                <div>
                                    <button class="text-blue-500 hover:text-blue-700 mr-3" title="Ver detalhes">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-green-500 hover:text-green-700 mr-3" title="Enviar mensagem">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button class="text-purple-500 hover:text-purple-700" title="Agendar aula">
                                        <i class="fas fa-calendar-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        // Inicializar DataTables primeiro
        var table = $('#usersTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
                search: "Pesquisar:",
                searchPlaceholder: "Digite o nome, cargo ou email...",
                info: "Mostrando _START_ até _END_ de _TOTAL_ professores",
                infoEmpty: "Mostrando 0 até 0 de 0 professores",
                infoFiltered: "(filtrado de _MAX_ professores no total)",
                lengthMenu: "Mostrar _MENU_ professores por página",
                paginate: {
                    first: "Primeira",
                    previous: "Anterior",
                    next: "Próxima",
                    last: "Última"
                }
            },
            dom: '<"flex flex-col md:flex-row justify-between items-center mb-6"<"mb-4 md:mb-0"l><"search-box">><"overflow-auto"t><"flex flex-col md:flex-row justify-between items-center mt-6"<"info-box"i><"pagination-box"p>>',
            pageLength: 10,
            order: [[1, 'asc']], // Ordenar pela coluna 1 (nome)
            columnDefs: [
                {
                    orderable: false,
                    targets: 0 // Não ordenar pela coluna de expansão
                }
            ],
            initComplete: function() {
                // Personalizar a caixa de pesquisa
                $('.dataTables_filter label').contents().filter(function() {
                    return this.nodeType === 3;
                }).remove();

                $('.dataTables_filter input')
                    .addClass('px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200')
                    .attr('placeholder', 'Pesquisar professores...')
                    .wrap('<div class="relative"></div>');

                $('.dataTables_filter').prepend('<i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>');
                $('.dataTables_filter input').css('padding-left', '2.5rem');

                // Personalizar a informação de paginação
                $('#usersTable_info')
                    .addClass('text-sm text-gray-600 bg-blue-50 px-4 py-2 rounded-lg border border-blue-100')
                    .prepend('<i class="fas fa-info-circle mr-2 text-blue-500"></i>');
                    
                // Adicionar eventos de clique após a inicialização da tabela
                addRowExpansionEvents();
            }
        });

        // Função para adicionar eventos de expansão/recolhimento
        function addRowExpansionEvents() {
            // Usar delegação de eventos para funcionar com paginação
            $('#usersTable tbody').on('click', '.dt-hasChild', function() {
                const $row = $(this);
                const $childRow = $row.next('.dt-child');
                
                // Verificar se a linha filha existe
                if ($childRow.length) {
                    $row.toggleClass('dtr-expanded');
                    $childRow.toggleClass('hidden');
                    
                    // Atualizar ícone
                    const $icon = $row.find('.expand-icon');
                    if ($row.hasClass('dtr-expanded')) {
                        $icon.removeClass('fa-plus-circle').addClass('fa-minus-circle');
                    } else {
                        $icon.removeClass('fa-minus-circle').addClass('fa-plus-circle');
                    }
                }
            });
        }

        // Mover a caixa de pesquisa para o container personalizado
        $('.search-box').append($('#usersTable_filter'));

        // Mover a informação para o container personalizado
        $('.info-box').append($('#usersTable_info'));

        // Estilizar a paginação
        $('.pagination-box').append($('#usersTable_paginate'));
        $('#usersTable_paginate').addClass('flex space-x-2');
        $('#usersTable_paginate .paginate_button').addClass('px-3 py-1 rounded-lg border border-gray-300 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-all duration-200');
        $('#usersTable_paginate .paginate_button.current').addClass('bg-blue-500 text-white border-blue-500');
        
        // Reaplicar eventos quando a página é alterada
        table.on('draw', function() {
            addRowExpansionEvents();
        });

        // Alternar entre visualização de tabela e cards
        $('#tableViewBtn').click(function() {
            $('#tableView').addClass('active-view');
            $('#cardView').removeClass('active-view');
            $(this).removeClass('bg-gray-200 text-gray-700').addClass('btn-active');
            $('#cardViewBtn').removeClass('btn-active').addClass('bg-gray-200 text-gray-700');
        });

        $('#cardViewBtn').click(function() {
            $('#cardView').addClass('active-view');
            $('#tableView').removeClass('active-view');
            $(this).removeClass('bg-gray-200 text-gray-700').addClass('btn-active');
            $('#tableViewBtn').removeClass('btn-active').addClass('bg-gray-200 text-gray-700');
        });
        
        // Adicionar eventos inicialmente
        addRowExpansionEvents();
    });
</script>
</body>

</html>