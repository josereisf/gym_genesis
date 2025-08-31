<?php
require_once __DIR__ . '/../funcao.php';;

ini_set('upload_max_filesize', '20M');
ini_set('post_max_size', '20M');

$foto = $_FILES['arquivo'];
$target_dir = "./teste_imagem/";

$resultado = uploadImagem($foto, $target_dir);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Resultado do Upload</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      height: 100vh;
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #2c3e50, #3498db);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .mensagem {
      background-color: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
      text-align: center;
      max-width: 500px;
      width: 90%;
    }

    .mensagem h1 {
      color: #2ecc71;
      font-size: 26px;
      margin-bottom: 15px;
    }

    .mensagem p {
      font-size: 16px;
      color: #333;
    }

    .erro {
      color: #e74c3c;
      font-weight: bold;
    }

    .sucesso {
      color: #2ecc71;
      font-weight: bold;
    }

    .voltar {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      background-color: #2980b9;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }

    .voltar:hover {
      background-color: #1c5980;
    }
  </style>
</head>

<body>

  <div class="mensagem">
    <?php if (isset($resultado['erro'])): ?>
      <h1>❌ Erro no Upload</h1>
      <p class="erro"><?= htmlspecialchars($resultado['erro']) ?></p>
    <?php else: ?>
      <h1>✅ Upload Realizado com Sucesso</h1>
      <p class="sucesso">Arquivo salvo como: <strong><?= htmlspecialchars($resultado['nome']) ?></strong></p>
    <?php endif; ?>

    <a href="teste_mostrarImagem.php" class="voltar">Mostrar Imagem</a>
  </div>

</body>

</html>