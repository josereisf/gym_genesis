<?php

require_once __DIR__ . '/../funcao.php';

$resultado = deletarPerfilUsuario(3); // supondo que o usuario_id=1 tenha registros em outras tabelas

if ($resultado["sucesso"]) {
    echo $resultado["mensagem"];
} else {
    echo "Erro ({$resultado['codigo']}): {$resultado['erro']}";
}
