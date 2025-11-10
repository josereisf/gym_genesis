let dataTableInstance = null

function listarTabela(tabela, id) {
  $('#status').text('🔄 Carregando dados...')

  // 🔁 Limpa listeners antigos e DataTable antes de começar
  if (dataTableInstance) {
    dataTableInstance.clear().destroy()
    $('#tabela-dados thead').empty()
    $('#tabela-dados tbody').empty()
    dataTableInstance = null
  }
  $('#tabela-dados').off('click', '.editar')
  $('#tabela-dados').off('click', '.excluir')

  $.ajax({
    url: `http://localhost:83/public/api/index.php?entidade=${tabela}&acao=listar`,
    method: 'POST',
    contentType: 'application/json',
    dataType: 'json',
    data: JSON.stringify({ id: id }),
    success: function (data) {
      const tbody = $('#tabela-dados tbody')
      const thead = $('#tabela-dados thead')
      tbody.empty()
      thead.empty()

      if (data && data.sucesso && Array.isArray(data.dados) && data.dados.length > 0) {
        const dados = data.dados

        // 🧠 Cria cabeçalho
        const headerRow = $('<tr></tr>')
        Object.keys(dados[0]).forEach((key) => {
          headerRow.append(`<th>${key.charAt(0).toUpperCase() + key.slice(1)}</th>`)
        })
        headerRow.append('<th>Ações</th>')
        thead.append(headerRow)

        // 🧩 Cria linhas com dados
        dados.forEach((item) => {
          const linha = $('<tr></tr>')
          Object.keys(item).forEach((key) => {
            linha.append(`<td>${item[key] ?? '—'}</td>`)
          })

          // Botões de ação
          const botoes = `
            <td class="text-center space-x-2">
              <button
                class="editar px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition"
                data-id="${item.id}">
                ✏️ Editar
              </button>
              <button
                class="excluir px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium transition"
                data-id="${item.id}">
                🗑️ Excluir
              </button>
            </td>
          `
          linha.append(botoes)
          tbody.append(linha)
        })

        // ⚙️ Inicializa DataTable do zero
        dataTableInstance = $('#tabela-dados').DataTable({
          pageLength: 10,
          destroy: true, // garante destruição anterior
          language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
          },
        })

        $('#status').text('✅ Dados carregados com sucesso.')

        // 🧠 Reanexa eventos limpos
        $('#tabela-dados').on('click', '.editar', function () {
          const id = $(this).data('id')
          alert(`Editar registro ID: ${id}`)
          // ex: abrir modal
        })

        $('#tabela-dados').on('click', '.excluir', function () {
          const id = $(this).data('id')
          if (confirm(`Tem certeza que deseja excluir o registro ID ${id}?`)) {
            excluirRegistro(tabela, id)
          }
        })
      } else {
        tbody.append('<tr><td colspan="100%">Nenhum dado encontrado.</td></tr>')
        $('#status').text('⚠️ Nenhum registro encontrado.')
      }
    },
    error: function (xhr, status, error) {
      console.error('❌ Erro ao buscar dados:', xhr.responseText)
      $('#status').text('❌ Erro ao buscar dados: ' + xhr.status)
    },
  })
}

function excluirRegistro(tabela, id) {
  $.ajax({
    url: `http://localhost:83/public/api/index.php?entidade=${tabela}&acao=excluir`,
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({ id: id }),
    success: function () {
      alert('Registro excluído com sucesso!')
      listarTabela(tabela)
    },
    error: function () {
      alert('Erro ao excluir registro.')
    },
  })
}
