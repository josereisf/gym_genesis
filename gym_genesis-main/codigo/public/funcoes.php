<?php

function cadatrarUsuario($conexao, $nome, $senha, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo){
    $sql = 'INSERT INTO usuario (nome, senha, email, cpf, data_de_nascimento, telefone, foto_de_perfil, numero_matricula, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssssssssi', $nome, $senha, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo);
    
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}
function editarUsuario($conexao, $idusuario, $nome, $senha, $email, $cpf, $data_de_nascimento, $telefone, $foto_de_perfil, $numero_matricula, $tipo_usuario){
    $sql = '';
    $comando = mysqli_prepare($conexao ,$sql);
    mysqli_stmt_bind_param($comando, 'ssssssssi', $nome, $senha, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo);
    
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
    }