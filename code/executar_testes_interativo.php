<?php
$dir = __DIR__ . '/tests';
$arquivos = array_filter(scandir($dir), function($f) use ($dir) {
    return is_file("$dir/$f") && pathinfo($f, PATHINFO_EXTENSION) === 'php';
});
sort($arquivos);

// Separar por categoria
$categorias = [
    'cadastrar' => [],
    'editar' => [],
    'deletar' => [],
    'listar' => [],
    'outros' => []
];

foreach ($arquivos as $arquivo) {
    if (strpos($arquivo, 'teste_cadastrar') === 0) $categorias['cadastrar'][] = $arquivo;
    elseif (strpos($arquivo, 'teste_editar') === 0) $categorias['editar'][] = $arquivo;
    elseif (strpos($arquivo, 'teste_deletar') === 0) $categorias['deletar'][] = $arquivo;
    elseif (strpos($arquivo, 'teste_listar') === 0) $categorias['listar'][] = $arquivo;
    else $categorias['outros'][] = $arquivo;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Executar Testes PHP Interativo</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-6">

<h1 class="text-3xl font-bold mb-6 text-center">Executar Testes PHP</h1>

<div class="space-y-4">
<?php foreach ($categorias as $cat => $files): ?>
    <?php if (count($files) > 0): ?>
        <div class="bg-white rounded-xl shadow p-4">
            <button class="w-full flex justify-between items-center font-semibold text-lg mb-2"
                    onclick="toggleCategoria('cat-<?= $cat ?>')">
                <span><?= ucfirst($cat) ?></span>
                <span id="icon-cat-<?= $cat ?>">+</span>
            </button>
            <div id="cat-<?= $cat ?>" class="hidden space-y-3">
                <?php foreach ($files as $arquivo): ?>
                    <div class="border-b pb-2">
                        <div class="flex justify-between items-center mb-1">
                            <span class="font-mono text-gray-700"><?= htmlspecialchars($arquivo) ?></span>
                            <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition"
                                    onclick="executarTeste('<?= htmlspecialchars($arquivo) ?>')">Executar</button>
                        </div>
                        <pre id="saida-<?= htmlspecialchars($arquivo) ?>" class="bg-gray-100 p-2 rounded max-h-48 overflow-auto text-sm"></pre>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
</div>

<script>
// Toggle categorias
function toggleCategoria(id) {
    const div = document.getElementById(id);
    const icon = document.getElementById('icon-' + id.split('-')[1]);
    if (div.classList.contains('hidden')) {
        div.classList.remove('hidden');
        icon.textContent = '−';
    } else {
        div.classList.add('hidden');
        icon.textContent = '+';
    }
}

// Executar teste via AJAX
function executarTeste(arquivo) {
    const saida = document.getElementById('saida-' + arquivo);
    saida.textContent = "Executando...";
    saida.classList.remove('text-red-500');

    fetch('executar_teste_ajax.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'arquivo=' + encodeURIComponent(arquivo)
    })
    .then(response => response.text())
    .then(data => {
        // Detecta erros simples do PHP na saída
        if (data.toLowerCase().includes('error') || data.toLowerCase().includes('warning')) {
            saida.classList.add('text-red-500');
        }
        saida.textContent = data;
    })
    .catch(err => {
        saida.classList.add('text-red-500');
        saida.textContent = "Erro ao executar o teste: " + err;
    });
}
</script>

</body>
</html>
