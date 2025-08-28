<?php
require_once "../php/verificarLogado.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Categoria Produto</title>
</head>
<body>
    <form action="" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" id="nome"><br>
        <label for="descricao">Descrição</label><br>
        <input type="text" name="descricao" id="descricao"><br><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>