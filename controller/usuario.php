<?php
require_once __DIR__ .'/../code/funcao.php';
$acao = $_GET ['acao'];

$idusuario = $_POST['idusuario'] ?? 0;
$nome = $_POST['nome'] ?? null;
$senha = $_POST['senha'] ?? null;
$email = $_POST['email'] ?? null;
$cpf = $_POST['cpf'] ?? null;
$data_nasc = $_POST['data_nasc'] ?? null;
$telefone = $_POST['telefone'] ?? null;
$numero_matricula = $_POST['numero_matricula'] ?? null;
$tipo = $_POST['tipo'] ?? null;
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['imagem']);
} elseif (isset($_POST['imagem']) && (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK)) {
    $imagem = $_POST['imagem'];
} else {
    $imagem = null;
}

switch ($acao){
    case 'cadastrar':
        cadastrarUsuario($nome, $senha, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo);
    case 'editar':
        editarUsuario($nome, $senha, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo, $idusuario);
    case 'listar':
        listarUsuario($idusuario);
    case 'deletar':
        deletarUsuario($idusuario);
}