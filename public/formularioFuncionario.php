<?php
require_once __DIR__ . '/../code/funcao.php';
require_once __DIR__ . "/../php/verificarLogado.php";

// ================== FUNCIONÁRIO ==================
if (isset($_GET['idfuncionario'])) {
    $idfuncionario = $_GET['idfuncionario'];
    $resultados = listarFuncionarios($idfuncionario);
    // var_dump($resultados);
    if ($resultados && is_array($resultados) && count($resultados) > 0) {
        $r = $resultados[0];
        $nome = $r['nome'];
        $data_contratacao = $r['data_contratacao'];
        $salario = $r['salario'];
        $cargo_id = $r['cargo_id'];
        $usuario_id = $r['usuario_id'];
        $imagem = $r['imagem'] ?? '';
        $idperfil = $r['idperfil'];
        $acaoFuncionario = 'editar';
    } else {
        echo "Funcionário não encontrado!";
        exit;
    }
} else {
    $idfuncionario = 0;
    $nome = '';
    $data_contratacao = '';
    $salario = 0;
    $cargo_id = 0;
    $usuario_id = 20; // default
    $imagem = '';
    $acaoFuncionario = 'cadastrar';
}

// ================== PERFIL PROFESSOR ==================
if (isset($idperfil)) {
    $resultadoPerfil = listarPerfilProfessor($idfuncionario);

    if ($resultadoPerfil && is_array($resultadoPerfil) && count($resultadoPerfil) > 0) {
        $p = $resultadoPerfil[0];
        $foto_perfil = $p['foto_perfil'];
        $modalidade = $p['modalidade'];
        $avaliacao_media = $p['avaliacao_media'];
        $descricao = $p['descricao'];
        $horarios_disponiveis = $p['horarios_disponiveis'];
        $telefone = $p['telefone_professor'];
        $acaoPerfil = 'editar';
    } else {
        echo "Perfil de professor não encontrado!";
        exit;
    }
} else {
    $idperfil = 0;
    $foto_perfil = 'padrao.png';
    $modalidade = 'Presencial';
    $avaliacao_media = 0.00;
    $descricao = '';
    $horarios_disponiveis = '';
    $telefone = '';
    $acaoPerfil = 'cadastrar';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionário / Professor</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idfuncionario" value="<?= $idfuncionario ?>">
        <input type="hidden" name="idperfil" value="<?= $idperfil ?>">
        <input type="hidden" name="usuario_id" value="<?= $usuario_id ?>">

        <h2>Dados do Funcionário</h2>

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= $nome ?>" required><br>

        <label for="data_contratacao">Data de Contratação:</label>
        <input type="date" name="data_contratacao" id="data_contratacao" value="<?= $data_contratacao ?>"><br>

        <label for="salario">Salário:</label>
        <input type="number" name="salario" id="salario" value="<?= $salario ?>"><br>

        <label for="cargo_id">Cargo:</label>
        <select name="cargo_id" id="cargo_id">
            <?php
            $cargos = listarCargo(null);
            foreach ($cargos as $c) {
                $selecionado = ($c['idcargo'] == $cargo_id) ? 'selected' : '';
                echo "<option value='" . $c['idcargo'] . "' $selecionado>" . $c['nome'] . "</option>";
            }
            ?>
        </select><br>

        <h2>Dados do Professor</h2>

        <label for="foto_perfil">Foto do Professor:</label><br>
        <?php if (!empty($foto_perfil)) : ?>
            <img src="uploads/<?= $foto_perfil ?>" alt="Foto Professor" width="120"><br>
            <input type="hidden" name="foto_perfil" value="<?= $foto_perfil ?>">
        <?php endif; ?>
        <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*"><br><br>

        <label for="modalidade">Modalidade:</label>
        <select name="modalidade" id="modalidade" required>
            <option value="Presencial" <?= ($modalidade == 'Presencial') ? 'selected' : '' ?>>Presencial</option>
            <option value="Online" <?= ($modalidade == 'Online') ? 'selected' : '' ?>>Online</option>
            <option value="Híbrido" <?= ($modalidade == 'Híbrido') ? 'selected' : '' ?>>Híbrido</option>
        </select><br><br>

        <label for="avaliacao_media">Avaliação Média:</label>
        <input type="number" step="0.01" min="0" max="5" name="avaliacao_media" id="avaliacao_media" value="<?= $avaliacao_media ?>"><br><br>


        <label for="nome">Experiencia anos</label>
        <input type="text" name="experiencia" id="experiencia" value="<?= $experiencia ?>" required><br>

        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao" rows="4" cols="50"><?= $descricao ?></textarea><br><br>

        <label for="horarios_disponiveis">Horários Disponíveis:</label><br>
        <textarea name="horarios_disponiveis" id="horarios_disponiveis" rows="4" cols="50"><?= $horarios_disponiveis ?></textarea><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?= $telefone ?>" required><br><br>

        <input type="submit" name="botao" value="<?= ($acaoFuncionario == 'editar' || $acaoPerfil == 'editar') ? 'Atualizar' : 'Cadastrar' ?> Professor/Funcionário">
    </form>
    <script src="./js/formularioProfessor.js"></script>
</body>

</html>
