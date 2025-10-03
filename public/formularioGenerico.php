<?php
require_once __DIR__ . "/../code/funcao.php";

$tabela = "aula_usuario";
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
    <title>Formulário Genérico</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <?php foreach ($colunas as $c) {
            $nome_campo = $c['Field'];   // nome do campo no banco
            $tipo_campo = $c['Type'];    // tipo do campo
            $chave      = $c['Key'];     // chave (PRI, MUL, etc.)

            // Caso seja chave primária (id), cria hidden
            if (strpos($nome_campo, "id") !== false && strpos($chave, "PRI") !== false) {
                echo "<input type='hidden' name='$nome_campo' value=''>";
                continue;
            }

            // Caso seja imagem/foto
            if (strpos($nome_campo, 'foto') !== false) {
                echo "<label for='$nome_campo'>Foto:</label><br>";
                echo "<input type='file' name='$nome_campo'><br><br>";
                continue;
            }

            // Caso seja número
            if (strpos($tipo_campo, 'int') !== false || strpos($tipo_campo, 'decimal') !== false) {
                echo "<label for='$nome_campo'>$nome_campo:</label><br>";
                echo "<input type='number' step='any' name='$nome_campo' value=''><br><br>";
                continue;
            }

            // Para os demais campos (texto por padrão)
            echo "<label for='$nome_campo'>$nome_campo:</label><br>";
            echo "<input type='text' name='$nome_campo' value=''><br><br>";
        } ?>
        <button type="submit">Salvar</button>
    </form>
</body>

</html>