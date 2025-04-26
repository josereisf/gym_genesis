<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produtos</title>
    <link id="bootstrap-css" rel="stylesheet" href="../css/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>

<?php
    require_once '../../code/funcao.php';


    // Verifica se o ID foi passado corretamente na URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        editarProduto($id); // Função para editar o produto
    } else {
        echo "<p style='color: red; text-align: center;'>Erro: ID do produto inválido ou não informado.</p>";
        exit; // Para a execução do script
    }

    // Verifica se a página solicitada é 'atualizar' para exibir a tabela e redirecionar
    if (isset($_GET['pagina']) && $_GET['pagina'] === 'atualizar') {
        tabelaProdutos(); // Exibe a tabela de produtos
        echo "<script>setTimeout(() => { location.href = '../admin/index.php?pagina=tabela'; }, 1000);</script>";
    }
?>

</body>
</html>
