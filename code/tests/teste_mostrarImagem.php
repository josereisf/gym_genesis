<?php
require_once('../funcao.php');

$target_file = "./teste_imagem/print2.png";

<<<<<<< Updated upstream
// Testando a função mostrarImagem
$resultado = mostrarImagem($target_file);

// Verifica se retornou erro (string com mensagem) ou conteúdo da imagem
if (is_string($resultado) && str_starts_with($resultado, 'Erro') || str_contains($resultado, 'Arquivo')) {
    echo '<pre>';
    echo $resultado;
    echo '</pre>';
} else {
    // Se for conteúdo da imagem, exibe no navegador
    header("Content-Type: image/png"); // ou image/jpeg conforme o arquivo
    echo $resultado;
}
=======
$target_file = './teste_imagem/print2.png';

echo '<pre>';
$resposta = mostrarImagem($target_file);
echo $resposta;
echo '</pre';
>>>>>>> Stashed changes
