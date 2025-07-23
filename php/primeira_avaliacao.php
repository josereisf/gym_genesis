<?

require_once '../code/funcao.php';
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

// Valida formato da data
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_avaliacao)) {
    $data_avaliacao = date('Y-m-d'); // fallback
}



$imc = $altura > 0 ? $peso / ($altura ** 2) : 0;


$resposta = cadastrarAvaliacaoFisica($peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $idusuario);

