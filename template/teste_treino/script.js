document.addEventListener('DOMContentLoaded', function() {
  const tabela = document.getElementById('tabela');
  const modal = document.getElementById('modal');
  const modalInputWrapper = document.getElementById('modalInputWrapper'); // Aqui será o lugar onde criaremos dinamicamente o input
  const btnSalvar = document.getElementById('btnSalvar');
  const btnCancelar = document.getElementById('btnCancelar');

  let celulaAtual = null;
  let valorOriginal = '';
  let inputDinamico = null;
  let treinos = [];

  fetch('api_listar_treinos.php')
    .then(res => res.json())
    .then(data => {
      treinos = data;
      montarTabela(data);
    });

  function montarTabela(lista) {
    lista.forEach(treino => {
      const linha = tabela.insertRow();
      linha.insertCell().textContent = treino.idtreino;
      linha.insertCell().textContent = treino.tipo;
      linha.insertCell().textContent = treino.horario;
      linha.insertCell().textContent = treino.descricao;
    });
  }

  tabela.addEventListener('dblclick', function(e) {
    const celula = e.target;

    if (celula.tagName.toLowerCase() === 'td') {
      const colunaIndex = celula.cellIndex;
      if (colunaIndex === 0) {
        alert('O campo ID não pode ser editado.');
        return;
      }

      celulaAtual = celula;
      valorOriginal = celula.textContent;
      abrirModal(colunaIndex, valorOriginal);
    }
  });

  function abrirModal(colunaIndex, valor) {
    modalInputWrapper.innerHTML = ''; // Limpa input anterior
    inputDinamico = document.createElement('input');

    // Decide o tipo de input baseado na coluna
    if (colunaIndex === 2) { // Horário
      inputDinamico.type = 'time';
      inputDinamico.value = valor;
    } else if (colunaIndex === 1) { // Tipo de treino
      inputDinamico.type = 'text';
      inputDinamico.value = valor;
    } else if (colunaIndex === 3) { // Descrição
      inputDinamico = document.createElement('textarea');
      inputDinamico.rows = 4;
      inputDinamico.value = valor;
    } else {
      inputDinamico.type = 'text';
      inputDinamico.value = valor;
    }

    inputDinamico.classList.add('input-modal');
    modalInputWrapper.appendChild(inputDinamico);
    modal.classList.remove('hidden');
    inputDinamico.focus();
  }

  btnSalvar.addEventListener('click', function() {
    const novoValor = inputDinamico.value.trim();
    if (novoValor === '') {
      alert('O valor não pode ser vazio.');
      return;
    }

    if (celulaAtual) {
      celulaAtual.textContent = novoValor;
      const linha = celulaAtual.parentElement;
      const idtreino = linha.cells[0].textContent;
      const tipo = linha.cells[1].textContent;
      const horario = linha.cells[2].textContent;
      const descricao = linha.cells[3].textContent;

      fetch('api_editar_treino.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ idtreino, tipo, horario, descricao })
      })
      .then(response => response.json())
      .then(resposta => {
        if (!resposta.success) {
          alert('Erro ao salvar no servidor!');
        }
      });
    }
    fecharModal();
  });

  btnCancelar.addEventListener('click', fecharModal);

  window.addEventListener('click', function(e) {
    if (e.target === modal) {
      fecharModal();
    }
  });

  function fecharModal() {
    modal.classList.add('hidden');
    celulaAtual = null;
    valorOriginal = '';
    inputDinamico = null;
  }
});
