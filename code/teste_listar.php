<?php

$arquivo = 'funcao.php';

if (!file_exists($arquivo)) {
    die("<h2 style='color:red;'>Arquivo '$arquivo' não encontrado.</h2>");
}

$codigo = file_get_contents($arquivo);

// Captura todas as funções
preg_match_all('/function\s+(\w+)\s*\((.*?)\)/', $codigo, $matches);

$nomes_funcoes = $matches[1];
$parametros_funcoes = $matches[2];
$total_funcoes = count($nomes_funcoes);

// Inicializa os contadores por categoria
$cadastrar = 0;
$listar = 0;
$deletar = 0;
$editar = 0;

foreach ($nomes_funcoes as $nome) {
    $nome_lower = strtolower($nome);
    
    if (str_starts_with($nome_lower, 'cadastrar')) {
        $cadastrar++;
    } elseif (str_starts_with($nome_lower, 'listar')) {
        $listar++;
    } elseif (str_starts_with($nome_lower, 'deletar') || str_starts_with($nome_lower, 'excluir')) {
        $deletar++;
    } elseif (str_starts_with($nome_lower, 'editar') || str_starts_with($nome_lower, 'atualizar')) {
        $editar++;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>🔍 Lista de Funções PHP</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #e8f0ff, #f4f6fb);
            margin: 0;
            padding: 40px 20px;
        }

        h1 {
            text-align: center;
            color: #1f2d3d;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .contador {
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 30px;
            color: #34495e;
        }

        table {
            width: 90%;
            max-width: 1000px;
            margin: 0 auto;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
            animation: fadeIn 0.5s ease-in-out;
        }

        thead {
            background-color: #1f2d3d;
            color: white;
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
            font-size: 1em;
        }

        th {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        tbody tr:nth-child(even) {
            background-color: #f4f7fb;
        }

        tbody tr:hover {
            background-color: #e0f0ff;
            transition: background-color 0.2s ease-in-out;
        }

        td {
            color: #2c3e50;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<h1>📘 Lista de Todas as Funções PHP</h1>
<div class="contador">
    Total de funções: <strong><?= $total_funcoes ?></strong><br>
    📥 Cadastrar: <strong><?= $cadastrar ?></strong> |
    📄 Listar: <strong><?= $listar ?></strong> |
    ❌ Deletar: <strong><?= $deletar ?></strong> |
    ✏️ Editar: <strong><?= $editar ?></strong>
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
            <tr><td colspan="3" style="text-align: center;">Nenhuma função encontrada no arquivo.</td></tr>
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
