<?php
require_once "../funcao.php";
$idaula = 0;
$horarios = listarAulaAgendada($idaula);
$classData = array();
foreach ($horarios as $h) {
  $classData[] = array(
    'dia' => $h['dia_semana'],
    'horario' => $h['hora_inicio'],
    'alunos' => 14,
    'treino' => $h['hora_fim']
  );
}

// Verifique o JSON gerado
echo '<pre>';
echo json_encode($classData);
echo '</pre>';
?>