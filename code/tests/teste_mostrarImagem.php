<?php
$diretorio = './teste_imagem/';
$imagens = [];

if (is_dir($diretorio)) {
    $arquivos = scandir($diretorio);
    foreach ($arquivos as $arq) {
        if (in_array(strtolower(pathinfo($arq, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png'])) {
            $imagens[] = $arq;
        }
    }
}

$imagemSelecionada = $_GET['img'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Imagens Disponíveis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        .lista-arquivos {
            max-width: 500px;
            margin: 20px auto;
        }
        .lista-arquivos a {
            display: block;
            padding: 8px;
            text-decoration: none;
            color: #333;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 5px;
            transition: background 0.2s;
        }
        .lista-arquivos a:hover {
            background-color: #eef;
        }
        .imagem-exibida {
            text-align: center;
            margin-top: 40px;
        }
        .imagem-exibida img {
            max-width: 600px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
        }
    </style>
</head>
<body>

    <h1>Imagens Disponíveis</h1>

    <div class="lista-arquivos">
        <?php foreach ($imagens as $img): ?>
            <a href="?img=<?= urlencode($img) ?>">📎 <?= htmlspecialchars($img) ?></a>
        <?php endforeach; ?>
    </div>

    <?php if ($imagemSelecionada): ?>
        <div class="imagem-exibida">
            <h2><?= htmlspecialchars($imagemSelecionada) ?></h2>
            <img src="exibir_imagem.php?img=<?= urlencode($imagemSelecionada) ?>" alt="Imagem">
        </div>
    <?php endif; ?>

</body>
</html>
