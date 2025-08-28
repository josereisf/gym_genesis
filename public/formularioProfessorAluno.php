<?php
require_once "../code/funcao.php";
$idaluno = $_SESSION["id"] ?? 0;
$professores = listarUsuarioTipo(2);
$cargo = listarCargo(1);
$tudojunto = [
  'professores' => $professores,
  'cargo' => $cargo
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professores</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#132237] text-white flex flex-col items-center justify-center min-h-screen p-6">
<form action="api/index.php?entidade=professor_aluno&acao=cadastrar" method="get" 
      class="w-full flex flex-col items-center space-y-6">
  
  <label class="text-2xl font-semibold">Professores</label>

  <div class="w-full overflow-x-auto">
    <table class="min-w-full bg-white rounded-xl shadow-lg overflow-hidden">
      <thead class="bg-gray-100 text-gray-700 text-sm">
        <tr>
          <th class="px-4 py-3 text-left">Foto</th>
          <th class="px-4 py-3 text-left">Nome</th>
          <th class="px-4 py-3 text-left">Email</th>
          <th class="px-4 py-3 text-left">Telefone</th>
          <th class="px-4 py-3 text-left">Cargo</th>
          <th class="px-4 py-3 text-left">Ação</th>
        </tr>
      </thead>
      <tbody id="professorTable" class="divide-y divide-gray-200 text-gray-800">
        <?php
        foreach ($tudojunto['professores'] as $professor) {
          echo "
            <tr id='professor-" . $professor['idusuario'] . "' class='hover:bg-gray-50 transition-colors'>
              <td class='px-4 py-3'>
                <img src='./uploads/" . ($professor['foto_de_perfil'] ?: "padrao.png") . "' 
                     alt='" . $professor['nome'] . "' 
                     class='w-12 h-12 rounded-full object-cover' />
              </td>
              <td class='px-4 py-3 font-semibold'>" . $professor['nome'] . "</td>
              <td class='px-4 py-3'>" . $professor['email'] . "</td>
              <td class='px-4 py-3'>" . $professor['telefone'] . "</td>
              <td class='px-4 py-3 text-sm text-gray-600'>" . $tudojunto['cargo'][0]['descricao'] . "</td>
              <td class='px-4 py-3'>
                <button type='button' 
                        onclick='selectProfessor(" . $professor['idusuario'] . ")' 
                        class='px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg'>
                  Selecionar
                </button>
              </td>
            </tr>
          ";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Campo oculto para armazenar o ID do professor selecionado -->
  <input type="hidden" id="selectedProfessorId" name="professor_id" value="">

  <input type="submit" value="Cadastrar"
         class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-md cursor-pointer transition-colors" />
</form>

<script>
  function selectProfessor(id) {
    // Preenche o campo oculto com o ID do professor selecionado
    document.getElementById('selectedProfessorId').value = id;

    // Remove destaque anterior
    document.querySelectorAll('#professorTable tr').forEach(row => {
      row.classList.remove('bg-blue-100', 'ring-2', 'ring-blue-400');
    });

    // Destaca a linha selecionada
    const selectedRow = document.getElementById('professor-' + id);
    if (selectedRow) {
      selectedRow.classList.add('bg-blue-100', 'ring-2', 'ring-blue-400');
    }
  }
</script>


</body>

</html>
