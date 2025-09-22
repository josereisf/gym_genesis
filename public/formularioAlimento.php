<?php
require_once '../code/funcao.php';
require_once "../php/verificarLogado.php";
require_once "../php/verificarPermissaoAdm.php";

if (isset($_GET['idalimento'])) {
    $idalimento = $_GET['idalimento'];
    $resultados = listarAlimentos($idalimento);
    $nome = $resultados[0]['nome'];
    $calorias = $resultados[0]['calorias'];
    $carboidratos = $resultados[0]['carboidratos'];
    $proteinas = $resultados[0]['proteinas'];
    $gorduras = $resultados[0]['gorduras'];
    $porcao = $resultados[0]['porcao'];
    $categoria = $resultados[0]['categoria'];
    $imagem = $resultados[0]['foto_de_perfil'];
    $acao = 'editar';
} else {
    $idalimento = 0;
    $nome = '';
    $calorias = '';
    $carboidratos = '';
    $proteinas = '';
    $gorduras = '';
    $porcao = '';
    $categoria = '';
    $imagem = '';
    $acao = 'cadastrar';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="api/index.php?entidade=alimento&acao=<?= $acao ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idalimento" value='<?= $idalimento ?>'><br>
        <label for="">Nome:</label>
        <input type="text" name="nome" id="" value='<?= $nome ?>'><br>
        <label for="">Quantidade de calorias:</label>
        <input type="number" name="calorias" id="" value='<?= $calorias ?>'><br>
        <label for="">Carboidratos:</label>
        <input type="number" name="carboidratos" id="" value='<?= $carboidratos ?>'><br>
        <label for="">Proteinas:</label>
        <input type="number" name="proteinas" id="" value='<?= $proteinas ?>'><br>
        <label for="">Gorduras:</label>
        <input type="number" name="gorduras" id="" value='<?= $gorduras ?>'><br>
        <label for="">Porção:</label>
        <input type="text" name="porcao" id="" value='<?= $porcao ?>'><br>
        <label for="">Categoria</label>
        <input type="text" name="categoria" id="" value='<?= $categoria ?>'><br>
        <label for="">Imagem do alimento</label>
        <?php
        if (!empty($imagem)) {
            echo "<img src='uploads/$imagem' alt='$imagem'>";
            echo "<input type='hidden' name='imagem' value='$imagem'>";
            echo "<br>";
        }
        ?>
        <input type="file" name="imagem" id=""><br>
        <input type="submit" value='<?= $acao ?>'>
    </form>
</body>

</html>