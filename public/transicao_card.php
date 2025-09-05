<?php
require_once __DIR__ . '/../code/funcao.php';
session_start();

$idaluno = $_SESSION["id"] ?? 0;

// Pega todos os usuários do tipo professor
$professores = listarUsuarioTipo(2);

// Inicializa array final
$tudojunto = [];

foreach ($professores as $prof) {
    $id = $prof['idusuario'];

    // Pega perfil do funcionário
    $perfil_funcionario = listarFuncionarios($id); // array
    $cargo = listarCargo($id);                     // array com cargos

    // Pega perfil específico do professor
    $perfil_professor = listarPerfilProfessor($id); // array

    // Monta o array unificado
    $tudojunto[] = [
        'usuario' => $prof,
        'perfil_funcionario' => $perfil_funcionario,
        'cargo' => $cargo,
        'perfil_professor' => $perfil_professor
    ];
}
//  echo"<pre>";
//  var_dump($tudojunto);
//  echo"</pre>";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#132237] via-[#1a2f4a] to-[#0d1625] text-white flex flex-col items-center justify-start min-h-screen p-6">

<h1 class="text-3xl font-bold mb-6 text-center">Nossos Professores</h1>

<div class="flex gap-4 mb-6">
    <select id="filtroModalidade" class="border p-2 rounded bg-[#1f364f] text-white">
        <option value="">Todas Modalidades</option>
        <option value="Presencial">Presencial</option>
        <option value="Híbrido">Híbrido</option>
        <option value="Online">Online</option>
    </select>
    <input type="text" id="buscaNome" placeholder="Buscar por nome" class="border p-2 text-black rounded">
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full max-w-6xl">
    <?php foreach ($tudojunto as $prof): 
        $funcionario = $prof['perfil_funcionario'][0] ?? [];
        $professor = $prof['perfil_professor'][0] ?? [];

        $nome = $funcionario['nome'] ?? 'Sem nome';
        $email = $funcionario['email'] ?? 'Sem email';
        $telefone = $professor['telefone'] ?? $funcionario['telefone'] ?? '';
        $cargo = $funcionario['nome_cargo'] ?? '';
        $foto = $professor['foto_perfil'] ?? 'padrao.png';
        $experiencia = $professor['experiencia_anos'] ?? 0;
        $modalidade = $professor['modalidade'] ?? '';
        $avaliacao = $professor['avaliacao_media'] ?? '';
        $descricao = $professor['descricao'] ?? '';
        $horarios = $professor['horarios_disponiveis'] ?? '';
    ?>
        <div onclick="abrirModal(
                '<?php echo addslashes($nome); ?>',
                '<?php echo addslashes($descricao); ?>',
                '<?php echo addslashes($experiencia); ?>',
                '<?php echo addslashes($modalidade); ?>',
                '<?php echo addslashes($avaliacao); ?>',
                '<?php echo addslashes($telefone); ?>',
                '<?php echo addslashes($email); ?>',
                './uploads/<?php echo addslashes($foto); ?>',
                '<?php echo addslashes($horarios); ?>'
            )"
             class="bg-[#1f364f] p-4 rounded-2xl shadow-lg hover:scale-105 transition-transform cursor-pointer" data-nome="<?php echo strtolower($nome); ?>"
     data-modalidade="<?php echo strtolower($modalidade); ?>">
            <img src="./uploads/<?php echo $foto; ?>" alt="<?php echo $nome; ?>" class="w-full h-48 object-cover rounded-xl mb-4">
            <h2 class="text-xl font-semibold mb-1"><?php echo $nome; ?></h2>
            <p class="text-sm text-white">Modalidade: <?php echo $modalidade; ?></p>
            <p class="text-sm text-white">Avaliação: <?php echo $avaliacao; ?></p>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-[#1f364f] p-6 rounded-2xl w-full max-w-lg relative">
        <button onclick="fecharModal()" class="absolute top-4 right-4 text-black font-bold text-xl">&times;</button>
        <img id="modalFoto" src="" alt="" class="w-full h-64 object-cover rounded-xl mb-4">
        <h2 id="modalNome" class="text-2xl font-bold mb-2"></h2>
        <p id="modalDescricao" class="text-white mb-2"></p>
        <p id="modalExperiencia" class="text-white mb-2"></p>
        <p id="modalModalidade" class="text-white mb-2"></p>
        <p id="modalAvaliacao" class="text-white mb-2"></p>
        <p id="modalTelefone" class="text-white mb-2"></p>
        <p id="modalEmail" class="text-white mb-2"></p>
        <p id="modalHorarios" class="text-white"></p>
    </div>
</div>

<script>
function abrirModal(nome, descricao, experiencia, modalidade, avaliacao, telefone, email, foto, horarios) {
    document.getElementById('modalNome').innerText = nome;
    document.getElementById('modalDescricao').innerText = "Descrição: " + descricao;
    document.getElementById('modalExperiencia').innerText = "Experiência: " + experiencia + " anos";
    document.getElementById('modalModalidade').innerText = "Modalidade: " + modalidade;
    document.getElementById('modalAvaliacao').innerText = "Avaliação: " + avaliacao;
    document.getElementById('modalTelefone').innerText = "Telefone: " + telefone;
    document.getElementById('modalEmail').innerText = "Email: " + email;
    document.getElementById('modalHorarios').innerText = "Horários: " + horarios;
    document.getElementById('modalFoto').src = foto;

    document.getElementById('modal').classList.remove('hidden');
}

function fecharModal() {
    document.getElementById('modal').classList.add('hidden');
}

// Seleciona todos os cards
const cards = document.querySelectorAll('[data-nome][data-modalidade]');
const filtroModalidade = document.getElementById('filtroModalidade');
const buscaNome = document.getElementById('buscaNome');

function filtrarCards() {
    const modalidade = filtroModalidade.value.toLowerCase();
    const nome = buscaNome.value.toLowerCase();

    cards.forEach(card => {
        const cardNome = card.dataset.nome.toLowerCase();
        const cardModalidade = card.dataset.modalidade.toLowerCase();

        const matchModalidade = modalidade === '' || cardModalidade === modalidade;
        const matchNome = cardNome.includes(nome);

        if(matchModalidade && matchNome) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Eventos para atualizar a filtragem em tempo real
filtroModalidade.addEventListener('change', filtrarCards);
buscaNome.addEventListener('input', filtrarCards);


</script>

</body>
</html>
