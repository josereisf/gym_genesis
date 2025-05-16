<?php
require_once('../funcao.php');

ini_set('upload_max_filesize', '20M');
ini_set('post_max_size', '20M');
//require_once '../../code/funcao.php';

$foto = $_FILES['arquivo'];
$target_dir = "./teste_imagem/";

echo '<pre>';
print_r(uploadImagem($foto, $target_dir));
echo '</pre';