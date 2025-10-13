<?php
require_once '../code/funcao.php';
$id = 0;
$tabelas = listarTabelas();
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
    <div id="dados" data-id="<?php echo $id; ?>"></div>
    <select id="tabelas">
        <option value="">Selecione uma tabela</option>
<?php
    foreach($tabelas AS $t){
      $nome_campo = $t['Tables_in_gym_genesis'];
      echo "<option value='$nome_campo'>$nome_campo</option>";
    }
?>
    </select>

    <table id="tabela-dados">
        <thead></thead>
        <tbody></tbody>
    </table>
    <script src="./js/tabelaGenerica.js"></script>
</body>

</html>
