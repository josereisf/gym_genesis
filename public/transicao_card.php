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
    <link rel="shortcut icon" href="./uploads/1academia.webp" type="image/x-icon">
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
            $id = $funcionario['usuario_id'] ?? '';
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
                class="professor-card bg-[#1f364f] p-4 rounded-2xl shadow-lg hover:scale-105 transition-transform cursor-pointer"
                data-nome="<?= $nome ?>"
                data-descricao="<?= htmlspecialchars($descricao) ?>"
                data-experiencia="<?= $experiencia ?>"
                data-modalidade="<?= $modalidade ?>"
                data-avaliacao="<?= $avaliacao ?>"
                data-telefone="<?= $telefone ?>"
                data-email="<?= $email ?>"
                data-foto="./uploads/<?= $foto ?>">

                <!-- Foto -->
                <img src="./uploads/<?php echo $foto; ?>" alt="<?php echo $nome; ?>"
                    class="w-full h-48 object-cover rounded-xl mb-4" id='foto'>

                <!-- Nome -->
                <h2 class="text-xl font-semibold mb-1 flex items-center gap-2" id='nome'>
                    <i class="fa-solid fa-user text-white"></i>
                    <?php echo $nome; ?>
                </h2>

                <!-- Modalidade -->
                <p class="text-sm text-white flex items-center gap-2" id='modalidade'>
                    <i class="fa-solid fa-dumbbell text-white"></i>
                    Modalidade: <?php echo $modalidade; ?>
                </p>

                <!-- Avaliação -->
                <p class="text-sm text-white flex items-center gap-2" id='avaliacao'>
                    <i class="fa-solid fa-star text-yellow-400"></i>
                    Avaliação: <?php echo $avaliacao; ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>


    <!-- Modal -->
    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-[#1f364f] p-6 rounded-2xl w-full max-w-4xl relative">

            <!-- Botão fechar -->
            <button onclick="fecharModal()" class="absolute top-4 right-4 text-white font-bold text-2xl">&times;</button>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Foto -->
                <div class="flex justify-center items-start">
                    <img id="modalFoto" src="" alt="" class="w-full h-72 object-cover rounded-xl shadow-lg">
                </div>

                <!-- Informações -->
                <div class="flex flex-col justify-start">
                    <h2 id="modalNome" class="text-2xl font-bold mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-user text-white"></i>
                    </h2>

                    <p id="modalDescricao" class="text-white mb-3"></p>

                    <p id="modalExperiencia" class="text-white mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-briefcase text-white"></i>
                    </p>

                    <p id="modalModalidade" class="text-white mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-dumbbell text-white"></i>
                    </p>

                    <p id="modalAvaliacao" class="text-white mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-star text-yellow-400"></i>
                    </p>

                    <p id="modalTelefone" class="text-white mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-phone text-green-400"></i>
                    </p>

                    <p id="modalEmail" class="text-white mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-blue-400"></i>
                    </p>

                    <!-- Horários -->
                    <div id="modalHorarios" class="flex flex-col gap-2 mt-4">
                        <!-- Botões de horários serão inseridos via JS -->
                    </div>
                </div>
            </div>

            <!-- Botão Selecionar -->
            <div class="mt-6 flex justify-center">
                <button id="btnSelecionar"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-xl shadow-lg flex items-center gap-2 transition">
                    <i class="fa-solid fa-check"></i> Selecionar
                </button>
            </div>
        </div>
    </div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.professor-card');
    const modal = document.getElementById('modal');
    const btnSelecionar = document.getElementById('btnSelecionar');
    const containerHorarios = document.getElementById('modalHorarios');
    let selectedIdaula = null;
    const usuarioId = <?= $idaluno ?>;

    function abrirModal(card) {
        document.getElementById('modalNome').textContent = card.dataset.nome;
        document.getElementById('modalDescricao').textContent = card.dataset.descricao;
        document.getElementById('modalExperiencia').textContent = "Experiência: " + card.dataset.experiencia + " anos";
        document.getElementById('modalModalidade').textContent = "Modalidade: " + card.dataset.modalidade;
        document.getElementById('modalAvaliacao').textContent = "Avaliação: " + card.dataset.avaliacao;
        document.getElementById('modalTelefone').textContent = "Telefone: " + card.dataset.telefone;
        document.getElementById('modalEmail').textContent = "Email: " + card.dataset.email;
        document.getElementById('modalFoto').src = card.dataset.foto;

        containerHorarios.innerHTML = '';
        selectedIdaula = null;
        btnSelecionar.disabled = true;

        fetch(`http://localhost:83/public/api/index.php?entidade=aula_agendada&acao=listar&idprofessor=${card.dataset.idprofessor}`)
            .then(res => res.json())
            .then(response => {
                if (!response.sucesso) return alert('Erro ao listar aulas: ' + response.mensagem);

                const dados = JSON.parse(response.dados); // converte JSON string em array
                dados.forEach(aula => {
                    const btn = document.createElement('button');
                    btn.className = 'horario-card bg-[#2a4662] hover:bg-[#3a5977] text-white py-2 px-4 rounded-lg transition';
                    btn.dataset.idaula = aula.idaula;

                    const inicio = aula.hora_inicio.slice(0, 5);
                    const fim = aula.hora_fim.slice(0, 5);
                    btn.textContent = `${aula.dia_semana} (${aula.data_aula}) - ${inicio} às ${fim} | ${aula.treino_tipo}: ${aula.treino_desc}`;
                    containerHorarios.appendChild(btn);
                });
            });

        modal.classList.remove('hidden');
    }

    cards.forEach(card => {
        card.addEventListener('click', () => abrirModal(card));
    });

    window.fecharModal = () => modal.classList.add('hidden');

    containerHorarios.addEventListener('click', e => {
        const btn = e.target.closest('.horario-card');
        if (!btn) return;
        document.querySelectorAll('.horario-card').forEach(b => b.classList.remove('bg-green-600'));
        btn.classList.add('bg-green-600');
        selectedIdaula = btn.dataset.idaula;
        btnSelecionar.disabled = false;
    });

    btnSelecionar.addEventListener('click', () => {
        if (!selectedIdaula) return;
        fetch('http://localhost:83/public/api/index.php?entidade=aula_usuario&acao=cadastrar', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({idaula: selectedIdaula, usuario_id: usuarioId})
        })
        .then(res => res.json())
        .then(data => {
            if (data.success || data.sucesso) {
                alert('Aula selecionada com sucesso!');
                modal.classList.add('hidden');
            } else {
                alert('Erro ao selecionar aula!');
            }
        });
    });
    const filtroModalidade = document.getElementById('filtroModalidade');
            const buscaNome = document.getElementById('buscaNome');

            function filtrarCards() {
                const modalidade = filtroModalidade.value.toLowerCase();
                const nome = buscaNome.value.toLowerCase();

                cards.forEach(card => {
                    const matchModalidade = !modalidade || card.dataset.modalidade.toLowerCase() === modalidade;
                    const matchNome = card.dataset.nome.toLowerCase().includes(nome);
                    card.style.display = (matchModalidade && matchNome) ? 'block' : 'none';
                });
            }

            filtroModalidade.addEventListener('change', filtrarCards);
});
    </script>


</body>

</html>           