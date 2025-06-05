<?php
$diretorio = "./teste_imagem/";
$arquivos = [];
$erro_pasta = null;

if (is_dir($diretorio)) {
    $arquivos = array_diff(scandir($diretorio), ['.', '..']);
} else {
    $erro_pasta = "A pasta 'teste_imagem' não existe.";
}

// Verifica se uma imagem foi clicada
$imagemSelecionada = isset($_GET['img']) ? basename($_GET['img']) : null;
$caminhoImagem = $diretorio . $imagemSelecionada;

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
        .erro {
            color: red;
            font-weight: bold;
            text-align: center;
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

<?php if ($erro_pasta): ?>
    <div class="erro"><?= $erro_pasta ?></div>
<?php endif; ?>

<div class="lista-arquivos">
    <?php foreach ($arquivos as $arquivo): ?>
        <a href="?img=<?= urlencode($arquivo) ?>">📎 <?= htmlspecialchars($arquivo) ?></a>
    <?php endforeach; ?>
</div>

<?php if ($imagemSelecionada && file_exists($caminhoImagem)): ?>
    <div class="imagem-exibida">
        <h2><?= htmlspecialchars($imagemSelecionada) ?></h2>
        <img src="exibir_imagem.php?img=<?= urlencode($imagemSelecionada) ?>" alt="Imagem">
    </div>
<?php elseif ($imagemSelecionada): ?>
    <div class="erro">Imagem não encontrada.</div>
<?php endif; ?>

</body>
</html>
