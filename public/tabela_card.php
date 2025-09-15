<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de professor</title>

    <!-- Estilos do DataTables (correto agora) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">

    <!-- jQuery (essencial para o DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Script do DataTables -->
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
</head>

<body>

    <table id="example" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Aleatório Nixon</td>
                <td>Analyst</td>
                <td>London</td>
                <td>45</td>
                <td>2012-07-17</td>
                <td>$170,750</td>
            </tr>
        </tbody>
    </table>

    <!-- Inicializando o DataTable -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                columnDefs: [{
                    targets: 2, // Segunda coluna (Position)
                    visible: false // Esconde essa coluna
                }],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
                },
                paging: true,
                searching: true,
                info: true


            });
        });
    </script>

</body>

</html>