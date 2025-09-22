<?php
require_once __DIR__ . '/../code/funcao.php';

header('Content-Type: application/json; charset=utf-8');

$acao = $_REQUEST['acao'] ?? null;

$input = $_POST;
if (empty($input)) {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
}

$idfuncionario = $input['idfuncionario'] ?? null;
$nome = $input['nome'] ?? null;
$data_contratacao = $input['data_contratacao'] ?? null;
$salario = $input['salario'] ?? null;
$cargo_id = $input['cargo_id'] ?? null;
$usuario_id = $input['usuario_id'] ?? null;

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['imagem']);
} elseif (isset($input['imagem']) && (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK)) {
    $imagem = $input['imagem'];
} else {
    $imagem = null;
}

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}

switch ($acao) {
    case 'cadastrar':
        $ok = cadastrarFuncionario($nome,  $data_contratacao, $salario, $cargo_id, $usuario_id);
        if ($ok) {
            enviarResposta(true, 'Funcionário cadastrado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao cadastrar funcionário');
        }
        break;

    case 'editar':
        if (!$idfuncionario || !$nome || !$telefone || !$data_contratacao || !$salario || !$cargo_id) {
            enviarResposta(false, 'ID e todos os campos obrigatórios devem ser preenchidos');
        }
        $ok = editarFuncionario($idfuncionario, $nome,  $data_contratacao, $salario, $cargo_id, $usuario_id);
        if ($ok) {
            enviarResposta(true, 'Funcionário editado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao editar funcionário');
        }
        break;

    case 'listar':
        $dados = listarFuncionarios($idfuncionario);
        if ($dados) {
            enviarResposta(true, 'Funcionários listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar funcionários');
        }
        break;

    case 'deletar':
        if (!$idfuncionario) {
            enviarResposta(false, 'ID do funcionário não informado');
        }
        $ok = deletarFuncionario($idfuncionario);
        if ($ok) {
            enviarResposta(true, 'Funcionário deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar funcionário');
        }
        break;

    default:
        enviarResposta(false, 'Ação inválida');
}
