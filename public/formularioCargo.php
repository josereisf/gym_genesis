<?php

require_once "../code/funcao.php";
require_once "../php/verificarLogado.php";

if (isset($_GET['idcargo'])){
$idcargo = $_GET['idcargo'];
$resultados = listarCargo($idcargo);
$nome = $resultados[0]['nome'];
$descricao = $resultados[0]['descricao'];
$acao = "editar";
}
else {
$idcargo = 0;
$nome = '';
$descricao = '';
$acao = "cadastrar";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="api/index.php?entidade=cargo&acao=<?= $acao ?>" method="post">
        <input type="hidden" name="idcargo" id="" value="<?= $idcargo ?>">
        <label for="">Nome</label>
        <input type="text" name="nome" id="" value="<?= $nome ?>"><br>
        <label for="">Descrição:</label>
<textarea name="descricao" id="" ><?= $descricao ?></textarea>        
<input type="submit" value="<?= $acao ?>">
    </form>
</body>
</html>