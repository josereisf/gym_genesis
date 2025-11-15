$(document).ready(function () {
  let tabela = $('#tabelas').val() ||''
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
          console.log(item);
            let iditem = Object.keys(item).find(
              (key) => key.startsWith("id") && !key.endsWith("_id")
            );
          const linha = $('<tr></tr>')
          Object.keys(item).forEach((key) => {
            linha.append(`<td>${item[key] ?? '—'}</td>`)
          })

          // Botões de ação
          const botoes = `
            <td class="text-center space-x-2">
              <button
                class="editar px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition"
                data-id="${item[iditem]}">
                ✏️ Editar
              </button>
              <button
                class="excluir px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium transition"
                data-id="${item[iditem]}">
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
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
          },
        })

        $('#status').text('✅ Dados carregados com sucesso.')

        // 🧠 Reanexa eventos limpos
        $('#tabela-dados').on('click', '.editar', function () {
          const id = $(this).data('id')
          alert(`Editar registro ID: ${id}`)
          window.location.href = "http://localhost:83/public/formularioGenerico.php?tabela=" + tabela + "&id=" + id;
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
function getIdTabela(tabela) {
  switch (tabela) {
    case "alimento":
      return "idalimento";
    case "plano":
      return "idplano";
    case "usuario":
      return "idusuario";
    case "assinatura":
      return "idassinatura";
    case "cargo":
      return "idcargo";
    case "funcionario":
      return "idfuncionario";
    case "treino":
      return "idtreino";
    case "aula_agendada":
      return "idaula";
    case "aula_usuario":
      return "idaula"; // chave composta
    case "avaliacao_fisica":
      return "idavaliacao";
    case "categoria_produto":
      return "idcategoria";
    case "cupom_desconto":
      return "idcupom";
    case "dicas_nutricionais":
      return "iddicas_nutricionais";
    case "dieta":
      return "iddieta";
    case "refeicao":
      return "idrefeicao";
    case "dieta_alimentar":
      return "alimento_id"; // chave composta
    case "endereco":
      return "idendereco";
    case "exercicio":
      return "idexercicio";
    case "forum":
      return "idtopico"; // corrigido
    case "historico_peso":
      return "idhistorico_peso";
    case "historico_treino":
      return "idhistorico";
    case "pagamento":
      return "idpagamento";
    case "pedido":
      return "idpedido";
    case "produto":
      return "idproduto";
    case "item_pedido":
      return "pedido_id"; // chave composta
    case "meta_usuario":
      return "idmeta";
    case "pagamento_detalhe":
      return "idpagamento2"; // corrigido
    case "perfil_professor":
      return "idperfil";
    case "perfil_usuario":
      return "idperfil_usuario";
    case "recuperacao_senha":
      return "idrecuperacao_senha";
    case "resposta_forum":
      return "idresposta";
    case "treino_exercicio":
      return "idtreino2"; // corrigido
    default:
      return "";
  }
}
function excluirRegistro(tabela, id) {
  let idtabela = getIdTabela(tabela);
  let dadoParaEnviar = {};
  dadoParaEnviar[idtabela] = id; 
  $.ajax({
    url: `http://localhost:83/public/api/index.php?entidade=${tabela}&acao=deletar`,
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify(dadoParaEnviar),
    success: function () {
      alert('Registro excluído com sucesso!')
      listarTabela(tabela)
    },
    error: function () {
      alert('Erro ao excluir registro.')
    },
  })
}
