<?php
// ==========================
// salvar.php
// ==========================

// Evita que warnings/notices quebrem o JSON
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

// Caminho do arquivo JSON
$arquivo = __DIR__ . '/checklist.json';
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, "{}");
}

// Recebe os dados do corpo da requisição (JSON)
$input = json_decode(file_get_contents('php://input'), true);

// Validação da entrada
if ($input === null) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Nenhum dado recebido ou JSON inválido.']);
    exit;
}

// Tenta salvar o JSON no arquivo
if (file_put_contents($arquivo, json_encode($input, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false) {
    // Gera Markdown a partir do JSON
    gerarMarkdown($input);
    echo json_encode(['sucesso' => true, 'mensagem' => 'Checklist salvo com sucesso!']);
} else {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao salvar o arquivo. Verifique permissões.']);
}

// ==========================
// Função para gerar Markdown
// ==========================
function gerarMarkdown($data) {
    $md = "# 🧭 Checklist de Melhorias do Projeto\n\n";

    foreach ($data as $secao => $conteudo) {
        $md .= "## " . $secao . "\n\n";

        foreach ($conteudo['tarefas'] as $t) {
            $md .= "- [" . ($t['feito'] ? 'x' : ' ') . "] " . $t['texto'] . "\n";
        }

        if (!empty($conteudo['comentario'])) {
            $md .= "\n💬 **Comentário:** " . $conteudo['comentario'] . "\n";
        }

        $md .= "\n---\n";
    }

    file_put_contents(__DIR__ . '/checklist.md', $md);
}
?>
