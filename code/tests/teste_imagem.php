<?php
// Verifica se o arquivo foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    // Variáveis do arquivo enviado
    $arquivo = $_FILES['foto'];
    $nomeArquivo = $arquivo['name'];
    $tmpArquivo = $arquivo['tmp_name'];
    $tamanhoArquivo = $arquivo['size'];
    $erro = $arquivo['error'];

    // Caminho para salvar o arquivo
    $diretorioDestino = '../../public/uploads/';

    // Verifica se o diretório existe, caso contrário cria
    if (!is_dir($diretorioDestino)) {
        if (!mkdir($diretorioDestino, 0777, true)) {
            echo 'Falha ao criar o diretório uploads/. Verifique as permissões!';
            exit;
        }
    }

    // Verifica se o diretório tem permissões de escrita
    if (!is_writable($diretorioDestino)) {
        echo 'O diretório uploads/ não tem permissões de escrita. Verifique as permissões!';
        exit;
    }

    // Verifica se houve algum erro no upload
    if ($erro != UPLOAD_ERR_OK) {
        echo 'Erro no upload do arquivo.';
        exit;
    }

    // Obtém a extensão do arquivo
    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

    // Verifica se o arquivo é uma imagem
    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

    // Se a extensão não for válida, exibe erro
    if (!in_array($extensao, $tiposPermitidos)) {
        echo 'Formato de imagem inválido. Apenas JPG, JPEG, PNG, GIF e BMP são permitidos.';
        exit;
    }

    // Verifica se o arquivo não ultrapassa o limite de tamanho (exemplo: 5MB)
    $tamanhoMaximo = 5 * 1024 * 1024; // 5MB
    if ($tamanhoArquivo > $tamanhoMaximo) {
        echo 'O arquivo é muito grande. O limite é de 5MB.';
        exit;
    }

    // Gera um nome único para o arquivo para evitar sobreposição
    $nomeFinal = uniqid('foto_') . '.' . $extensao;

    // Move o arquivo para o diretório de destino
    if (move_uploaded_file($tmpArquivo, $diretorioDestino . $nomeFinal)) {
        echo 'Arquivo enviado com sucesso!<br>';
        echo 'Nome do arquivo: ' . $nomeFinal . '<br>';
        echo '<img src="' . $diretorioDestino . $nomeFinal . '" alt="Imagem enviada" width="200"><br>';
    } else {
        echo 'Falha ao mover o arquivo para o diretório. Verifique as permissões!';
    }
} else {
    echo 'Nenhum arquivo foi enviado.';
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simular Upload de Foto</title>
</head>
<body>

<h2>Simulação de Upload de Foto</h2>

<!-- Formulário de Upload -->
<form action="teste_imagem.php" method="post" enctype="multipart/form-data">
    <label for="fileUpload">Escolha uma foto:</label>
    <input type="file" name="foto" id="fileUpload" accept="image/*" required><br><br>
    <input type="submit" value="Enviar Foto">
</form>

</body>
</html>

