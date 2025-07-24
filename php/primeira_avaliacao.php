<?php
require_once '../code/funcao.php';
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
$foto = $_FILES['foto'] ?? null;

// Valida formato da data
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_avaliacao)) {
    $data_avaliacao = date('Y-m-d'); // fallback
}

$imc = $altura > 0 ? $peso / ($altura ** 2) : 0;

// Tenta salvar imagem
$resultadoUpload = uploadImagem($foto);

if (is_array($resultadoUpload) && isset($resultadoUpload['erro'])) {
    die(json_encode(['error' => 'Erro ao salvar imagem: ' . $resultadoUpload['erro']]));
}

$nomeImagem = $resultadoUpload;
atualizarFotoUsuario($idusuario, $nomeImagem);


// Agora salva os dados
$resposta = cadastrarAvaliacaoFisica($peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $idusuario);
$_SESSION['id'] = $idusuario; // Atualiza o ID do usuário na sessão


header('Location: ../public/dashboard_usuario.php');