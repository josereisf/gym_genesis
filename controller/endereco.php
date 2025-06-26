<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];
var_dump($_POST);
// $id = $_POST['id'] ?? 0;
// $nome = $_POST['nome'] ?? null;
// $senha = $_POST['senha'] ?? null;
// $email = $_POST['email'] ?? null;
// $cpf = $_POST['cpf'] ?? null;
// $data_nasc = $_POST['data_nasc'] ?? null;
// $telefone = $_POST['telefone'] ?? null;
// $tipo = $_POST['tipo'] ?? null;
// $numero_matricula = gerarNumeroMatriculaPorTipo($tipo);

// if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
//     $imagem = uploadImagem($_FILES['imagem']);
// } elseif (isset($_POST['imagem']) && (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK)) {
//     $imagem = $_POST['imagem'];
// } else {
//     $imagem = null;
// }

// switch ($acao) {
//     case 'cadastrar':
//         cadastrarEndereco($id, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $tipo);
//         break;
//     case 'editar':
//         editarEndereco($cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $tipo, $id);
//         break;
//     case 'listar':
//         listarEnderecos($tipo);
//         break;
//     case 'deletar':
//         deletarEndereco($id, $tipo);
//         break;
// }
