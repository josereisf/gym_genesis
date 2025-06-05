<?php
require_once('../funcao.php');

// Caminho da pasta de imagens
$diretorio = "./teste_imagem/";

// Verifica se a pasta existe
if (is_dir($diretorio)) {
    // Lista todos os arquivos da pasta
    $arquivos = scandir($diretorio);

    // Remove "." e ".." do array
    $arquivos = array_diff($arquivos, array('.', '..'));
} else {
    $erro_pasta = "A pasta 'teste_imagem' não existe.";
    $arquivos = []; // Nenhum arquivo para exibir
}

// Testando a função mostrarImagem com um arquivo específico
$target_file = $diretorio . "img_683ddd3f4f4315.65673544.png";
$resultado = mostrarImagem($target_file);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Imagens</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f9;
            padding: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        .erro {
            color: red;
            font-weight: bold;
            text-align: center;
            margin: 20px;
        }

        .imagens-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .imagem-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .imagem-item img {
            width: 200px;
            height: auto;
            border-radius: 5px;
        }

        .imagem-item p {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>

    <h1>Imagens Disponíveis</h1>

    <?php if (!empty($erro_pasta)): ?>
        <div class="erro"><?= $erro_pasta ?></div>
    <?php endif; ?>

    <div class="imagens-container">
        <?php if (empty($arquivos)): ?>
            <p style="text-align: center; font-size: 18px;">Não há imagens na pasta 'teste_imagem'.</p>
        <?php else: ?>
            <?php foreach ($arquivos as $arquivo): ?>
                <div class="imagem-item">
                    <img src="<?= $diretorio . $arquivo ?>" alt="Imagem">
                    <p><?= $arquivo ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php
    // Exibe a imagem usando a função mostrarImagem, se necessário
    if (isset($resultado) && !is_string($resultado)) {
        echo '<h2>Imagem Teste</h2>';
        echo '<img src="data:image/png;base64,' . base64_encode($resultado) . '" alt="Imagem Teste" />';
    } elseif (isset($resultado)) {
        echo '<div class="erro">' . $resultado . '</div>';
    }
    ?>

</body>

</html>
