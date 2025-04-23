<?php

$arquivo = 'funcao.php';

if (!file_exists($arquivo)) {
    die("<h2 style='color:red;'>Arquivo '$arquivo' não encontrado.</h2>");
}

$codigo = file_get_contents($arquivo);

// Captura funções
preg_match_all('/function\s+(\w+)\s*\((.*?)\)/', $codigo, $matches);

$nomes_funcoes = $matches[1];
$parametros_funcoes = $matches[2];
$total_funcoes = count($nomes_funcoes);

// Contadores por categoria
$categorias = [
    'cadastrar' => 0,
    'listar' => 0,
    'deletar' => 0,
    'editar' => 0
];

foreach ($nomes_funcoes as $nome) {
    $nome_lower = strtolower($nome);
    
    if (str_starts_with($nome_lower, 'cadastrar')) $categorias['cadastrar']++;
    elseif (str_starts_with($nome_lower, 'listar')) $categorias['listar']++;
    elseif (str_starts_with($nome_lower, 'deletar') || str_starts_with($nome_lower, 'excluir')) $categorias['deletar']++;
    elseif (str_starts_with($nome_lower, 'editar') || str_starts_with($nome_lower, 'atualizar')) $categorias['editar']++;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>📘 Lista de Funções PHP</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --cor-bg: #f2f5fa;
            --cor-primaria: #1f2d3d;
            --cor-destaque: #3498db;
            --cor-clara: #ffffff;
            --cor-hover: #e9f5ff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cor-bg);
            margin: 0;
            padding: 40px 20px;
            color: var(--cor-primaria);
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .badges {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .badge {
            background: var(--cor-clara);
            border-left: 5px solid var(--cor-destaque);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 14px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1em;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge:hover {
            background-color: var(--cor-hover);
        }

        .badge span {
            font-weight: bold;
            color: var(--cor-destaque);
        }

        table {
            width: 90%;
            max-width: 1000px;
            margin: 0 auto;
            border-collapse: separate;
            border-spacing: 0;
            background-color: var(--cor-clara);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
            animation: fadeIn 0.5s ease-in-out;
        }

        thead {
            background-color: var(--cor-primaria);
            color: white;
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
        }

        th {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        tbody tr:nth-child(even) {
            background-color: #f7f9fb;
        }

        tbody tr:hover {
            background-color: var(--cor-hover);
            transition: background-color 0.2s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .no-func {
            text-align: center;
            padding: 20px;
            color: #888;
        }
    </style>
</head>
<body>

<h1>📘 Lista de Funções Detectadas</h1>

<div class="badges">
    <div class="badge">📥 Cadastrar: <span><?= $categorias['cadastrar'] ?></span></div>
    <div class="badge">📄 Listar: <span><?= $categorias['listar'] ?></span></div>
    <div class="badge">❌ Deletar: <span><?= $categorias['deletar'] ?></span></div>
    <div class="badge">✏️ Editar: <span><?= $categorias['editar'] ?></span></div>
    <div class="badge">📊 Total: <span><?= $total_funcoes ?></span></div>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nome da Função</th>
            <th>Parâmetros</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($total_funcoes === 0): ?>
            <tr><td colspan="3" class="no-func">Nenhuma função encontrada no arquivo.</td></tr>
        <?php else: ?>
            <?php foreach ($nomes_funcoes as $i => $nome): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($nome) ?></td>
                    <td>[<?= htmlspecialchars(trim($parametros_funcoes[$i])) ?>]</td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
