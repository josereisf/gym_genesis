<?php
require_once __DIR__ . "/../code/funcao.php";

$id = 1;
$tabela = $_GET['tabela'];
$acao = $_GET['acao'];
$colunas = listarColunasTabela($tabela);

echo "<pre>";
echo "</pre>";


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Genérico</title>
    <script src="../public/js/formularioGenerico.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div id="dados" data-tabela="<?php echo $tabela; ?>" data-id="<?php echo $id; ?>"></div>
      <script>
    $(document).ready(function() {
      // Pegando os dados diretamente do atributo 'data-*' no HTML
      var tabela = $('#dados').data('tabela');
      var id = $('#dados').data('id');
      
      // Agora você pode usar esses valores no JavaScript
      console.log("Tabela:", tabela);
      console.log("ID:", id);
      
      // Passando para a função listarTabela
      listarTabela(tabela, id);
    });
      </script>
    <form action="api/index.php?entidade=<?= $tabela ?>&acao=cadastrar" method="post" enctype="multipart/form-data">
        <?php foreach ($colunas as $c) {
            $nome_campo = $c['Field'];
            $tipo_campo = strtolower($c['Type']);
            $chave = $c['Key'];

            if (strpos($tipo_campo, "timestamp") !== false) {
                continue;
            }
            if (strpos($nome_campo, "id") !== false && strpos($chave, "PRI") !== false) {
                echo "<input type='hidden' name='$nome_campo' value=''>";
                continue;
            }
            if (strpos($nome_campo, "id") !== false && strpos($chave, "MUL") !== false) {
                echo "Em desenvolvimento mas funciona.<br>";
                continue;
            }
            if (strpos($nome_campo, "senha") !== false) {
                echo "<label for='$nome_campo'>$nome_campo:</label><br>";
                echo "<input type='password' name='$nome_campo' value=''><br>";
                continue;
            }
            if (strpos($nome_campo, "numero_matricula") !== false) {
                echo "<input type='hidden' name='$nome_campo' value=''>";
                continue;
            }
            if (strpos($nome_campo, 'foto') !== false) {
                echo "<label for='$nome_campo'>Foto:</label><br>";
                echo "<input type='file' name='$nome_campo'><br><br>";
                continue;
            }



            if (strpos($tipo_campo, 'text') !== false) {
                echo "<label for='$nome_campo'>$nome_campo:</label><br>";
                echo "<textarea name='$nome_campo' rows='4' cols='50'></textarea><br><br>";
                continue;
            }
            if (strpos($tipo_campo, 'date') !== false) {
                echo "<label for='$nome_campo'>$nome_campo:</label><br>";
                echo "<input type='date' name='$nome_campo'><br><br>";
                continue;
            }
            if (strpos($tipo_campo, 'time') !== false && strpos($tipo_campo, 'stamp') === false) {
                echo "<label for='$nome_campo'>$nome_campo:</label><br>";
                echo "<input type='time' name='$nome_campo'><br><br>";
                continue;
            }
            if (strpos($tipo_campo, 'enum') !== false) {
                //Usa expressão regular para capturar tudo que está dentro dos parênteses do ENUM
                preg_match("/enum\((.*)\)/", $tipo_campo, $matches);
                //Remove as aspas simples da string capturada e converte em array separado por vírgula
                $valores = str_getcsv(str_replace("'", "", $matches[1]));
                echo "<label for='$nome_campo'>$nome_campo:</label><br>";
                echo "<select name='$nome_campo'>";
                foreach ($valores as $val) {
                    echo "<option value='$val'>$val</option>";
                }
                echo "</select><br><br>";
                continue;
            }
            if (strpos($tipo_campo, 'int') !== false || strpos($tipo_campo, 'decimal') !== false) {
                echo "<label for='$nome_campo'>$nome_campo:</label><br>";
                echo "<input type='number' step='any' name='$nome_campo' value=''><br><br>";
                continue;
            }
            echo "<label for='$nome_campo'>$nome_campo:</label><br>";
            echo "<input type='text' name='$nome_campo'><br><br>";
        } ?>

        <button type="submit">Salvar</button>
    </form>
</body>

</html>