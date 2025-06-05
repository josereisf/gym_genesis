<?php
if (isset($_GET['img'])) {
    $arquivo = './teste_imagem/' . basename($_GET['img']);

    if (file_exists($arquivo)) {
        header('Content-Length: ' . filesize($arquivo));
        readfile($arquivo);
        exit;
    } else {
        http_response_code(404);
        echo "Imagem não encontrada.";
    }
} else {
    http_response_code(400);
    echo "Parâmetro de imagem ausente.";
}
?>
