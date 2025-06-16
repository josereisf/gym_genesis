<?php
require_once __DIR__ .'/../code/funcao.php';
$acao = $_GET ['acao'];

$idfuncionario = $_POST['idfuncionario'] ?? 0;  
$nome = $_POST['nome'] ?? null;  
$email = $_POST['email'] ?? null;  
$telefone = $_POST['telefone'] ?? null;  
$data_contratacao = $_POST['data_contratacao'] ?? null;  
$salario = $_POST['salario'] ?? null;  
$cargo_id = $_POST['cargo_id'] ?? null;   

if (isset($_FILES['imagem'])){
    $imagem = uploadImagem($_FILES['imagem']);
}
elseif (isset($_POST['imagem']) and !isset($_FILES['imagem'])) {
    $imagem = $_POST['imagem'];
}
else {
    $imagem = null;
}

switch ($acao){
    case 'cadastrar':
        cadastrarFuncionario($nome, $email, $telefone, $data_contratacao, $salario, $cargo_id, $imagem);
    case 'editar':
        editarFuncionario($idfuncionario, $nome, $email, $telefone, $data_contratacao, $salario, $cargo_id, $imagem);
    case 'listar':
        listarFuncionarios($idusuario);
    case 'deletar':
        deletarFuncionario($idusuario);
}