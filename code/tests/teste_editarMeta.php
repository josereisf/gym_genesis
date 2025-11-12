<?
require_once __DIR__ . '/../funcao.php';
$idusuario = 5;
$idmeta = 2;
$id = 0; //id da meta a ser editada
if ($id === 0) {
    // Obtém todas as metas do usuário
    $listar = listarMetaUsuario($idusuario);

    // Exibe resultado completo (para debug)
    var_dump($listar);

    // Verifica se há metas retornadas
    if (!empty($listar)) {
        foreach ($listar as $meta) {
            $nome        = $meta['nome_usuario'] ?? '';
            $idmeta      = $meta['idmeta'] ?? 0;
            $descricao   = $meta['descricao'] ?? '';
            $data_inicio = $meta['data_inicio'] ?? '';
            $data_limite = $meta['data_limite'] ?? '';
            $status      = $meta['status'] ?? '';

            // Aqui você pode usar as variáveis para exibir, salvar, etc.
            // Exemplo:
            echo "<p><strong>Meta #$idmeta</strong> - $descricao ($status)</p>";
        }
    } else {
        echo "<p>Nenhuma meta encontrada para este usuário.</p>";
    }
} else {
    $nome        =  '';
    $idmeta      =  0;
    $descricao   =  '';
    $data_inicio =  '';
    $data_limite = '';
    $status      =  '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao   = $_POST['descricao'] ?? '';
    $data_inicio = $_POST['data_inicio'] ?? '';
    $data_limite = $_POST['data_limite'] ?? '';
    $status      = $_POST['status'] ?? '';
    $idmeta      = $_POST['idmeta'] ?? null; // supondo que vem do form

    if ($idmeta) {
        $ok = editarMetaUsuario($idmeta, $idusuario, $descricao, $data_inicio, $data_limite, $status);

        if ($ok) {
            echo "<p class='text-green-600 font-semibold'>Meta atualizada com sucesso!</p>";
        } else {
            echo "<p class='text-red-600 font-semibold'>Erro ao atualizar meta.</p>";
        }
    } else {
        echo "<p class='text-yellow-600 font-semibold'>ID da meta não informado.</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- 🧾 Formulário com os valores -->
    <form method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Usuário:</label>
            <input type="text" name="nome_usuario" value="<?= htmlspecialchars($nome) ?>"
                class="w-full p-2 border rounded-lg" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">ID da Meta:</label>
            <input type="number" name="idmeta" value="<?= htmlspecialchars($idmeta) ?>"
                class="w-full p-2 border rounded-lg" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Descrição:</label>
            <input type="text" name="descricao" value="<?= htmlspecialchars($descricao) ?>"
                class="w-full p-2 border rounded-lg">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Data Início:</label>
                <input type="date" name="data_inicio" value="<?= htmlspecialchars($data_inicio) ?>"
                    class="w-full p-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Data Limite:</label>
                <input type="date" name="data_limite" value="<?= htmlspecialchars($data_limite) ?>"
                    class="w-full p-2 border rounded-lg">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Status:</label>
            <select name="status" class="w-full p-2 border rounded-lg">
                <?php
                $opcoes = ['ativa', 'concluída', 'cancelada'];
                foreach ($opcoes as $opcao) {
                    $selected = ($status === $opcao) ? 'selected' : '';
                    echo "<option value='$opcao' $selected>" . ucfirst($opcao) . "</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
            Salvar Alterações
        </button>
    </form>
</body>

</html>