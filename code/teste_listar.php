<?php
$arquivo = 'funcao.php';

// Verificar se o arquivo existe
if (!file_exists($arquivo)) {
    die("<h2 style='color:red;'>Arquivo '$arquivo' não encontrado.</h2>");
}

// Ler o conteúdo do arquivo
$codigo = file_get_contents($arquivo);

// Captura funções no formato 'function nome($parametros)'
preg_match_all('/function\s+(\w+)\s*\((.*?)\)/', $codigo, $matches);

// Verifica se a captura foi bem-sucedida
$nomes_funcoes = $matches[1] ?? [];
$parametros_funcoes = $matches[2] ?? [];
$total_funcoes = count($nomes_funcoes);

// Verifica se funções foram encontradas
if ($total_funcoes === 0) {
    die("<h2 style='color:red;'>Nenhuma função encontrada no arquivo '$arquivo'.</h2>");
}

// Inicialização dos contadores e categorias
$categorias = [
    'cadastrar' => 0,
    'listar' => 0,
    'deletar' => 0,
    'editar' => 0
];

$funcoes_por_categoria = [
    'cadastrar' => [],
    'listar' => [],
    'deletar' => [],
    'editar' => []
];

// Processamento das funções encontradas
foreach ($nomes_funcoes as $i => $nome) {
    $nome_lower = strtolower($nome);
    $parametros = trim($parametros_funcoes[$i]);

    // Informações sobre a função
    $info_funcao = [
        'nome' => $nome,
        'parametros' => $parametros
    ];

    // Verificação e categorização
    if (str_starts_with($nome_lower, 'cadastrar')) {
        $categorias['cadastrar']++;
        $funcoes_por_categoria['cadastrar'][] = $info_funcao;
    } elseif (str_starts_with($nome_lower, 'listar')) {
        $categorias['listar']++;
        $funcoes_por_categoria['listar'][] = $info_funcao;
    } elseif (str_starts_with($nome_lower, 'deletar') || str_starts_with($nome_lower, 'excluir')) {
        $categorias['deletar']++;
        $funcoes_por_categoria['deletar'][] = $info_funcao;
    } elseif (str_starts_with($nome_lower, 'editar') || str_starts_with($nome_lower, 'atualizar')) {
        $categorias['editar']++;
        $funcoes_por_categoria['editar'][] = $info_funcao;
    } else {
        // Caso a função não se encaixe nas categorias, podemos fazer um log ou categorizá-la como 'outras'
        // Isso ajuda a identificar funções não categorizadas automaticamente
        echo "<h3>Função '$nome' não categorizada automaticamente. Parâmetros: $parametros</h3>";
    }
}

// Exibição dos resultados das categorias
echo "<h2>Funções encontradas e categorizadas:</h2>";
echo "<pre>";
print_r($categorias);
echo "</pre>";

// Exibe as funções agrupadas por categoria
echo "<h2>Funções por Categoria:</h2>";
echo "<pre>";
print_r($funcoes_por_categoria);
echo "</pre>";
?>
