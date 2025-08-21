<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idproduto = $input['idproduto'] ?? null;
$nome = $input['nome'] ?? null;
$descricao = $input['descricao'] ?? null;
$preco = $input['preco'] ?? null;
$quantidade_estoque = $input['qtd'] ?? null;

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['imagem']);
} elseif (isset($input['imagem']) && (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK)) {
    $imagem = $input['imagem'];
} else {
    $imagem = null;
}

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        if (!$nome || !$descricao || !$preco || !$quantidade_estoque) {
            enviarResposta(false, 'Todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = cadastrarProduto($nome, $descricao, $preco, $quantidade_estoque, $imagem);
        if ($ok) {
            enviarResposta(true, 'Produto cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar produto');
        }
        break;

    case 'editar':
        if (!$idproduto || !$nome || !$descricao || !$preco || !$quantidade_estoque) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarProduto($idproduto, $nome, $descricao, $preco, $quantidade_estoque, $imagem);
        if ($ok) {
            enviarResposta(true, 'Produto editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar produto');
        }
        break;

    case 'listar':
        $dados = listarProdutos($idproduto);
        if ($dados) {
            enviarResposta(true, 'Produtos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar produtos');
        }
        break;

    case 'deletar':
        if (!$idproduto) {
            enviarResposta(false, 'ID do produto não informado');
        }
        $ok = deletarProduto($idproduto);
        if ($ok) {
            enviarResposta(true, 'Produto deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar produto');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
        break;
}
