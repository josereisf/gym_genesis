<?php
require_once "../code/funcao.php";
require_once "../php/verificarLogado.php";

if ($_SESSION['tipo'] == 1) {
  $_SESSION['erro_login'] = "Usuário não permitido!";
  header('Location: dashboard_usuario.php');
  exit;
}

$idprofessor = $_SESSION['id']; // ID do professor, pode ser dinâmico conforme a sessão do usuário
$resultado = listarUsuarioCompleto($idprofessor);
foreach ($resultado as $r) {

  $nome = $r['nome'];
}
$idaula = null;
$alunos = listarAulaUsuario($idaula);

$data = [];

foreach ($alunos as $a) {
  $idaluno = $a['usuario_id'];
  $horarios = listarAulaAgendadaUsuario($idaluno);

  if (!empty($horarios)) {
    $idtreino = $horarios[0]["treino_id"];
    $treino = listarTreino($idtreino);

    $item = [
      'dia'    => $horarios[0]['dia_semana'],
      'inicio' => $horarios[0]['hora_inicio'],
      'fim'    => $horarios[0]['hora_fim'],
      'treino' => $treino[0]['tipo'] ?? '',
      'alunos' => $a['nome_aluno']
    ];

    // chave única para evitar duplicados
    $key = $item['dia'] . $item['inicio'] . $item['fim'] . $item['treino'];

    $data[$key] = $item;
  }
}

// reindexa o array
$data = array_values($data);

$menus = [
  "Acompanhamento" => [
    ["icon" => "monitor_weight", "label" => "Consultar Metas e Peso", "href" => "#", "roles" => [2, 0]],
    ["icon" => "note_add", "label" => "Registrar Peso", "href" => "#", "roles" => [2, 0]],
  ],

  "Aulas" => [
    ["icon" => "calendar_today", "label" => "Ver Aulas Agendadas", "href" => "#", "roles" => [2, 0]],
    ["icon" => "event_available", "label" => "Agendar Aula", "href" => "#", "roles" => [2, 0]],
  ],

  "Avaliação Física" => [
    ["icon" => "analytics", "label" => "Consultar Avaliações", "href" => "#", "roles" => [2, 0]],
    ["icon" => "add_chart", "label" => "Registrar Avaliação", "href" => "#", "roles" => [2, 0]],
  ],

  "Treinos" => [
    ["icon" => "fitness_center", "label" => "Criar/Editar Treino", "href" => "#", "roles" => [2, 0]],
    ["icon" => "check_circle", "label" => "Registrar Execução", "href" => "#", "roles" => [2, 0]],
    ["icon" => "list_alt", "label" => "Visualizar Treinos", "href" => "#", "roles" => [2, 0]],
    ["icon" => "library_books", "label" => "Biblioteca de Exercícios", "href" => "#", "roles" => [2, 0]],
  ],

  "Nutrição" => [
    ["icon" => "restaurant", "label" => "Consultar Dieta", "href" => "#", "roles" => [2, 0]],
    ["icon" => "note_add", "label" => "Criar/Editar Dieta", "href" => "#", "roles" => [2, 0]],
  ],

  "Conta / Administração" => [
    ["icon" => "admin_panel_settings", "label" => "Gerenciar Funcionários", "href" => "#", "roles" => [0]],
    ["icon" => "link", "label" => "Vincular Professor e Aluno", "href" => "#", "roles" => [0]],
  ],

  "Loja" => [
    ["icon" => "shopping_cart", "label" => "Realizar Pedido", "href" => "#", "roles" => [0]],
    ["icon" => "inventory", "label" => "Gerenciar Pedidos", "href" => "#", "roles" => [0]],
    ["icon" => "store", "label" => "Gerenciar Produtos", "href" => "#", "roles" => [0]],
    ["icon" => "payments", "label" => "Gerenciar Pagamentos", "href" => "#", "roles" => [0]],
  ],

  "Assinaturas" => [
    ["icon" => "credit_card", "label" => "Assinar Plano", "href" => "#", "roles" => [0]],
    ["icon" => "manage_accounts", "label" => "Gerenciar Planos", "href" => "#", "roles" => [0]],
    ["icon" => "subscriptions", "label" => "Gerenciar Assinaturas", "href" => "#", "roles" => [0]],
  ],

  "Fórum" => [
    ["icon" => "forum", "label" => "Criar Tópico", "href" => "#", "roles" => [2, 0]],
    ["icon" => "question_answer", "label" => "Responder Tópico", "href" => "#", "roles" => [2, 0]],
    ["icon" => "manage_history", "label" => "Gerenciar Fórum", "href" => "#", "roles" => [0]],
  ],

  "Configurações" => [
    ["icon" => "settings", "label" => "Configurações Gerais", "href" => "#", "roles" => [0]],
  ],
];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Professor - Gym Gênesis</title>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet"
    href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"
    onerror="this.onerror=null;this.href='./css/dataTable.css';">
  <link rel="stylesheet"
    href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
  <link rel="stylesheet"
    type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet"
    type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    if (typeof jQuery === "undefined") {
      document.write('<script src="./js/jquery-3.7.1.min.js"><\/script>');
    }
  </script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    if (typeof $.fn.DataTable === "undefined") {
      document.write('<script src="./js/dataTables.min.js"><\/script>');
    }
  </script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>


