<?php
require_once '../../code/funcao.php';


// Lê o corpo da requisição
$dados = json_decode(file_get_contents('php://input'), true);

$pedido_idpedido = $dados['pedido_idpedido'] ?? null;
$produto_idproduto = $dados['produto_idproduto'] ?? null;
$campo = $dados['campo'] ?? null;
$novo_valor = $dados['novo_valor'] ?? null;

// Validação simples
if (!$pedido_idpedido || !$produto_idproduto || !$campo || $novo_valor === null) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit;
}

// Permitindo apenas atualizar os campos corretos
$camposPermitidos = ['quantidade', 'preco_unitario'];
if (!in_array($campo, $camposPermitidos)) {
    echo json_encode(['success' => false, 'message' => 'Campo inválido']);
    exit;
}

$conexao = conectar();

// Monta o SQL dinamicamente
$sql = "UPDATE item_pedido SET {$campo} = ? WHERE pedido_idpedido = ? AND produto_idproduto = ?";
$comando = mysqli_prepare($conexao, $sql);

// Definir tipo de dados dinamicamente
$tipo = ($campo == "quantidade") ? "i" : "d"; // "i" = inteiro, "d" = double (decimal)

// Faz o bind dos parâmetros
mysqli_stmt_bind_param($comando, "{$tipo}ii", $novo_valor, $pedido_idpedido, $produto_idproduto);

$sucesso = mysqli_stmt_execute($comando);

mysqli_stmt_close($comando);
desconectar($conexao);

if ($sucesso) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar']);
}
?>
