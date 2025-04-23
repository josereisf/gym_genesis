<?php

$arquivo = 'funcao.php'; // Altere para o caminho correto

if (!file_exists($arquivo)) {
    die("<h2 style='color:red;'>Arquivo '$arquivo' não encontrado.</h2>");
}

$codigo = file_get_contents($arquivo);

// Regex para capturar qualquer função
preg_match_all('/function\s+(\w+)\s*\((.*?)\)/', $codigo, $matches);

$nomes_funcoes = $matches[1];
$parametros_funcoes = $matches[2];
$total_funcoes = count($nomes_funcoes);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Funções</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        .contador {
            text-align: center;
            font-size: 1.1em;
            margin-bottom: 20px;
            color: #34495e;
        }
        table {
            width: 85%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        thead {
            background-color: #2c3e50;
            color: white;
        }
        th, td {
            padding: 12px 16px;
            text-align: left;
        }
        tbody tr:nth-child(even) {
            background-color: #f0f3f7;
        }
        tbody tr:hover {
            background-color: #e2efff;
        }
    </style>
</head>
<body>

<h1>📘 Lista de Todas as Funções</h1>
<div class="contador">
    Total de funções encontradas: <strong><?= $total_funcoes ?></strong>
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
            <tr><td colspan="3">Nenhuma função encontrada no arquivo.</td></tr>
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
