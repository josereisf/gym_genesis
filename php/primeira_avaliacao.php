<?

require_once '../code/funcao.php';
$idusuario = $_SESSION['idusuario'];
if (!$idusuario) {
    die(json_encode(['error' => 'ID do usuário não fornecido']));
}
$peso = $_POST['peso']; 
$altura = $_POST['altura']; 
$objetivo = $_POST['objetivo'];
$meta = $_POST['meta'];
$dia_semana = $_POST['dias_semana'];
$horario_preferido = $_POST['horario_preferido'];


$imc = $peso / ($altura ** 2);


cadastrarAvaliacaoFisica($peso, $altura, $imc, $objetivo, $meta, $dia_semana);