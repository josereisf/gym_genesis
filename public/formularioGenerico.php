<?php
require_once "../code/funcao.php";
$tabela = "usuario";
$colunas = listarColunasTabela($tabela);
echo "<pre>";
print_r($colunas);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post"></form>
    <?php foreach ($colunas as $c) {
        $nome_campo = $c['Field'];
        $tipo_campo = $c['Type'];
        $chave = $c['Key'];
        if (strpos($nome_campo, "id") !== False && strpos($chave, "PRI") !== False) {
            echo "<input type='hidden' name='$nome_campo' value='$nome_campo'>";
        }
        if (strpos($nome_campo, 'foto') !== False) {
            echo "<img src='uploads/$imagem' alt='$imagem'>";
            echo "<input type='file' name='$nome_campo' value='$nome_campo'>";
            echo "<br>";
        }
        if (strpos($tipo, 'int') !== false || strpos($tipo, 'decimal') !== false) {
            echo "<label>$nome:</label>";
            echo "<input type='number' step='any' name='$nome' value='" . htmlspecialchars($valor) . "'><br>";
            continue;
        }

    ?>

    <?php } ?>

</body>

</html>