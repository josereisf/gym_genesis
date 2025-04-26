<?php
    require_once '../../code/funcao.php';


    $conexao = conectar();

    $input=$_POST['acao'];

    if($input == "cadastro"){

            // cadastro
        $nome = $_POST['nome'];
        $email = $_POST['user-email'];
        $senha = $_POST['senha'];
        $conf_senha = $_POST['confirmar-senha'];
        if($senha == $conf_senha){
            $sql = "INSERT INTO `usuarios`(`nome`, `email`, `senha`) VALUES ('{$nome}', '{$email}', '{$senha}')";
            mysqli_query($conexao, $sql);
            echo "<script>alert('Cadastro realizado com sucesso!')</script>";
            echo "<script>location.href='../public/index.php'</script>";
        }else{
            echo "<script>alert('As senhas não são iguais!')</script>";
            echo "<script>location.href='../index.php'</script>";
        }
    }

    if($input == "login"){
        $email= $_POST['email'];
        $senha = $_POST['senha'];

            // Exemplo simples de verificação no servidor
        if ($_POST['email'] === 'admin@example.com' && $_POST['senha'] === 'admin1234!') {
                header('Location: ../admin/index.php');
        } else {

            $sql = "SELECT * FROM `usuarios` WHERE `email` = '{$email}' AND `senha` = '{$senha}'";
            $result = mysqli_query($conexao, $sql);
            $row = mysqli_fetch_assoc($result);

            if($row['email'] == $email && $row['senha'] == $senha){
                echo "<script>alert('Login realizado com sucesso!')</script>";
                echo "<script>location.href='../public/index.php'</script>";
            }else{
                echo "<script>alert('Email ou senha incorretos!')</script>";
                echo "<script>location.href='../index.php'</script>";
            }
        }


    }

    desconectar($conexao);
    exit;


