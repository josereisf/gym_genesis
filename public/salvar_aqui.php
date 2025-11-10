<?php
require_once __DIR__ . "/../code/funcao.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;
$tabela = $_GET['tabela'];
$colunas = listarColunasTabela($tabela);

if ($id) {
  $dados = DadosGerais($tabela, $id);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Genérico</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/formularioGenerico.js"></script>
  </head>
  <body class="min-h-screen bg-gray-100 flex items-center justify-center p-6">

  <div id="dados" data-tabela="<?php echo $tabela; ?>" data-id="<?php echo $id; ?>"></div>

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-3xl border border-gray-200">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
      <?php echo $id ? 'Editar Registro' : 'Cadastrar Novo Registro'; ?>
    </h1>

    <form action="" method="post" enctype="multipart/form-data" id="formGenerico" class="space-y-6">
      <?php
      foreach ($colunas as $c) {
        $nome_campo = $c['Field'];
        $tipo_campo = strtolower($c['Type']);
        $chave = $c['Key'];

        if (strpos($tipo_campo, "timestamp") !== false) continue;

        // Campo ID primário → hidden
        if (strpos($nome_campo, "id") !== false && strpos($chave, "PRI") !== false) {
          echo "<input type='hidden' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'>";
          continue;
        }

        // Chaves estrangeiras
        if (strpos($nome_campo, "id") !== false && strpos($chave, "MUL") !== false) {
          echo "
          <div>
            <label for='$nome_campo' class='block text-gray-700 font-semibold mb-1'>$nome_campo</label>
            <select name='$nome_campo' class='chaveEstrangeira w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500' data-tabela='$tabela' data-campo='$nome_campo' data-ideditar='$id'>
            </select>
          </div>
          <script>preencherChavesEstrangeiras()</script>";
          continue;
        }

        // Campo senha
        if (strpos($nome_campo, "senha") !== false) {
          echo "
          <div>
            <label for='$nome_campo' class='block text-gray-700 font-semibold mb-1'>$nome_campo</label>
            <input type='password' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'
              onfocus=\"this.type='text'\" onblur=\"this.type='password'\"
              class='w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2'>
          </div>";
          continue;
        }

        // Foto
        if (strpos($nome_campo, 'foto') !== false) {
          echo "
          <div>
            <label for='$nome_campo' class='block text-gray-700 font-semibold mb-1'>Foto</label>
            <input type='file' name='$nome_campo' class='w-full text-gray-700'>
            ";
          if ($id && isset($dados[$nome_campo])) {
            echo "<img src='./uploads/" . $dados[$nome_campo] . "' alt='Foto' class='mt-3 rounded-lg shadow-md w-24 h-24 object-cover'>";
          }
          echo "</div>";
          continue;
        }

        // TextArea
        if (strpos($tipo_campo, 'text') !== false) {
          echo "
          <div>
            <label for='$nome_campo' class='block text-gray-700 font-semibold mb-1'>$nome_campo</label>
            <textarea name='$nome_campo' rows='4' class='w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2'>" . ($id ? $dados[$nome_campo] : '') . "</textarea>
          </div>";
          continue;
        }

        // Data
        if (strpos($tipo_campo, 'date') !== false) {
          echo "
          <div>
            <label for='$nome_campo' class='block text-gray-700 font-semibold mb-1'>$nome_campo</label>
            <input type='date' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'
              class='w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2'>
          </div>";
          continue;
        }

        // Hora
        if (strpos($tipo_campo, 'time') !== false && strpos($tipo_campo, 'stamp') === false) {
          echo "
          <div>
            <label for='$nome_campo' class='block text-gray-700 font-semibold mb-1'>$nome_campo</label>
            <input type='time' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'
              class='w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2'>
          </div>";
          continue;
        }

        // Enum
        if (strpos($tipo_campo, 'enum') !== false) {
          preg_match("/enum\((.*)\)/", $tipo_campo, $matches);
          $valores = str_getcsv(str_replace("'", "", $matches[1]));
          echo "
          <div>
            <label for='$nome_campo' class='block text-gray-700 font-semibold mb-1'>$nome_campo</label>
            <select name='$nome_campo' class='w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2'>";
          foreach ($valores as $val) {
            $selected = ($id && $dados[$nome_campo] == $val) ? 'selected' : '';
            echo "<option value='$val' $selected>$val</option>";
          }
          echo "</select></div>";
          continue;
        }

        // Número
        if (strpos($tipo_campo, 'int') !== false || strpos($tipo_campo, 'decimal') !== false) {
          echo "
          <div>
            <label for='$nome_campo' class='block text-gray-700 font-semibold mb-1'>$nome_campo</label>
            <input type='number' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'
              class='w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2'>
          </div>";
          continue;
        }

        // Texto padrão
        echo "
        <div>
          <label for='$nome_campo' class='block text-gray-700 font-semibold mb-1'>$nome_campo</label>
          <input type='text' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'
            class='w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2'>
        </div>";
      }
      ?>

      <div class="text-center pt-4">
        <button type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
          <?php echo $id ? 'Salvar Alterações' : 'Cadastrar'; ?>
        </button>
      </div>
    </form>
  </div>

  <script>
    const tabela = '<?php echo $tabela; ?>';
    $('#formGenerico').on('submit', function(e) {
      e.preventDefault();
      editarRegistro(tabela);
    });
  </script>
</body>
</html>
