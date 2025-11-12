<?php
require_once __DIR__ . "/../code/funcao.php";
$tipo = 1;
if (isset($_GET['tipo'])) {
    $tipo = 0;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tabela de professor</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuração customizada do Tailwind -->
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              dark: '#0a0a0a',
              darkblue: '#0d1b2a',
              neonred: '#ff2e63',
              neongreen: '#39ff14',
              darkgray: '#1a1a1a',
            },
            fontFamily: {
              montserrat: ['Montserrat', 'sans-serif'],
            },
          },
        },
      }
    </script>

    <!-- CSS do DataTables (CDN) -->
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"
      onerror="this.onerror=null;this.href='./css/dataTable.css';"
    />

    <!-- jQuery (CDN com fallback local) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
      if (typeof jQuery === 'undefined') {
        document.write('<script src="./js/jquery-3.7.1.min.js"><\/script>')
      }
    </script>

    <!-- DataTables (CDN com fallback local) -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
      if (typeof $.fn.DataTable === 'undefined') {
        document.write('<script src="./js/dataTables.min.js"><\/script>')
      }
    </script>

    <!-- CSS do Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- JS do Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
      .animate-scaleUp {
        animation: scaleUp 0.3s ease;
      }

      @keyframes scaleUp {
        from {
          transform: scale(0.9);
          opacity: 0;
        }

        to {
          transform: scale(1);
          opacity: 1;
        }
      }
    </style>
  </head>

  <body class="bg-dark text-white font-montserrat">
    <div class="p-6">
      <button
        id="trocar"
        class="mb-6 px-4 py-2 rounded-lg bg-neonred hover:bg-neongreen transition text-dark font-semibold shadow-lg"
      >
        Trocar para card
      </button>

      <!-- Cards -->
      <div id="container_card" class="hidden items-center justify-center min-h-screen">
        <div
          class="bg-darkgray shadow-lg rounded-xl p-6 max-w-xs text-center border border-neonred"
        >
          <img
            src="https://randomuser.me/api/portraits/men/45.jpg"
            alt="Foto de Perfil"
            class="w-32 h-32 rounded-full mx-auto shadow-lg border-4 border-neonred"
          />
          <h2 class="mt-4 text-xl font-bold text-neongreen">John Doe</h2>
          <p class="text-gray-400 text-sm">Instrutor de Musculação</p>
          <button
            onclick="openModal()"
            class="mt-4 px-4 py-2 bg-neonred text-white rounded-lg hover:bg-neongreen hover:text-dark transition"
          >
            Ver mais
          </button>
        </div>

        <!-- Modal -->
        <div
          id="modal"
          class="fixed inset-0 bg-black/60 backdrop-blur-md hidden items-center justify-center z-50"
        >
          <div
            class="bg-darkblue rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative animate-scaleUp border border-neonred"
          >
            <!-- Botão fechar -->
            <button
              onclick="closeModal()"
              class="absolute top-3 right-3 text-gray-400 hover:text-white text-2xl"
            >
              &times;
            </button>

            <!-- Cabeçalho -->
            <div class="flex items-center gap-4 border-b border-neonred pb-4 mb-4">
              <img
                src="https://randomuser.me/api/portraits/men/45.jpg"
                alt="Foto"
                class="w-24 h-24 rounded-full shadow-lg border-2 border-neongreen"
              />
              <div>
                <h2 class="text-2xl font-bold text-neongreen">John Doe</h2>
                <p class="text-gray-300">Instrutor de Musculação</p>
                <span
                  class="inline-block mt-2 px-3 py-1 text-xs font-semibold text-dark bg-neongreen rounded-full"
                >
                  Presencial
                </span>
              </div>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-200">
              <p><span class="font-semibold text-neongreen">Avaliação:</span> ⭐⭐⭐⭐☆ (4.0)</p>
              <p><span class="font-semibold text-neongreen">Telefone:</span> (62) 99999-1234</p>
              <p>
                <span class="font-semibold text-neongreen">Email:</span> joao.silva@academia.com
              </p>
              <p><span class="font-semibold text-neongreen">Data da Aula:</span> 20/09/2025</p>
              <p><span class="font-semibold text-neongreen">Dia da Semana:</span> Segunda-feira</p>
              <p><span class="font-semibold text-neongreen">Horário:</span> 08:00 - 12:00</p>
              <p><span class="font-semibold text-neongreen">Salário:</span> R$ 3.500,00</p>
              <p><span class="font-semibold text-neongreen">ID Funcionário:</span> #12345</p>
              <p><span class="font-semibold text-neongreen">ID Aula:</span> #56789</p>
              <p><span class="font-semibold text-neongreen">ID Treino:</span> #98765</p>
              <p><span class="font-semibold text-neongreen">Data Atualização:</span> 15/09/2025</p>
              <p><span class="font-semibold text-neongreen">Data Contratação:</span> 01/03/2023</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabela -->
      <div class="bg-darkblue p-4 rounded-xl shadow-lg">
        <table id="container_tabela" class="display text-sm text-white w-full">
          <thead class="bg-darkgray text-neongreen">
            <tr>
              <th>Foto de Perfil</th>
              <th>Nome</th>
              <th>Cargo</th>
              <th>Modalidade</th>
              <th>Avaliação</th>
              <th>Descrição</th>
              <th>Telefone</th>
              <th>Email</th>
              <th>Data da Aula</th>
              <th>Dia da Semana</th>
              <th>Horários Disponíveis</th>
              <th>Hora Início</th>
              <th>Hora Fim</th>
              <?php if ($tipo == 0) { ?>
              <th>Salário</th>
              <th>ID Funcionário</th>
              <th>ID Aula</th>
              <th>ID Treino</th>
              <th>Data Atualização</th>
              <th>Data Contratação</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody class="divide-y divide-darkgray">
            <?php
          $professores = listarPerfilProfessor(null);
          foreach ($professores as $p) {
          ?>
            <tr class="hover:bg-darkgray/60 transition">
              <td>
                <img
                  src="./uploads/<?= $p['foto_perfil'] ?>"
                  alt="Foto de Perfil"
                  width="60"
                  class="rounded-full border-2 border-neonred"
                />
              </td>
              <td><?= $p['nome_professor'] ?></td>
              <td><?= $p['cargo_professor'] ?></td>
              <td><?= $p['modalidade'] ?></td>
              <td><?= $p['avaliacao_media'] ?></td>
              <td><?= $p['descricao'] ?></td>
              <td><?= $p['telefone_professor'] ?></td>
              <td><?= $p['email_professor'] ?></td>
              <td><?= $p['data_aula'] ?></td>
              <td><?= $p['dia_semana'] ?></td>
              <td><?= $p['horarios_disponiveis'] ?></td>
              <td><?= $p['hora_inicio'] ?></td>
              <td><?= $p['hora_fim'] ?></td>
              <?php if ($tipo == 0) { ?>
              <td><?= $p['salario'] ?></td>
              <td><?= $p['funcionario_id'] ?></td>
              <td><?= $p['idaula'] ?></td>
              <td><?= $p['treino_id'] ?></td>
              <td><?= $p['data_atualizacao'] ?></td>
              <td><?= $p['data_contratacao'] ?></td>
              <?php } ?>
            </tr>
            <?php
          };
          ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Inicializando DataTable -->
    <script>
      $(document).ready(function () {
        $('#container_tabela').DataTable({
          language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
          },
          paging: true,
          searching: true,
          info: true,
        })
      })
    </script>

    <!-- Modal -->
    <script>
      function openModal() {
        document.getElementById('modal').classList.remove('hidden')
        document.getElementById('modal').classList.add('flex')
      }
      function closeModal() {
        document.getElementById('modal').classList.remove('flex')
        document.getElementById('modal').classList.add('hidden')
      }
    </script>

    <!-- Troca tabela/cards -->
    <script>
      const btnTrocar = document.getElementById('trocar')
      const tabelaWrapper = document.getElementById('container_tabela')
      const cards = document.getElementById('container_card')

      btnTrocar.addEventListener('click', () => {
        tabelaWrapper.classList.toggle('hidden')
        cards.classList.toggle('hidden')
        cards.classList.add('flex')

        if (tabelaWrapper.classList.contains('hidden')) {
          btnTrocar.innerText = 'Trocar para Tabela'
        } else {
          btnTrocar.innerText = 'Trocar para Cards'
        }
      })
    </script>
  </body>
</html>
