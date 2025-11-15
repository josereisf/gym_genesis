<?php
require_once __DIR__ . '/../code/funcao.php';
$tabela = $_REQUEST['entidade'] ?? null;
$acao = $_REQUEST['acao'] ?? null;

// Detectar se é AJAX/fetch enviando JSON
$isJson = isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false;

// Ler inputs
if ($isJson) {
    header('Content-Type: application/json; charset=utf-8');
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
} else {
    $input = $_POST;

    $redir = header("Location: /public/sucesso.php?tabela=$tabela");
}
$idproduto = $input['idproduto'] ?? null;
$nome = $input['nome'] ?? null;
$descricao = $input['descricao'] ?? null;
$preco = $input['preco'] ?? null;
$quantidade_estoque = $input['quantidade_estoque'] ?? null;

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['imagem']);
} else {
    $imagem = $input['imagem'];
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
