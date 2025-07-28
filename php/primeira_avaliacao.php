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

$imc = calcularIMC($peso, $altura);

// Tenta salvar imagem
$resultadoUpload = uploadImagem($foto);

if (is_array($resultadoUpload)) {
    if (isset($resultadoUpload['erro'])) {
        // Erro específico retornado pela função
        $erroMsg = $resultadoUpload['erro'];
        die(json_encode(['error' => "Erro ao salvar imagem: $erroMsg"]));
    } elseif (isset($resultadoUpload['warning'])) {
        // Caso a função retorne um warning ou outro tipo de aviso
        $warningMsg = $resultadoUpload['warning'];
        // Você pode tratar aqui como quiser (exemplo: mostrar um alerta e continuar)
        // Para exemplo, vamos continuar e guardar o nome
        $nomeImagem = $resultadoUpload['nome_arquivo'] ?? null;
    } else {
        // Retorno inesperado
        die(json_encode(['error' => 'Retorno inesperado da função uploadImagem']));
    }
} else {
    // Retorno direto do nome da imagem (string)
    $nomeImagem = $resultadoUpload;
}

// Se chegou aqui, nomeImagem está definido (ou nulo, se for warning sem nome)
if (empty($nomeImagem)) {
    die(json_encode(['error' => 'Nome da imagem inválido ou não foi definido.']));
}

// Atualiza a foto do usuário com o nome da imagem salva
atualizarFotoUsuario($nomeImagem, $idusuario);

// Agora salva os dados da avaliação física
$resposta = cadastrarAvaliacaoFisica($peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $idusuario);

if (!$resposta) {
    die(json_encode(['error' => 'Falha ao cadastrar avaliação física']));
}

// Atualiza sessão
$_SESSION['id'] = $idusuario;

// Redireciona para o dashboard do usuário
header('Location: ../public/dashboard_usuario.php');
exit;
