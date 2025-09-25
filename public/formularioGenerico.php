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
    <form action="" method="post" ></form>
    <?php foreach($colunas AS $c){
        if (strpos($c['Field'], "id") !== False){
            echo '';
        }
    ?>
        
    <?php } ?>

</body>
</html>