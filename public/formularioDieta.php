<?php

require_once "../code/funcao.php";
require_once "../php/verificarLogado.php";
require_once "../php/verificarPermissaoAdm.php";

if (isset($_GET['iddieta'])){
$iddieta = $_GET['iddieta'];
$resultados = listarDietas($iddieta);
$descricao = $resultados[0]['descricao'];
$data_inicio = $resultados[0]['data_inicio'];
$data_fim = $resultados[0]['data_fim'];
$idusuario = $resultados[0]['idusuario'];
$acao = "editar";
}
else {
$iddieta = 0;
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
    <form action="api/index.php?entidade=dieta&acao=<?= $acao ?>" method="post">
        <input type="hidden" name="iddieta" value="<?= $iddieta  ?>"><br>
        <label for="">Descrição:</label>
        <input type="text" name="descricao" value="<?= $descricao  ?>"><br>
        <label for="">Inicio:</label>
        <input type="date" name="data_inicio" value="<?= $data_inicio  ?>"><br>
        <label for="">Fim:</label>
        <input type="date" name="data_fim" value="<?= $data_fim  ?>"><br>
        <label for="">Aluno:</label>
        <select name="idusuario" id="">
            <?php
            $idusuario2 = 0;
            $usuarios = listarUsuario($idusuario2);
            foreach ($usuarios as $u) {
                if ($u['idusuario'] == $idusuario) {
                    $selecionado = 'selected';
                } else {
                    $selecionado = 0;
                }
                echo "<option value='" . $u['idusuario'] . "' $selecionado>" . $u['nome'] . "</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="<?= $acao?>">
    </form>
</body>
</html>