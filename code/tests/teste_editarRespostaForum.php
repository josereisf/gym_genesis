<?php

require_once __DIR__ . '/../funcao.php';

// ID da resposta que você quer editar (PK da tabela resposta_forum)
$idresposta = 1;

// Novos valores
$mensagem = "Mensagem editada com sucesso!";
$usuario_id = 2;  // id de algum usuário que exista na tabela usuario
$forum_id   = 3;  // id de algum tópico que exista na tabela forum

// Executa a função
$resposta = editarRespostaForum($idresposta, $mensagem, $usuario_id, $forum_id);

if ($resposta) {
    echo "✅ Resposta editada com sucesso!";
} else {
    echo "❌ Erro ao editar a resposta.";
}
