<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json');

$acao = $_GET['acao'] ?? null;

$idmeta = $_POST['idmeta'] ?? 0;
$idusuario = $_POST['idusuario'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$data_inicio = $_POST['data_inicio'] ?? null;
$data_limite = $_POST['data_limite'] ?? null;
$status = $_POST['status'] ?? null;

$response = ['sucesso' => false, 'mensagem' => 'Ação inválida'];

switch ($acao) {
    case 'cadastrar':
        $resultado = cadastrarMetaUsuario($idusuario, $descricao, $data_inicio, $data_limite, $status);
        if ($resultado) {
            $response = ['sucesso' => true, 'mensagem' => 'Meta cadastrada com sucesso'];
        } else {
            $response = ['sucesso' => false, 'mensagem' => 'Erro ao cadastrar meta'];
        }
        break;

    case 'editar':
        $resultado = editarMetaUsuario($idmeta, $descricao, $data_inicio, $data_limite, $status);
        if ($resultado) {
            $response = ['sucesso' => true, 'mensagem' => 'Meta editada com sucesso'];
        } else {
            $response = ['sucesso' => false, 'mensagem' => 'Erro ao editar meta'];
        }
        break;

    case 'listar':
        $resultado = listarMetaUsuario($idmeta);
        if ($resultado !== false && $resultado !== null) {
            $response = ['sucesso' => true, 'dados' => $resultado];
        } else {
            $response = ['sucesso' => false, 'mensagem' => 'Erro ao listar meta'];
        }
        break;

    case 'deletar':
        $resultado = deletarMetaUsuario($idmeta);
        if ($resultado) {
            $response = ['sucesso' => true, 'mensagem' => 'Meta deletada com sucesso'];
        } else {
            $response = ['sucesso' => false, 'mensagem' => 'Erro ao deletar meta'];
        }
        break;

    default:
        $response = ['sucesso' => false, 'mensagem' => 'Ação não informada ou inválida'];
        break;
}

echo json_encode($response);
exit;
