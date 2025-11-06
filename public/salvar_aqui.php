<?php
require_once __DIR__ . "/../code/funcao.php";



$id = isset($_GET['id']) ? $_GET['id'] : null;  // Obter ID para edição (se existir)
$tabela = $_GET['tabela'];

// Caso o ID seja fornecido, buscamos os dados
$colunas = listarColunasTabela($tabela);

// Lógica para preencher os campos do formulário, caso haja um ID
if ($id) {
  // Consultar dados do banco para o ID
  $dados = DadosGerais($tabela, $id);  // Função que você deve criar para buscar os dados do banco.
}

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

  <script src="./js/formularioGenerico.js"></script>

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
        echo "<input type='hidden' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'>";
        continue;
      }

      // Chaves estrangeiras (id de outra tabela)
      if (strpos($nome_campo, "id") !== false && strpos($chave, "MUL") !== false) {
        if (strpos($nome_campo, "id") !== false) {
          $atributo = 'disabled';
        } else {
          $atributo = '';
        }
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<select name='$nome_campo' class='chaveEstrangeira' data-tabela='$tabela' data-campo='$nome_campo' data-ideditar='$id' $atributo>";
        // Aqui você pode preencher as opções dinamicamente, com os valores das chaves estrangeiras.
        echo "</select><br><br>";
    ?>
        <script>
          preencherChavesEstrangeiras()
        </script>
    <?php
        continue;
      }

      // Campo de senha
      // Campo de senha
      if (strpos($nome_campo, "senha") !== false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<input type='password' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "' 
           onfocus=\"this.type='text'\" 
           onblur=\"this.type='password'\"><br><br>";
        continue;
      }

      // Campo de número de matrícula → hidden
      if (strpos($nome_campo, "numero_matricula") !== false) {
        echo "<input type='hidden' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'>";
        continue;
      }

      // Campo de foto
      if (strpos($nome_campo, 'foto') !== false) {
        echo "<label for='$nome_campo'>Foto:</label><br>";
        echo "<input type='file' name='$nome_campo'><br><br>";
        if ($id && isset($dados[$nome_campo])) {
          echo "<img src='./uploads/" . $dados[$nome_campo] . "' alt='Foto' width='100'><br><br>";
        }
        continue;
      }

      // TextArea
      if (strpos($tipo_campo, 'text') !== false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<textarea name='$nome_campo' rows='4' cols='50'>" . ($id ? $dados[$nome_campo] : '') . "</textarea><br><br>";
        continue;
      }

      // Data
      if (strpos($tipo_campo, 'date') !== false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<input type='date' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'><br><br>";
        continue;
      }

      // Hora (sem timestamp)
      if (strpos($tipo_campo, 'time') !== false && strpos($tipo_campo, 'stamp') === false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<input type='time' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'><br><br>";
        continue;
      }

      // Enum
      if (strpos($tipo_campo, 'enum') !== false) {
        preg_match("/enum\((.*)\)/", $tipo_campo, $matches);
        $valores = str_getcsv(str_replace("'", "", $matches[1]));
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";
        echo "<select name='$nome_campo'>";
        foreach ($valores as $val) {
          $selected = ($id && $dados[$nome_campo] == $val) ? 'selected' : '';
          echo "<option value='$val' $selected>$val</option>";
        }
        echo "</select><br><br>";
        continue;
      }

      // Número
      if (strpos($tipo_campo, 'int') !== false || strpos($tipo_campo, 'decimal') !== false) {
        echo "<label for='$nome_campo'>$nome_campo:</label><br>";

        $attrs = '';

        if (strpos($nome_campo, 'id') !== false) {
          $attrs = "min='1'";
        } elseif ($nome_campo === "tipo_usuario") {
          $attrs = "min='0' max='2'";
        } else {
          $attrs = "min='0'";

          // Se for um INT pequeno, definir max apropriado
          if (strpos($tipo_campo, 'tinyint') !== false) {
            $attrs .= " max='255'";
          } elseif (strpos($tipo_campo, 'smallint') !== false) {
            $attrs .= " max='32767'";
          }
        }

        echo "<input type='number' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "' $attrs><br><br>";
        continue;
      }

      // Padrão → texto
      echo "<label for='$nome_campo'>$nome_campo:</label><br>";
      echo "<input type='text' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'><br><br>";
    }
    ?>
    <button type="submit"><?php echo $id ? 'Salvar Alterações' : 'Cadastrar'; ?></button>
  </form>
  <script>
    // Definir a tabela globalmente
    const tabela = '<?php echo $tabela; ?>';

    // Evento de clique no botão
    $('#btnSalvar').on('click', function() {
      editarRegistro(tabela);
    });
    // Prevenir submit tradicional do formulário
    $('#formGenerico').on('submit', function(e) {
      e.preventDefault();
      editarRegistro(tabela);
    });
    
  </script>
</body>

</html>