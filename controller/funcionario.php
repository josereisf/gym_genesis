<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idfuncionario = $_POST['idfuncionario'] ?? 0;
$nome = $_POST['nome'] ?? null;
$email = $_POST['email'] ?? null;
$telefone = $_POST['telefone'] ?? null;
$data_contratacao = $_POST['data'] ?? null;
$salario = $_POST['salario'] ?? null;
$cargo_id = $_POST['cargo_id'] ?? null;

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['imagem']);
} elseif (isset($_POST['imagem']) && (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK)) {
    $imagem = $_POST['imagem'];
} else {
    $imagem = null;
}

switch ($acao) {
    case 'cadastrar':
        cadastrarFuncionario($nome, $email, $telefone, $data_contratacao, $salario, $cargo_id, $imagem);
        break;
    case 'editar':
        editarFuncionario($idfuncionario, $nome, $email, $telefone, $data_contratacao, $salario, $cargo_id, $imagem);
        break;
    case 'listar':
        listarFuncionarios($idfuncionario);
        break;
    case 'deletar':
        deletarFuncionario($idfuncionario);
        break;
}
