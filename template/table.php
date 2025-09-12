<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Professores</title>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Lista de Professores</h2>
    
    <table id="usersTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Cargo</th>
                <th>Salário</th>
                <th>Data Contratação</th>
                <th>Avaliação</th>
                <th>Modalidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Os dados serão preenchidos via AJAX -->
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#usersTable').DataTable({
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": "localhost:83/api/index.php?entidade=perfil_professor&acao=listar",
            "dataSrc": function(json) {
                // Transforma a estrutura complexa em dados simples para o DataTables
                return json.map(function(item) {
                    // Verifica se existe perfil_funcionario e perfil_professor
                    var funcionario = item.perfil_funcionario && item.perfil_funcionario[0] ? item.perfil_funcionario[0] : {};
                    var professor = item.perfil_professor && item.perfil_professor[0] ? item.perfil_professor[0] : {};
                    
                    return {
                        "id": item.usuario.idusuario,
                        "nome": funcionario.nome || 'N/A',
                        "email": item.usuario.email,
                        "telefone": funcionario.telefone || professor.telefone || 'N/A',
                        "cargo": funcionario.nome_cargo || 'N/A',
                        "salario": funcionario.salario ? 'R$ ' + parseFloat(funcionario.salario).toFixed(2) : 'N/A',
                        "data_contratacao": funcionario.data_contratacao || 'N/A',
                        "avaliacao": professor.avaliacao_media || 'N/A',
                        "modalidade": professor.modalidade || 'N/A',
                        "descricao": professor.descricao || 'N/A',
                        "horarios": professor.horarios_disponiveis || 'N/A'
                    };
                });
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "nome" },
            { "data": "email" },
            { "data": "telefone" },
            { "data": "cargo" },
            { 
                "data": "salario",
                "render": function(data, type, row) {
                    return data;
                }
            },
            { 
                "data": "data_contratacao",
                "render": function(data) {
                    return data !== 'N/A' ? new Date(data).toLocaleDateString('pt-BR') : data;
                }
            },
            { 
                "data": "avaliacao",
                "render": function(data) {
                    return data !== 'N/A' ? data + ' ⭐' : data;
                }
            },
            { "data": "modalidade" },
            {
                "data": null,
                "orderable": false,
                "render": function(data, type, row) {
                    return `
                        <button class="btn btn-info btn-sm view-btn" data-id="${row.id}">Ver</button>
                        <button class="btn btn-warning btn-sm edit-btn" data-id="${row.id}">Editar</button>
                    `;
                }
            }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        },
        "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf'
        ],
        "responsive": true,
        "pageLength": 10,
        "order": [[0, 'asc']]
    });

    // Event listeners para os botões de ação
    $('#usersTable').on('click', '.view-btn', function() {
        var id = $(this).data('id');
        alert('Visualizar professor ID: ' + id);
    });

    $('#usersTable').on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        alert('Editar professor ID: ' + id);
    });
});
</script>

</body>
</html>