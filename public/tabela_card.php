<?php
require_once "../code/funcao.php";
$tipo = 1;
if (isset($_GET['tipo'])) {
    $tipo = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de professor</title>
<!-- Estilos do DataTables -->
<link rel="stylesheet" href="./css/dataTable.css">

<!-- jQuery -->
<script src="./js/jquery-3.7.1.min.js"></script>

<!-- Script do DataTables -->
<script src="./js/dataTables.min.js"></script>

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
            <th>Telefone</th>
            <th>Email</th>
            <th>Data da Aula</th>
            <th>Dia da Semana</th>
            <th>Horários Disponíveis</th>
            <th>Hora Início</th>
            <th>Hora Fim</th>

            <?php if ($tipo == 0) { ?>
                <th>Salário</th>
                <th>ID Funcionário</th>
                <th>ID Aula</th>
                <th>ID Treino</th>
                <th>Data Atualização</th>
                <th>Data Contratação</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $professores = listarPerfilProfessor(null);
        foreach ($professores as $p) {
        ?>
            <tr>
                <!-- FOTO -->
                <td><img src="./uploads/<?= $p['foto_perfil'] ?>" alt="Foto de Perfil" width="60" /></td>

                <!-- CAMPOS VISÍVEIS PARA TODOS -->
                <td><?= $p['nome_professor'] ?></td>
                <td><?= $p['cargo_professor'] ?></td>
                <td><?= $p['modalidade'] ?></td>
                <td><?= $p['avaliacao_media'] ?></td>
                <td><?= $p['descricao'] ?></td>
                <td><?= $p['telefone_professor'] ?></td>
                <td><?= $p['email_professor'] ?></td>
                <td><?= $p['data_aula'] ?></td>
                <td><?= $p['dia_semana'] ?></td>
                <td><?= $p['horarios_disponiveis'] ?></td>
                <td><?= $p['hora_inicio'] ?></td>
                <td><?= $p['hora_fim'] ?></td>

                <!-- CAMPOS VISÍVEIS APENAS PARA ADMIN -->
                <?php if ($tipo == 0) { ?>
                    <td><?= $p['salario'] ?></td>
                    <td><?= $p['funcionario_id'] ?></td>
                    <td><?= $p['idaula'] ?></td>
                    <td><?= $p['treino_id'] ?></td>
                    <td><?= $p['data_atualizacao'] ?></td>
                    <td><?= $p['data_contratacao'] ?></td>
                <?php } ?>
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