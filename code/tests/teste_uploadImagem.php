<?php
require_once('../funcao.php');

//require_once '../../code/funcao.php';

$foto = $_FILES['arquivo'];
$target_dir = "teste_imagem";

echo '<pre>';
$resposta = uploadImagem($foto, $target_dir);
echo "<img src=teste_imagem/$resposta>";
echo '</pre';