<body class="bg-gray-950 text-white font-sans">
  <div class="flex min-horarios-screen">
    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-gray-900 to-gray-800 p-6 flex flex-col shadow-xl border-r border-gray-700">
      <!-- Logo -->
      <div class="flex flex-col items-center mb-8">
        <img src="./img/logo.png"
          alt="Logo Gym Gênesis"
          class="mb-4 w-24 h-24 object-contain">
        <h2 class="text-2xl font-extrabold text-indigo-400">Gym Gênesis</h2>
      </div>

<?php
$usuarioRole = 2; // 0 = admin, 2 = professor

echo '<nav class="w-full flex-1">';

foreach ($menus as $grupo => $links) {
  // Verifica se o grupo tem ao menos 1 link permitido
  $linksPermitidos = array_filter($links, function ($link) use ($usuarioRole) {
    return in_array($usuarioRole, $link["roles"]);
  });

  if (count($linksPermitidos) === 0) {
    continue; // pula o grupo se não tiver link permitido
  }

  echo '
  <div class="accordion-group border-b border-gray-700">
    <button class="accordion-toggle flex justify-between items-center w-full px-4 py-3 text-gray-300 hover:bg-indigo-600 hover:text-white transition">
      <span class="text-sm font-semibold uppercase tracking-wider">' . $grupo . '</span>
      <span class="material-icons">chevron_right</span>
    </button>
    <div class="accordion-content hidden flex-col bg-gray-800">';

  foreach ($linksPermitidos as $link) {
    echo '
      <a href="' . $link["href"] . '" class="flex items-center gap-3 text-gray-300 hover:bg-indigo-500 hover:text-white px-4 py-2 transition">
        <span class="material-icons">' . $link["icon"] . '</span>
        <span>' . $link["label"] . '</span>
      </a>';
  }

  echo '
    </div>
  </div>';
}

