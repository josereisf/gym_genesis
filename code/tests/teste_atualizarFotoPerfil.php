<?php

require_once __DIR__ . '/../funcao.php';


$idusuario = 1;
$foto = $_FILES['foto'] ?? "pessoas-mulheres-negocios-e-conceito-de-retrato-rosto-de-jovem-sorridente-feliz_380164-121867.avif";

var_dump(atualizarFotoUsuario($foto, $idusuario));
