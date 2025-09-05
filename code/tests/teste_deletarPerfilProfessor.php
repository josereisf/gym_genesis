<?php
require_once __DIR__ . '/../funcao.php';

$idusuario = 6;

// Chame a função para deletar
$resultado = deletarPerfilUsuario($idusuario);

// Verifica se deu certo
if ($resultado === false) {
    // Pega a conexão do MySQL para mostrar o erro
    $conexao = conectar();
    echo "Erro ao deletar usuário: " . mysqli_error($conexao);
    desconectar($conexao);
} else {
    echo "Usuário deletado com sucesso!";
}
