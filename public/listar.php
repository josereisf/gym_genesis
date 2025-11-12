<?php
require_once '../code/funcao.php';
$id = 0;
$tabelas = listarTabelas();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Consulta de Tabelas</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="./css/tabela.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />

  <!-- CSS do DataTables (CDN) -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"
        onerror="this.onerror=null;this.href='./css/dataTable.css';">

    <!-- jQuery (CDN com fallback local) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        if (typeof jQuery === "undefined") {
            document.write('<script src="./js/jquery-3.7.1.min.js"><\/script>');
        }
    </script>

    <!-- DataTables (CDN com fallback local) -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        if (typeof $.fn.DataTable === "undefined") {
            document.write('<script src="./js/dataTables.min.js"><\/script>');
        }
    </script>
    <!-- DataTables Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>

<body>
  <div class="container">
    <h1>Consulta de Tabelas</h1>

    <div id="dados" data-id="<?php echo $id; ?>"></div>

    <select id="tabelas">
      <option value="" selected disabled>Selecione uma tabela</option>
<?php
foreach ($tabelas as $t) {
    $nome_campo = htmlspecialchars($t['Tables_in_gym_genesis']);
    echo '<option value="' . $nome_campo . '">' . $nome_campo . '</option>';
}
?>

    </select>

<table id="tabela-dados" class="display" style="width:100%">
  <thead></thead>
  <tbody></tbody>
</table>


  </div>

  <!-- JS -->
  <script src="./js/tabelaGenerica.js"></script>
</body>

</html>
