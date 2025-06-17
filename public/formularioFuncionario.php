<?php
require_once '../code/funcao.php';

if (isset($_GET['idfuncionario'])) {
    $idfuncionario = $_GET['idfuncionario'];
    $resultados = json_decode(listarFuncionarios($idfuncionario), JSON_UNESCAPED_UNICODE);
    $nome = $resultados[0]['nome'];
    $email = $resultados[0]['email'];
    $telefone = $resultados[0]['telefone'];
    $data_contratacao = $resultados[0]['data_contratacao'];
    $salario = $resultados[0]['salario'];
    $cargo_id = $resultados[0]['cargo_id'];
    $imagem = $resultados[0]['foto_de_perfil'];
    $acao = 'editar';
} else {
    $idfuncionario = 0;
    $nome = '';
    $email = '';
    $telefone = '';
    $data_contratacao = '';
    $salario = 0;
    $cargo_id = 0;
    $imagem = 0;
    $acao = 'cadastrar';
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
    <form action="api/index.php?entidade=funcionario&acao=<?= $acao ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idfuncionario" value="<?= $idfuncionario ?>">
        <label for="">Nome:</label>
        <input type="text" name="nome" id="" value="<?= $nome ?>">
        <label for="">Email:</label>
        <input type="text" name="email" value="<?= $email ?>">
        <label for="">Telefone:</label>
        <input type="text" name="telefone" value="<?= $telefone ?>">
        <label for="">Data:</label>
        <input type="date" name="data" value="<?= $data_contratacao ?>">
        <label for="">Salário:</label>
        <input type="number" name="salario" value="<?= $salario ?>">
        <label for="">Cargo:</label>
        <select name="cargo_id" id="">
            <?php
            $idcargo = 0;
            $cargos = listarCargo($idcargo);
            foreach ($cargos as $c) {
                if ($c['idcargo'] == $idcargo) {
                    $selecionado = 'selected';
                } else {
                    $selecionado = 0;
                }
                echo "<option value='" . $c['idcargo'] . "' $selecionado>" . $c['nome'] . "</option>";
            }
            ?>
        </select>
        <label for="">Foto do funcionário:</label>
        <?php
        if (!empty($imagem)) {
            echo "<img src='uploads/$imagem' alt='$imagem'>";
            echo "<input type='hidden' name='imagem' value='$imagem'>";
        }
        ?>
        <input type="file" name="imagem" id="imagem" accept="image/*">
        <input type="submit" value="<?= $acao ?>">
    </form>
</body>

</html>