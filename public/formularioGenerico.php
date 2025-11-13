<?php
require_once __DIR__ . "/../code/funcao.php";
require_once __DIR__ . "/./php/verificarLogado.php";

$idprincipal = $_SESSION['id'];
$id = $_GET['id'] ?? null;
$tipo = $_SESSION['tipo'];
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
  <title>Formulário - Gym Genesis</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./js/formularioGenerico.js"></script>

  <style>
    body {
      background: linear-gradient(135deg, #0a0a0a, #121212);
      font-family: 'Inter', sans-serif;
      color: #e5e7eb;
    }

    .card {
      background: #181818;
      border: 1px solid #2a2a2a;
      box-shadow: 0 0 25px rgba(0, 224, 255, 0.08);
      transition: all 0.3s ease;
    }

    .card:hover {
      box-shadow: 0 0 35px rgba(0, 224, 255, 0.15);
    }

    label {
      color: #cbd5e1;
    }

    input,
    select,
    textarea {
      background-color: #1f1f1f;
      border: 1px solid #333;
      color: #f3f4f6;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus,
    select:focus,
    textarea:focus {
      border-color: #00e0ff;
      box-shadow: 0 0 6px #00e0ff;
      outline: none;
    }

    .btn-neon {
      background: linear-gradient(90deg, #00e0ff, #0099ff);
      color: #fff;
      transition: 0.3s;
      box-shadow: 0 0 15px rgba(0, 224, 255, 0.3);
    }

    .btn-neon:hover {
      background: linear-gradient(90deg, #00c0ff, #0077ff);
      box-shadow: 0 0 25px rgba(0, 224, 255, 0.6);
    }

    .form-title {
      background: linear-gradient(90deg, #00e0ff, #0077ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: 1px;
      text-shadow: 0 0 10px rgba(0, 224, 255, 0.4);
    }

    img {
      border: 2px solid #00e0ff;
      box-shadow: 0 0 10px rgba(0, 224, 255, 0.3);
    }

    .divider {
      height: 2px;
      background: linear-gradient(90deg, transparent, #00e0ff, transparent);
      margin: 1.5rem 0;
      border-radius: 50%;
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center p-6">

  <div id="dados" data-tabela="<?php echo $tabela; ?>" data-id="<?php echo $id; ?>"></div>

  <div class="card rounded-2xl p-8 w-full max-w-3xl">
    <h1 class="text-3xl font-bold text-center form-title mb-6 uppercase tracking-wider">
      <?php echo $id ? 'Editar Registro' : 'Cadastrar Novo Registro'; ?>
    </h1>

    <div class="divider"></div>

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
          $ignorar = ["forum", "perfil_usuario", "pagamento_detalhe", "perfil_professor", "meta_usuario", "treino", "pedido"];
          if ($tipo === 0) {
            $ignorar = [];
          }
          if (in_array($tabela, $ignorar)) continue;
          else {
            echo "
              <div>
                <label for='$nome_campo' class='block font-semibold mb-1'>$nome_campo</label>
                <select name='$nome_campo' class='chaveEstrangeira w-full rounded-lg p-2' 
                  data-tabela='$tabela' data-campo='$nome_campo' data-ideditar='" . ($id ? $dados[$nome_campo] : '') . "'>
                </select>
              </div>
            <script>preencherChavesEstrangeiras()</script>";
          }
          continue;
        }

        // Campo senha
        if (strpos($nome_campo, "senha") !== false) {
          echo "
          <div>
            <label for='$nome_campo' class='block font-semibold mb-1'>$nome_campo</label>
            <input type='password' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'
              onfocus=\"this.type='text'\" onblur=\"this.type='password'\"
              class='w-full rounded-lg p-2' readonly>
          </div>";
          continue;
        }

        // Foto / imagem
        if (strpos($nome_campo, 'foto') !== false || strpos($nome_campo, 'imagem') !== false) {
          echo "
          <div>
            <label for='$nome_campo' class='block font-semibold mb-1'>Foto</label>
            <input type='file' name='$nome_campo' class='w-full text-gray-200'>
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
            <label for='$nome_campo' class='block font-semibold mb-1'>$nome_campo</label>
            <textarea name='$nome_campo' rows='4' class='w-full rounded-lg p-2'>" . ($id ? $dados[$nome_campo] : '') . "</textarea>
          </div>";
          continue;
        }

        // Data
        if (strpos($tipo_campo, 'date') !== false && strpos($tipo_campo, 'time') === false) {
          echo "
          <div>
            <label for='$nome_campo' class='block font-semibold mb-1'>$nome_campo</label>
            <input type='date' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'
              class='w-full rounded-lg p-2'>
          </div>";
          continue;
        }

        // Hora
        if (strpos($tipo_campo, 'time') !== false && strpos($tipo_campo, 'stamp') === false && strpos($tipo_campo, 'date') === false) {
          echo "
          <div>
            <label for='$nome_campo' class='block font-semibold mb-1'>$nome_campo</label>
            <input type='time' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'
              class='w-full rounded-lg p-2'>
          </div>";
          continue;
        }

        // Enum
        if (strpos($tipo_campo, 'enum') !== false) {
          preg_match("/enum\((.*)\)/", $tipo_campo, $matches);
          $valores = str_getcsv(str_replace("'", "", $matches[1]));
          echo "
          <div>
            <label for='$nome_campo' class='block font-semibold mb-1'>$nome_campo</label>
            <select name='$nome_campo' class='w-full rounded-lg p-2'>";
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
            <label for='$nome_campo' class='block font-semibold mb-1'>$nome_campo</label>
            <input type='number' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'
              class='w-full rounded-lg p-2'>
          </div>";
          continue;
        }

        // Texto padrão
        echo "
        <div>
          <label for='$nome_campo' class='block font-semibold mb-1'>$nome_campo</label>
          <input type='text' name='$nome_campo' value='" . ($id ? $dados[$nome_campo] : '') . "'
            class='w-full rounded-lg p-2'>
        </div>";
      }
      ?>

      <div class="text-center pt-6">
        <button type="submit"
          class="btn-neon text-white font-semibold px-8 py-2 rounded-lg shadow-md uppercase tracking-wider">
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
