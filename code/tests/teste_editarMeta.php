<?php
require_once __DIR__ . '/../funcao.php';

$resultado = null;
$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idmeta = $_POST['idmeta'] ?? 1;
    $descricao = $_POST['descricao'] ?? '';
    $data_inicio = $_POST['data_inicio'] ?? '';
    $data_limite = $_POST['data_limite'] ?? '';
    $status = $_POST['status'] ?? '';

    try {
        $res = editarMetaUsuario($idmeta, $descricao, $data_inicio, $data_limite, $status);

        if (!is_null($res)) {
            $resultado = "✅ A função <code>editarMetaUsuario()</code> executou com sucesso.";
        } else {
            $erro = "⚠️ A função retornou <code>null</code>. Verifique os parâmetros.";
        }
    } catch (Throwable $e) {
        $erro = "❌ Erro ao executar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Teste - editarMetaUsuario()</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-lg">
        <h1 class="text-2xl font-bold text-center text-blue-700 mb-6">
            🧪 Teste da Função <code>editarMetaUsuario()</code>
        </h1>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">ID da Meta:</label>
                <input type="number" name="idmeta" value="<?= htmlspecialchars($_POST['idmeta'] ?? 1) ?>"
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Descrição:</label>
                <input type="text" name="descricao" value="<?= htmlspecialchars($_POST['descricao'] ?? 'procrastinarrrrrrrrrrr') ?>"
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Data Início:</label>
                    <input type="date" name="data_inicio" value="<?= htmlspecialchars($_POST['data_inicio'] ?? '2007-11-11') ?>"
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Data Limite:</label>
                    <input type="date" name="data_limite" value="<?= htmlspecialchars($_POST['data_limite'] ?? '2099-12-12') ?>"
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status:</label>
                <select name="status" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <?php
                    $statuses = ['ativa', 'concluída', 'pausada', 'cancelada'];
                    $statusAtual = $_POST['status'] ?? 'ativa';
                    foreach ($statuses as $st) {
                        $selected = $st === $statusAtual ? 'selected' : '';
                        echo "<option value='$st' $selected>" . ucfirst($st) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                Enviar Teste
            </button>
        </form>

        <?php if ($resultado): ?>
            <div class="mt-6 bg-green-100 text-green-800 p-4 rounded-lg">
                <?= $resultado ?>
            </div>
        <?php elseif ($erro): ?>
            <div class="mt-6 bg-red-100 text-red-800 p-4 rounded-lg">
                <?= $erro ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>