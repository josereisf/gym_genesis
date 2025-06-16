<?php
$idfuncionario = $_POST['idfuncionario'] ?? 0;  
$nome = $_POST['nome'] ?? null;  
$email = $_POST['email'] ?? null;  
$telefone = $_POST['telefone'] ?? null;  
$data_contratacao = $_POST['data'] ?? null;  
$salario = $_POST['salario'] ?? null;  
$cargo_id = $_POST['cargo_id'] ?? null;  
$imagem = $_FILES['imagem'] ?? null;  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="hidden" name="idfuncionario" value="<?= $idfuncionario ?>">
        <label for=""></label>
        <input type="text" name="nome" id="" value="<?= $idfuncionario ?>">
        <label for=""></label>
        <input type="text" name="email" value="<?= $idfuncionario ?>">
        <label for=""></label>
        <input type="text" name="telefone" value="<?= $idfuncionario ?>">
        <label for=""></label>
        <input type="date" name="data" value="<?= $idfuncionario ?>">
        <label for=""></label>
        <input type="number" name="salario" value="<?= $idfuncionario ?>">
        <label for=""></label>
        <input type="text" name="cargo_id" id="">
        <label for=""></label>
        <input type="file" name="imagem" id="">
    </form>
</body>

</html>