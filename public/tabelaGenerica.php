<?php
require_once '../code/funcao.php';
$id = 0;
$tabelas = listarTabelas();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Consulta de Tabelas</title>
</head>

<body>
    <div id="dados" data-id="<?php echo $id; ?>"></div>

    <select id="tabelas">
        <option value="">Selecione uma tabela</option>
        <?php foreach ($tabelas as $t):
            $nome_campo = htmlspecialchars($t['Tables_in_gym_genesis']);
        ?>
            <option value="<?php echo $nome_campo; ?>"><?php echo $nome_campo; ?></option>
        <?php endforeach; ?>
    </select>

    <table id="tabela-dados" border="1">
        <thead></thead>
        <tbody></tbody>
    </table>

    <script src="./js/tabelaGenerica.js"></script>
</body>

</html>