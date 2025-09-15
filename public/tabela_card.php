<?php
require_once "../code/funcao.php";
?>
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
                <th>Foto de Perfil</th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Modalidade</th>
                <th>Avaliação</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $professores = listarPerfilProfessor(null);
            foreach ($professores AS $p){
            ?>
            <tr>
                <td><img src="./uploads/<?= $p['foto_perfil']?>" alt="Descrição da Imagem" /></td>
                <td><?= $p['nome_professor']?></td>
                <td><?= $p['cargo_professor']?></td>
                <td><?= $p['modalidade']?></td>
                <td><?= $p['avaliacao_media']?></td>
                <td><?= $p['descricao']?></td>
            </tr>
            <?php
            };
            ?>
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