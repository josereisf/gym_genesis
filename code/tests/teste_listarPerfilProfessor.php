<?

require_once __DIR__ . '/../funcao.php';

$idusuario = 2;
$foto = null;
$ex = 5;
$mod = "presencial";
$avl = 4.00;
$de = "perPersonal trainer especializado em musculação e condicionamento físico";
$horario = "Segunda a Sexta: 6h-10h e 18h-22h";
$tel = "11) 99999-0002";

$resultado = listarPerfilProfessor($idusuario);

if($resultado > 0){
    echo "funcionou";
    var_dump($resultado);
}
else{
    echo "nao funcionou";
}