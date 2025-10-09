<?php
require_once __DIR__ . "/../code/funcao.php";

$id = 1;
$tabela = $_GET['tabela'];
$acao = $_GET['acao'];
$colunas = listarColunasTabela($tabela);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário Genérico</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

  <div id="dados" data-tabela="<?php echo $tabela; ?>" data-id="<?php echo $id; ?>"></div>

  <form action="" method="post" enctype="multipart/form-data" id="formGenerico">
    <?php
    foreach ($colunas as $c) {
      $nome_campo = $c['Field'];
      $tipo_campo = strtolower($c['Type']);
      $chave = $c['Key'];

      // Ignorar campos automáticos
      if (strpos($tipo_campo, "timestamp") !== false) continue;

      // Campo ID primário → hidden
      if (strpos($nome_campo, "id") !== false && strpos($chave, "PRI") !== false) {
        echo "<input type='hidden' name='$nome_campo' value=''>";
        continue;
      }

      // Chaves estrangeiras (id de outra tabela)
      if (strpos($nome_campo, "id") !== false && strpos($chave, "MUL") !== false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<select name='$nome_campo' id='select_$nome_campo'></select><br><br>";
        continue;
      }

      // Campo de senha
      if (strpos($nome_campo, "senha") !== false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<input type='password' name='$nome_campo'><br><br>";
        continue;
      }

      // Campo de número de matrícula → hidden
      if (strpos($nome_campo, "numero_matricula") !== false) {
        echo "<input type='hidden' name='$nome_campo' value=''>";
        continue;
      }

      // Campo de foto
      if (strpos($nome_campo, 'foto') !== false) {
        echo "<label for='$nome_campo'>Foto:</label><br>";
        echo "<input type='file' name='$nome_campo'><br><br>";
        continue;
      }

      // TextArea
      if (strpos($tipo_campo, 'text') !== false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<textarea name='$nome_campo' rows='4' cols='50'></textarea><br><br>";
        continue;
      }

      // Data
      if (strpos($tipo_campo, 'date') !== false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<input type='date' name='$nome_campo'><br><br>";
        continue;
      }

      // Hora (sem timestamp)
      if (strpos($tipo_campo, 'time') !== false && strpos($tipo_campo, 'stamp') === false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<input type='time' name='$nome_campo'><br><br>";
        continue;
      }

      // Enum
      if (strpos($tipo_campo, 'enum') !== false) {
        preg_match("/enum\((.*)\)/", $tipo_campo, $matches);
        $valores = str_getcsv(str_replace("'", "", $matches[1]));
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<select name='$nome_campo'>";
        foreach ($valores as $val) {
          echo "<option value='$val'>$val</option>";
        }
        echo "</select><br><br>";
        continue;
      }

      // Número
      if (strpos($tipo_campo, 'int') !== false || strpos($tipo_campo, 'decimal') !== false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<input type='number' name='$nome_campo'><br><br>";
        continue;
      }

      // Padrão → texto
      echo "<label for='$nome_campo'>$nome_campo:</label><br>";
      echo "<input type='text' name='$nome_campo'><br><br>";
    }
    ?>
    <button type="submit">Salvar</button>
  </form>

<script src="./js/formularioGenerico.js"></script>

</body>
</html>