echo '</nav>';
?>

    </aside>


    <!-- Main content -->
    <div class="flex-1 p-10 overflow-y-auto" x-data="{ modal: false, aula: null }">
      <!-- Header -->
      <header class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-extrabold text-indigo-400">Painel do Professor</h1>
        <div class="text-gray-400 text-lg">Bem-vindo(a), Professor <?= $nome ?>👋</div>
      </header>

      <!-- Calendário -->
      <div class="bg-gray-900 p-6 rounded-2xl shadow-lg mb-10 border border-gray-700">
        <h2 class="text-2xl font-semibold text-indigo-300 mb-6">Agenda de Aulas</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          <template
            <?php
            echo 'x-for="(item, index) in [';
            $idaluno = null;
            $alunos = listarAulaUsuario($idprofessor, $idaluno);

            foreach ($alunos as $a) {
              $idaluno = $a['idaluno'];
              $horarios = listarAulaAgendadaUsuario($idaluno);
              $idtreino = $horarios[0]["treino_id"];
              $treino = listarTreino($idtreino);
              echo "{
                dia: '" . $horarios[0]['dia_semana'] . "',
                inicio: '" . $horarios[0]['hora_inicio'] . "',
                fim: '" . $horarios[0]['hora_fim'] . "',
                treino: '" . $treino[0]['tipo'] . "',
                alunos: '" . $a['nome_aluno'] . "'
              },";
            }
            echo ']" :key="index"';
            ?>>
            <div @click="modal = true; aula = item" class="cursor-pointer bg-gray-800 p-5 rounded-2xl hover:bg-indigo-600 transition shadow-md border border-gray-700">
              <h3 class="text-lg font-bold text-indigo-200" x-text="item.dia"></h3>
              <p class="text-sm mt-2 text-gray-300">
                Horário: <span x-text="item.inicio + ' - ' + item.fim"></span>
              </p>
              <p class="text-sm text-gray-300">
                Treino: <span x-text="item.treino"></span>
              </p>
              <p class="text-sm text-gray-300">
                Alunos: <span x-text="item.alunos"></span>
              </p>
            </div>
          </template>
        </div>
        <!-- Modal -->
        <div x-show="modal" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-50" x-cloak>
          <div class="bg-gray-900 p-8 rounded-2xl w-full max-w-md shadow-xl border border-indigo-600">
            <h2 class="text-2xl font-bold mb-4 text-indigo-400">Detalhes da Aula</h2>
            <p class="mb-2"><strong>Dia:</strong> <span x-text="aula?.dia"></span></p>
            <p class="mb-2"><strong>Horário:</strong> <span x-text="aula?.inicio + ' - ' + aula?.fim"></span></p>
            <p class="mb-2"><strong>Treino:</strong> <span x-text="aula?.treino"></span></p>
            <p class="mb-4"><strong>Alunos:</strong> <span x-text="aula?.alunos"></span></p>
            <div class="text-right">
              <button @click="modal = false" class="bg-indigo-600 hover:bg-indigo-700 px-5 py-2 rounded-full text-white font-semibold">Fechar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabela de Alunos -->

      <div class="bg-gray-900 p-6 rounded-2xl shadow-lg mb-10">
        <h2 class="text-2xl font-semibold text-indigo-300 mb-6">Meus Alunos</h2>

        <div class="overflow-x-auto rounded-lg border border-gray-700">
          <table id="tabelaAlunos" class="w-full text-left border-collapse text-sm">
            <thead class="bg-gray-800 text-indigo-300 uppercase text-xs tracking-wider">
              <tr>
                <th class="border-b border-gray-700 p-3">Nome</th>
                <th class="border-b border-gray-700 p-3">Objetivo</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
              <?php
              if (!empty($alunos)) {
                foreach ($alunos as $a) {
                  $idaluno = $a["usuario_id"] ?? null;
                  $meta = $idaluno ? listarMetaUsuario($idaluno) : [];
                  $objetivo = !empty($meta) ? $meta[0]["descricao"] : "—";

                  echo "
            <tr class='hover:bg-gray-800 transition'>
              <td class='p-3 font-medium text-gray-200'>" . htmlspecialchars($a["nome_aluno"]) . "</td>
              <td class='p-3 text-gray-400'>" . htmlspecialchars($objetivo) . "</td>
            </tr>";
                }
              } else {
                echo "
          <tr>
            <td colspan='2' class='p-4 text-center text-gray-500'>
              Nenhum aluno encontrado.
            </td>
          </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>




      <!-- Fórum acesso -->
      <div class="bg-gradient-to-r from-purple-700 via-purple-800 to-purple-900 p-8 rounded-2xl shadow-xl text-center border border-purple-600">
        <h2 class="text-2xl font-semibold text-white mb-4">Participar do Fórum</h2>
        <p class="text-purple-200 mb-6">Conecte-se com outros professores, compartilhe dicas e experiências.</p>
        <button class="bg-white text-purple-800 hover:bg-purple-100 px-6 py-3 rounded-full font-bold shadow-sm">
          <span class="material-icons align-middle mr-2">forum</span> Ir para o Fórum
        </button>
      </div>
    </div>
  </div>
  <script>
    $(".accordion-toggle").on("click", function() {
      let $group = $(this).closest(".accordion-group");
      let $content = $group.find(".accordion-content");

      // Fecha os outros
      $(".accordion-content").not($content).slideUp();
      $(".accordion-toggle .material-icons").text("chevron_right");

      // Só alterna se tiver conteúdo
      if ($content.length && $content.children().length > 0) {
        $content.stop(true, true).slideToggle();

        // Ícone
        let $icon = $(this).find(".material-icons");
        if ($content.is(":visible")) {
          $icon.text("expand_more");
        } else {
          $icon.text("chevron_right");
        }
      }
    });

    $(document).ready(function() {
      let aulas = <?php echo json_encode($data); ?>;

      // monta os cards no carrossel
      aulas.forEach((item, index) => {
        $("#aulasCarousel").append(`
        <div class="aula-card cursor-pointer bg-gray-800 p-5 rounded-2xl hover:bg-indigo-600 transition shadow-md border border-gray-700 mx-2"
             data-index="${index}">
          <h3 class="text-lg font-bold text-indigo-200">${item.dia}</h3>
          <p class="text-sm mt-2 text-gray-300">Horário: ${item.inicio} - ${item.fim}</p>
          <p class="text-sm text-gray-300">Treino: ${item.treino}</p>
          <p class="text-sm text-gray-300">Alunos: ${item.alunos}</p>
        </div>
      `);
      });

      // inicializa o slick carrossel
      $("#aulasCarousel").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true, // loop infinito
        arrows: true, // setas de navegação
        dots: true, // bolinhas de navegação
        autoplay: true, // ativa autoplay
        autoplaySpeed: 3000, // tempo entre slides (3s)
        speed: 600, // velocidade da transição (ms)
        cssEase: "ease-in-out", // suaviza a transição
        pauseOnHover: true, // pausa autoplay ao passar o mouse
        pauseOnFocus: true, // pausa autoplay se focar
        adaptiveHeight: true, // altura automática de acordo com conteúdo
        responsive: [{
            breakpoint: 1280, // telas grandes
            settings: {
              slidesToShow: 2
            }
          },
          {
            breakpoint: 768, // tablets
            settings: {
              slidesToShow: 1
            }
          }
        ]
      });


      // abre modal ao clicar no card
      $(document).on("click", ".aula-card", function() {
        let index = $(this).data("index");
        let aula = aulas[index];

        $("#modalDia").text(aula.dia);
        $("#modalHorario").text(aula.inicio + " - " + aula.fim);
        $("#modalTreino").text(aula.treino);
        $("#modalAlunos").text(aula.alunos);

        $("#modal").removeClass("hidden").fadeIn();
      });

      // fecha modal
      $("#fecharModal").click(function() {
        $("#modal").fadeOut(() => {
          $("#modal").addClass("hidden");
        });
      });
    });


    $(document).ready(function() {
      $("#tabelaAlunos").DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        language: {
          url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
        }
      });
    });
  </script>


</body>

</html>