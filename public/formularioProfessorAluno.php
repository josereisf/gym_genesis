<?php
require_once "../code/funcao.php";
$idaluno = $_SESSION["id"] ?? 0;
$professores = listarUsuarioTipo(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="api/index.php?entidade=professoraluno&acao=cadastrar" method="get">
        <label>Professores</label><br>
            <?php
            foreach($professores AS $p){
            echo '<input type="radio" name="idprofessor" value="'.$p['idusuario'].'">'. $p['nome'];
            echo '<br>';
            }
            ?>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>