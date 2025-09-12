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
$listar = listarPerfilProfessor($idusuario = null);


// Função para gerar iniciais a partir do nome_professor
function gerarIniciais($nome_professor)
{
    $nome_professors = explode(' ', $nome_professor);
    $iniciais = '';
    $count = 0;

    foreach ($nome_professors as $n) {
        if (trim($n) && $count < 2) {
            $iniciais .= strtoupper(substr($n, 0, 1));
            $count++;
        }
    }

    return $iniciais;
}

// Função para gerar cor baseada no nome_professor
function gerarCor($nome_professor)
{
    $cores = ['blue', 'pink', 'yellow', 'green', 'red', 'purple', 'indigo'];
    $hash = crc32($nome_professor);
    return $cores[abs($hash) % count($cores)];
}

// echo json_encode(value: $listar);
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
                    <span class="text-sm font-normal text-gray-500 ml-2">(<?php echo count($listar); ?> professores)</span>
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
                            <?php
                            foreach ($listar as $l) {
                                if (!empty($l)) {
                                    $iniciais = gerarIniciais($l['nome_professor']);
                                    $cor = gerarCor($l['nome_professor']);
                            ?>
                                    <tr class="dt-hasChild">
                                        <td class="px-6 py-4 dtr-control" tabindex="0">
                                            <i class="fas fa-plus-circle text-blue-500 cursor-pointer expand-icon"></i>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="user-avatar bg-<?php echo $cor; ?>-500"><?php echo $iniciais; ?></div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($l['nome_professor']); ?></div>
                                                    <div class="text-sm text-gray-500">ID: <?php echo $l['funcionario_id']; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($l['email_professor']); ?></div>
                                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($l['telefone_professor']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($l['cargo_professor']); ?></div>
                                            <div class="text-sm text-gray-500">Salário: R$ <?php echo number_format($l['salario'], 2, ',', '.'); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="text-yellow-500 mr-1"><i class="fas fa-star"></i></span>
                                                <span class="text-sm font-medium text-gray-900"><?php echo $l['avaliacao_media']; ?></span>
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
                                    <!-- REMOVA esta linha de detalhes do tbody - ela causa o erro -->
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Adicione um container separado para os detalhes -->
                    <div id="detailsContainer" style="display: none;">
                        <?php
                        foreach ($listar as $l) {
                            if (!empty($l)) {
                        ?>
                                <div id="details-<?php echo $l['funcionario_id']; ?>" class="hidden">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                                Informações do Professor
                                            </h4>
                                            <div class="space-y-2 text-sm">
                                                <p><span class="font-medium">Modalidade:</span> <?php echo htmlspecialchars($l['modalidade']); ?></p>
                                                <p><span class="font-medium">Horários:</span> <?php echo htmlspecialchars($l['horarios_disponiveis']); ?></p>
                                                <p><span class="font-medium">Data Contratação:</span> <?php echo date('d/m/Y', strtotime($l['data_contratacao'])); ?></p>
                                                <p><span class="font-medium">Descrição:</span> <?php echo htmlspecialchars($l['descricao']); ?></p>
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
                                                        <?php echo $l['avaliacao_media']; ?> ⭐
                                                    </span>
                                                </p>
                                                <p><span class="font-medium">Última Atualização:</span> <?php echo date('d/m/Y H:i', strtotime($l['data_atualizacao'])); ?></p>
                                                <p><span class="font-medium">Cargo ID:</span> <?php echo $l['cargo_id']; ?></p>
                                                <p><span class="font-medium">Usuário ID:</span> <?php echo $l['usuario_id']; ?></p>
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
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Card View -->
            <div id="cardView" class="card-view grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6 hidden">
                <?php
                foreach ($listar as $item) {
                    if (!empty($item)) {
                        $iniciais = gerarIniciais($item['nome_professor']);
                        $cor = gerarCor($item['nome_professor']);

                        echo '<div class="bg-white rounded-xl shadow-md border border-gray-200 p-5 card-hover">
                                <div class="flex items-center mb-5">
                                    <div class="user-avatar bg-' . $cor . '-500">' . $iniciais . '</div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-lg text-gray-800">' . htmlspecialchars($item['nome_professor']) . '</h3>
                                        <p class="text-gray-600 text-sm">' . htmlspecialchars($item['cargo_professor']) . '</p>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <p class="text-gray-700 mb-2">
                                        <i class="fas fa-envelope mr-2 text-blue-500"></i>' . htmlspecialchars($item['email_professor']) . '
                                    </p>
                                    <p class="text-gray-700 mb-2">
                                        <i class="fas fa-phone mr-2 text-blue-500"></i>' . htmlspecialchars($item['telefone_professor']) . '
                                    </p>
                                    <p class="text-gray-700 mb-2">
                                        <i class="fas fa-money-bill-wave mr-2 text-blue-500"></i>R$ ' . number_format($item['salario'], 2, ',', '.') . '
                                    </p>
                                    <p class="text-gray-700">
                                        <i class="fas fa-star mr-2 text-yellow-500"></i>Avaliação: ' . $item['avaliacao_media'] . '/5.0
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-1"><strong>Modalidade:</strong> ' . htmlspecialchars($item['modalidade']) . '</p>
                                    <p class="text-sm text-gray-600"><strong>Horários:</strong> ' . htmlspecialchars($item['horarios_disponiveis']) . '</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check-circle mr-1"></i> Ativo
                                    </span>
                                    <div>
                                        <button class="text-blue-500 hover:text-blue-700 mr-3" title="Ver detalhes" onclick="toggleDetails(this)">
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
                            </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
<script src="./js/tabela_professores.js"></script>

</body>

</html>