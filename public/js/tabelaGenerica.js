$(document).ready(function () {
  let tabela = $('#tabelas').val() || ''
  let id = $('#dados').data('id')

  if (tabela) {
    listarTabela(tabela, id) // Carrega a tabela ao abrir a página
  }

  $('#tabelas').on('change', function () {
    tabela = $(this).val()
    console.log('Tabela:', tabela)
    console.log('ID:', id)

    listarTabela(tabela, id)
  })
})

function listarTabela(tabela, id) {
  $.ajax({
    url:
      'http://localhost:83/public/api/index.php?entidade=' +
      tabela +
      '&acao=listar',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({ id: id }),
    success: function (data) {
      const tbody = $('#tabela-dados tbody')
      const thead = $('#tabela-dados thead')
      tbody.empty()
      thead.empty()

      if (data.sucesso && data.dados.length > 0) {
        const dados = data.dados
        console.table(dados)

        // Cabeçalho
        let headerRow = $('<tr></tr>')
        Object.keys(dados[0]).forEach((key) => {
          headerRow.append(
            '<th>' + key.charAt(0).toUpperCase() + key.slice(1) + '</th>'
          )
        })
        thead.append(headerRow)

        // Linhas
        dados.forEach((item) => {
          let linha = $('<tr></tr>')
          Object.keys(item).forEach((key) => {
            linha.append(
              '<td>' + (item[key] !== null ? item[key] : 'N/A') + '</td>'
            )
          })
          tbody.append(linha)
        })
      } else {
        // Nenhum dado encontrado
        let colunas = data.dados[0] ? Object.keys(data.dados[0]).length : 1
        tbody.append(
          '<tr><td colspan="' + colunas + '">Nenhum dado encontrado</td></tr>'
        )
        console.log('Erro: Dados não encontrados')
      }
    },
    error: function (error) {
      console.error('Erro ao buscar dados:', error)
    },
  })
}
