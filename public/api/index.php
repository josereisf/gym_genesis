<?php
$entidade = $_REQUEST['entidade'] ?? null;
// echo $entidade;
 if (!$entidade) {
     http_response_code(400);
     echo json_encode(['erro' => 'Entidade não definida']);
     exit;
 }
 $arquivoController = "../../controller/$entidade.php";
 if (file_exists($arquivoController)) {
     include $arquivoController;
 } else {
     http_response_code(404);
     echo json_encode(['erro' => 'Controlador não encontrado']);
 }
?>
