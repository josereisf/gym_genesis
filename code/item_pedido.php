<?php
require_once "../funcao.php"; // ajuste o caminho conforme necessário

// Coletar dados do formulário
$usuario_id = $_GET['usuario_id'] ?? null;
$status = $_GET['status'] ?? null;
$data_inicio = $_GET['data_inicio'] ?? null;
$data_fim = $_GET['data_fim'] ?? null;
$produto_nome = $_GET['produto_nome'] ?? null;
$preco_min = $_GET['preco_min'] ?? null;
$preco_max = $_GET['preco_max'] ?? null;

$pedidos = [];

$temAlgumFiltro = !empty($usuario_id) || !empty($status) || !empty($data_inicio) || !empty($data_fim) || !empty($produto_nome) || !empty($preco_min) || !empty($preco_max);

if ($temAlgumFiltro) {
    $pedidos = listarItemPedidosComFiltros(
        !empty($usuario_id) ? (int) $usuario_id : null,
        $status ?: null,
        $data_inicio ?: null,
        $data_fim ?: null,
        $produto_nome ?: null,
        $preco_min ?: null,
        $preco_max ?: null
    );
} else {
    // Nenhum filtro foi preenchido: listar todos os pedidos
    $pedidos = listarItemPedido($usuario_id); // Você pode ajustar aqui se quiser listar todos, ou apenas de um usuário padrão
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Filtrar Pedidos</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #6366f1;
            --bg-color: #f9fafb;
            --text-color: #1f2937;
            --table-header: #e5e7eb;
            --border-radius: 12px;
            --shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            padding: 40px 20px;
            max-width: 1000px;
            margin: auto;
        }

        h2 {
            font-size: 28px;
            color: var(--primary-color);
            margin-bottom: 24px;
        }

        form {
            background: white;
            padding: 24px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            display: grid;
            gap: 16px;
        }

        form>div {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        label {
            font-weight: 600;
            margin-right: 8px;
        }

        input,
        select {
            flex: 1;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: var(--border-radius);
            font-size: 14px;
            transition: border 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
        }

        button {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: bold;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: linear-gradient(90deg, #4338ca, #6366f1);
            transform: scale(1.03);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 32px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        th,
        td {
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background-color: var(--table-header);
            font-size: 14px;
            font-weight: 600;
        }

        td {
            font-size: 14px;
            color: #374151;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f3f4f6;
        }

        @media (max-width: 768px) {
            form>div {
                flex-direction: column;
                align-items: stretch;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #e5e7eb;
                border-radius: var(--border-radius);
                padding: 12px;
            }

            td {
                padding: 10px;
                border: none;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                margin-bottom: 4px;
            }
        }
    </style>

</head>

<body>

    <h2>Filtro de Pedidos</h2>
    <form method="GET">
        <div>
            <label>ID do Usuário:</label>
            <input type="number" name="usuario_id" value="<?= htmlspecialchars($usuario_id ?? '') ?>">
        </div>
        <div>
            <label>Status:</label>
            <select name="status">
                <option value="">Todos</option>
                <option value="processando" <?= $status === 'processando' ? 'selected' : '' ?>>Processando</option>
                <option value="enviado" <?= $status === 'enviado' ? 'selected' : '' ?>>Enviado</option>
                <option value="concluído" <?= $status === 'concluído' ? 'selected' : '' ?>>Concluído</option>
            </select>
        </div>
        <div>
            <label>Data Início:</label>
            <input type="date" name="data_inicio" value="<?= htmlspecialchars($data_inicio ?? '') ?>">
            <label>Data Fim:</label>
            <input type="date" name="data_fim" value="<?= htmlspecialchars($data_fim ?? '') ?>">
        </div>
        <div>
            <label>Nome do Produto:</label>
            <input type="text" name="produto_nome" value="<?= htmlspecialchars($produto_nome ?? '') ?>">
        </div>
        <div>
            <label>Preço Mínimo:</label>
            <input type="number" step="0.01" name="preco_min" value="<?= htmlspecialchars($preco_min ?? '') ?>">
            <label>Preço Máximo:</label>
            <input type="number" step="0.01" name="preco_max" value="<?= htmlspecialchars($preco_max ?? '') ?>">
        </div>
        <button type="submit">Filtrar</button>
    </form>

    <?php if (!empty($pedidos)): ?>
        <h3>Resultados dos Pedidos<?= $usuario_id ? " do Usuário #$usuario_id" : "" ?></h3>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Nome do Usuário</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Status</th>
                        <th>Data do Pedido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $p): ?>
                        <tr>
                            <td data-label="ID Pedido"><?= htmlspecialchars($p['idpedido']) ?></td>
                            <td data-label="Nome do Usuário"><?= htmlspecialchars($p['usuario_nome']) ?></td>
                            <td data-label="Produto"><?= htmlspecialchars($p['produto_nome']) ?></td>
                            <td data-label="Quantidade"><?= (int) $p['quantidade'] ?></td>
                            <td data-label="Preço Unitário">R$ <?= number_format($p['preco_unitario'], 2, ',', '.') ?></td>
                            <td data-label="Status"><?= ucfirst($p['status']) ?></td>
                            <td data-label="Data do Pedido"><?= date('d/m/Y H:i', strtotime($p['data_pedido'])) ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php elseif ($temAlgumFiltro): ?>
        <p style="color: red;"><strong>Nenhum pedido encontrado com esses filtros.</strong></p>
    <?php endif; ?>

</body>

</html>