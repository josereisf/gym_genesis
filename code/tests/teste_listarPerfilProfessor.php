<?

require_once __DIR__ . '/../funcao.php';

$idusuario = null;
$foto = null;
$ex = 5;
$mod = "presencial";
$avl = 4.00;
$de = "perPersonal trainer especializado em musculação e condicionamento físico";
$horario = "Segunda a Sexta: 6h-10h e 18h-22h";
$tel = "11) 99999-0002";

$json = json_encode(listarPerfilProfessor($idusuario), JSON_UNESCAPED_UNICODE);
echo $json;