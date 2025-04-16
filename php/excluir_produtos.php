<?php

    require_once 'funcao.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        excluirProduto($id);
        echo "<scritp>alert('Produto Excluido!')</script>";
        echo "<script>location.href = 'index.php?pagina=tabela'</script>";


    } else {
        echo "<scritp>alert('Produto não encontrado!')</script>";
        echo "<script>location.href = 'index.php?pagina=tabela'</script>";
    }
