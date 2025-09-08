<?php
// inclui o arquivo onde você tem conectar(), desconectar() e as funções CRUD
require_once __DIR__ . '/../funcao.php';
// 1) CADASTRAR uma nova dica
$ok = cadastrarDicaNutricional(
    "Proteínas pós-treino",
    "Consumir proteínas logo após o treino ajuda na recuperação.",
    "fas fa-apple-alt",
    "green-400"
);

if ($ok) {
    echo "✅ Dica cadastrada com sucesso!<br>";
} else {
    echo "❌ Erro ao cadastrar dica.<br>";
}

// 2) LISTAR todas as dicas
$dicas = listarDicasNutricionais();
echo "<h3>Lista de dicas</h3>";
foreach ($dicas as $dica) {
    echo "ID: {$dica['iddicas_nutricionais']} | 
          Título: {$dica['titulos']} | 
          Descrição: {$dica['descricao']} | 
          Ícone: {$dica['icone']} | 
          Cor: {$dica['cor']}<br>";
}

// 3) EDITAR uma dica (exemplo: editar a dica de ID = 1)
$ok = editarDicaNutricional(
    1,
    "Proteínas pós-treino (atualizado)",
    "Consumir proteínas até 30 minutos após o treino potencializa a recuperação muscular.",
    "fas fa-dumbbell",
    "red-400"
);

if ($ok) {
    echo "✅ Dica editada com sucesso!<br>";
} else {
    echo "❌ Erro ao editar dica.<br>";
}

// 4) DELETAR uma dica (exemplo: deletar a dica de ID = 2)
$ok = deletarDicaNutricional(2);

if ($ok) {
    echo "✅ Dica deletada com sucesso!<br>";
} else {
    echo "❌ Erro ao deletar dica.<br>";
}

// 5) LISTAR novamente para ver resultado
$dicas = listarDicasNutricionais();
echo "<h3>Dicas após edição/deleção</h3>";
foreach ($dicas as $dica) {
    echo "ID: {$dica['iddicas_nutricionais']} | 
          Título: {$dica['titulos']} | 
          Descrição: {$dica['descricao']} | 
          Ícone: {$dica['icone']} | 
          Cor: {$dica['cor']}<br>";
}
?>
