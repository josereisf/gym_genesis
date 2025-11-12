<?php
require_once __DIR__ . '/../../code/funcao.php';
session_start();

$idusuario = $_POST['idusuario'];
if (!$idusuario) {
    die(json_encode(['error' => 'ID do usuário não fornecido']));
}

$peso = $_POST['peso']; 
$altura = $_POST['altura']; 
$objetivo = $_POST['objetivo'];
$percentual_gordura = $_POST['percentual_gordura'];
$dia_semana = $_POST['dias_semana'];
$horario_preferido = $_POST['horario_preferido'];
$data_avaliacao = $_POST['data_avaliacao'] ?? date('Y-m-d');

$descricao = $_POST['meta'] ?? '';
$data_inicio = date('Y-m-d');
$data_limite = date('Y-m-d', strtotime('+3 months'));

$status = 'ativa';

// Valida formato da data
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_avaliacao)) {
    $data_avaliacao = date('Y-m-d'); // fallback
}

$imc = calcularIMC($peso, $altura);

// Se não tiver imagem enviada, usa a imagem padrão
if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    $nomeImagem = 'padrao.png';
} else {
    $foto = $_FILES['foto'];
    $resultadoUpload = uploadImagem($foto);
    
    if (is_array($resultadoUpload)) {
        if (isset($resultadoUpload['erro'])) {
            $erroMsg = $resultadoUpload['erro'];
            die(json_encode(['error' => "Erro ao salvar imagem: $erroMsg"]));
        } elseif (isset($resultadoUpload['warning'])) {
            $nomeImagem = $resultadoUpload['nome_arquivo'] ?? 'padrao.png';
        } else {
            die(json_encode(['error' => 'Retorno inesperado da função uploadImagem']));
        }
    } else {
        $nomeImagem = $resultadoUpload;
    }

    if (empty($nomeImagem)) {
        $nomeImagem = 'padrao.png';
    }
}

cadastrarMetaUsuario($idusuario, $descricao, $data_inicio, $data_limite, $status);
// Atualiza a foto do usuário
atualizarFotoUsuario($nomeImagem, $idusuario);
cadastrarHistoricoPeso($idusuario, $peso, date('Y-m-d H:i:s'));// Agora salva os dados da avaliação física
$resposta = cadastrarAvaliacaoFisica($peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $idusuario);

if (!$resposta) {
    die(json_encode(['error' => 'Falha ao cadastrar avaliação física']));
}

$_SESSION['id'] = $idusuario;
header('Location: ../dashboard_usuario.php');
exit;

