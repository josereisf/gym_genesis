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
<body class="bg-gray-100 text-gray-800 p-6 font-sans">

<h1 class="text-4xl font-extrabold mb-6 text-center text-gray-900">Dashboard de Testes PHP</h1>

<!-- Card de contador com barra de progresso -->
<div id="contador-card" class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-6 rounded-xl shadow-md hidden">
    <p class="font-semibold mb-2">Executando <span id="contador">0</span> testes...</p>
    <div class="w-full bg-yellow-200 rounded-full h-4">
        <div id="barra-progresso" class="bg-yellow-400 h-4 rounded-full w-0 transition-all"></div>
    </div>
</div>

<div class="flex justify-center mb-6">
    <button class="bg-green-500 text-white px-5 py-2 rounded-xl shadow hover:bg-green-600 transition-all font-semibold"
            onclick="executarTodos()">Executar Todos</button>
</div>

<div class="space-y-6">
<?php foreach ($categorias as $cat => $files): ?>
    <?php if (count($files) > 0): ?>
        <div class="bg-white rounded-2xl shadow-lg p-6 transition transform hover:-translate-y-1 hover:shadow-xl">
            <button class="w-full flex justify-between items-center font-bold text-xl mb-3 text-gray-800"
                    onclick="toggleCategoria('cat-<?= $cat ?>')">
                <span><?= ucfirst($cat) ?></span>
                <span id="icon-cat-<?= $cat ?>" class="text-2xl font-thin">+</span>
            </button>
            <div id="cat-<?= $cat ?>" class="hidden space-y-4">
                <?php foreach ($files as $arquivo): ?>
                    <div class="bg-gray-50 rounded-xl p-3 shadow-inner transition hover:shadow-md">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-mono text-gray-700"><?= htmlspecialchars($arquivo) ?></span>
                            <button class="bg-blue-500 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-600 transition-all font-medium"
                                    onclick="executarTeste('<?= htmlspecialchars($arquivo) ?>')">Executar</button>
                        </div>
                        <pre id="saida-<?= htmlspecialchars($arquivo) ?>" class="bg-gray-100 p-3 rounded-lg max-h-52 overflow-auto text-sm font-mono text-gray-800 shadow-inner"></pre>
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

// Contador global
let contadorTestes = 0;
let totalTestes = 0;

// Executar teste via AJAX
function executarTeste(arquivo) {
    contadorTestes++;
    atualizarContador();

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
        if (data.toLowerCase().includes('error') || data.toLowerCase().includes('warning')) {
            saida.classList.add('text-red-500');
        }
        saida.textContent = data;
    })
    .catch(err => {
        saida.classList.add('text-red-500');
        saida.textContent = "Erro ao executar o teste: " + err;
    })
    .finally(() => {
        contadorTestes--;
        atualizarContador();
    });
}

// Atualiza o card do contador e barra de progresso
function atualizarContador() {
    const card = document.getElementById('contador-card');
    const span = document.getElementById('contador');
    const barra = document.getElementById('barra-progresso');
    if (contadorTestes > 0 || totalTestes > 0) {
        card.classList.remove('hidden');
        span.textContent = contadorTestes;
        const progresso = totalTestes > 0 ? ((totalTestes - contadorTestes) / totalTestes) * 100 : 0;
        barra.style.width = progresso + '%';
    } else {
        card.classList.add('hidden');
        span.textContent = 0;
        barra.style.width = '0%';
        totalTestes = 0;
    }
}

// Executar todos os testes de uma vez
function executarTodos() {
    const arquivos = [
        <?php foreach ($categorias as $cat => $files): ?>
            <?php foreach ($files as $arquivo): ?>
                '<?= htmlspecialchars($arquivo) ?>',
            <?php endforeach; ?>
        <?php endforeach; ?>
    ];

    totalTestes = arquivos.length;
    arquivos.forEach(arquivo => executarTeste(arquivo));
}
</script>

</body>

</html>
