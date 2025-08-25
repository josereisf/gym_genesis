    // ===============================
    // VARIÁVEIS GLOBAIS
    // ===============================
    let etapaAtual = 0;
    const etapas = document.querySelectorAll('.etapa');
    const video = document.getElementById("preview");
    const canvas = document.getElementById("canvas");
    const imgPreview = document.getElementById("imgPreview");
    const previewFoto = document.getElementById("previewFoto");
    const inputFile = document.getElementById('foto_input');

    // ===============================
    // FUNÇÃO: Atualiza barra de progresso
    // ===============================
    function atualizarProgresso() {
      const progresso = document.getElementById('barra-progresso');
      progresso.style.width = `${((etapaAtual + 1) / etapas.length) * 100}%`;
    }

    // ===============================
    // FUNÇÃO: Próxima etapa do formulário
    // ===============================
    function proximaEtapa() {
      etapas[etapaAtual].classList.add('hidden');
      etapaAtual++;

      if (etapaAtual < etapas.length) {
        etapas[etapaAtual].classList.remove('hidden');
        atualizarProgresso();

        if (etapas[etapaAtual].querySelector("video#preview")) {
          ativarCamera();
        }
      }
    }

    function etapaAnterior() {
      if (etapaAtual > 0) {
        etapas[etapaAtual].classList.add('hidden');
        etapaAtual--;
        etapas[etapaAtual].classList.remove('hidden');
        atualizarProgresso();

        if (etapas[etapaAtual].querySelector("video#preview")) {
          ativarCamera();
        }
      }
    }

    // ===============================
    // FUNÇÃO: Ativar câmera
    // ===============================
    let fotoUsuario = null; // vai guardar o nome da foto (capturada ou padrão)

    async function ativarCamera() {
      try {
        const stream = await navigator.mediaDevices.getUserMedia({
          video: true
        });
        video.srcObject = stream;
        video.play();
      } catch (error) {
        console.error('Erro ao acessar a câmera:', error);
        console.log('Não foi possível acessar a câmera. Essa etapa será ignorada.');

        // Define a imagem padrão
        fotoUsuario = "padrao.png";

        // Oculta a etapa de foto
        const etapaFoto = document.getElementById("etapa-foto");
        if (etapaFoto) {
          etapaFoto.remove(); // ou etapaFoto.classList.add("hidden");
        }

        // Avança automaticamente para a próxima etapa
        if (etapaAtual < etapas.length - 1) {
          etapas[etapaAtual].classList.add('hidden');
          etapaAtual++;
          etapas[etapaAtual].classList.remove('hidden');
          atualizarProgresso();
        }
      }
    }


    // ===============================
    // FUNÇÃO: Tirar foto
    // ===============================


    function tirarFoto() {
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      const ctx = canvas.getContext('2d');
      ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

      canvas.toBlob(blob => {
        // Cria um arquivo para o input file
        const file = new File([blob], 'foto.png', {
          type: 'image/png'
        });

        // Exibe o preview
        const reader = new FileReader();
        reader.onload = e => {
          imgPreview.src = e.target.result;
          previewFoto.classList.remove('hidden');
        };
        reader.readAsDataURL(file);

        // Cria DataTransfer para simular a seleção do arquivo no input file
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        inputFile.files = dataTransfer.files;
      }, 'image/png');
    }

    // Inicia a câmera ao carregar a etapa, por exemplo
    ativarCamera();


    // ===============================
    // DOMCarregado: Ações iniciais
    // ===============================
    document.addEventListener('DOMContentLoaded', () => {
      atualizarProgresso();

      // Mostrar botão "Continuar" apenas se algum objetivo for selecionado
      const checkboxes = document.querySelectorAll('input[name="objetivo[]"]');
      const botao = document.getElementById('btn-continuar');

      if (botao) {
        checkboxes.forEach(cb => {
          cb.addEventListener('change', () => {
            const algumSelecionado = Array.from(checkboxes).some(c => c.checked);
            botao.classList.toggle('hidden', !algumSelecionado);
          });
        });
      }

      // ========================
      // Restaurar e salvar campos comuns
      // ========================
      document.querySelectorAll("input, select").forEach(input => {
        const nome = input.name;

        const salvo = localStorage.getItem(nome);
        if (salvo) {
          if (input.type === "checkbox") {
            input.checked = salvo === "true";
          } else {
            input.value = salvo;
          }
        }

        input.addEventListener("input", () => {
          if (input.type === "checkbox") {
            localStorage.setItem(nome, input.checked);
          } else {
            localStorage.setItem(nome, input.value);
          }
        });
      });

      // ========================
      // Restaurar e salvar checkboxes múltiplos
      // ========================
      const objetivosSalvos = JSON.parse(localStorage.getItem("objetivo[]")) || [];

      checkboxes.forEach(cb => {
        if (objetivosSalvos.includes(cb.value)) cb.checked = true;

        cb.addEventListener("change", () => {
          const selecionados = Array.from(checkboxes)
            .filter(c => c.checked)
            .map(c => c.value);

          localStorage.setItem("objetivo[]", JSON.stringify(selecionados));

          if (botao) {
            botao.classList.toggle('hidden', selecionados.length === 0);
          }
        });
      });

      // Força botão aparecer se já tiver algo marcado
      const algumMarcado = Array.from(checkboxes).some(c => c.checked);
      if (botao && algumMarcado) botao.classList.remove('hidden');
    });

    // ========================
    // Limpa localStorage ao enviar
    // ========================
    document.getElementById("formulario").addEventListener("submit", () => {
      const campos = [
        "peso", "altura", "percentual_gordura",
        "meta", "horario_preferido", "objetivo[]"
      ];
      campos.forEach(c => localStorage.removeItem(c));
    });

    $('#formulario').on('keydown', function(e) {
  if (e.key === 'Enter') {
    e.preventDefault();
    console.log('Enter bloqueado neste campo');
  }
});
