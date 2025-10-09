<?php
require_once '../code/funcao.php';
$id = 1;
$tabela = "usuario";
$colunas = listarColunasTabela($tabela);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div id="dados" data-tabela="<?php echo $tabela; ?>" data-id="<?php echo $id; ?>"></div>
    <select name="" id="tabela">

        <option data-<?= $tabela ?>="<?= $tabela ?>">Usuario</option>
        <option data->Perfil Usuario</option>

    </select>
    <table id="tabela-dados">
        <thead></thead>
        <tbody></tbody>
    </table>
    <script src="./js/tabelaGenerica.js"></script>
</body>

</html>