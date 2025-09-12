$(document).ready(function () {
  // Inicializar DataTables primeiro
  var table = $('#usersTable').DataTable({
    responsive: true,
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
      search: 'Pesquisar:',
      searchPlaceholder: 'Digite o nome, cargo ou email...',
      info: 'Mostrando _START_ até _END_ de _TOTAL_ professores',
      infoEmpty: 'Mostrando 0 até 0 de 0 professores',
      infoFiltered: '(filtrado de _MAX_ professores no total)',
      lengthMenu: 'Mostrar _MENU_ professores por página',
      paginate: {
        first: 'Primeira',
        previous: 'Anterior',
        next: 'Próxima',
        last: 'Última',
      },
    },
    dom: '<"flex flex-col md:flex-row justify-between items-center mb-6"<"mb-4 md:mb-0"l><"search-box">><"overflow-auto"t><"flex flex-col md:flex-row justify-between items-center mt-6"<"info-box"i><"pagination-box"p>>',
    pageLength: 10,
    order: [[1, 'asc']], // Ordenar pela coluna 1 (nome)
    columnDefs: [
      {
        orderable: false,
        targets: 0, // Não ordenar pela coluna de expansão
      },
    ],
    columns: [
      { data: null, defaultContent: '', className: 'dt-control' }, // Coluna de expansão
      { data: 'nome' }, // Nome do professor
      { data: 'contato' }, // Email e telefone
      { data: 'cargo' }, // Cargo e salário
      { data: 'avaliacao' }, // Avaliação
      { data: 'status' }, // Status
      { data: 'acoes' }, // Ações
    ],
    initComplete: function () {
      // Personalizar a caixa de pesquisa
      $('.dataTables_filter label')
        .contents()
        .filter(function () {
          return this.nodeType === 3
        })
        .remove()

      $('.dataTables_filter input')
        .addClass(
          'px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200'
        )
        .attr('placeholder', 'Pesquisar professores...')
        .wrap('<div class="relative"></div>')

      $('.dataTables_filter').prepend(
        '<i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>'
      )
      $('.dataTables_filter input').css('padding-left', '2.5rem')

      // Personalizar a informação de paginação
      $('#usersTable_info')
        .addClass('text-sm text-gray-600 bg-blue-50 px-4 py-2 rounded-lg border border-blue-100')
        .prepend('<i class="fas fa-info-circle mr-2 text-blue-500"></i>')

      // Adicionar eventos de clique após a inicialização da tabela
      addRowExpansionEvents()
    },
  })

  // Função para adicionar eventos de expansão/recolhimento
  function addRowExpansionEvents() {
    // Usar delegação de eventos para funcionar com paginação
    $('#usersTable tbody').on('click', '.dt-hasChild', function () {
      const $row = $(this)
      const $childRow = $row.next('.dt-child')

      // Verificar se a linha filha existe
      if ($childRow.length) {
        $row.toggleClass('dtr-expanded')
        $childRow.toggleClass('hidden')

        // Atualizar ícone
        const $icon = $row.find('.expand-icon')
        if ($row.hasClass('dtr-expanded')) {
          $icon.removeClass('fa-plus-circle').addClass('fa-minus-circle')
        } else {
          $icon.removeClass('fa-minus-circle').addClass('fa-plus-circle')
        }
      }
    })
  }

  // Mover a caixa de pesquisa para o container personalizado
  $('.search-box').append($('#usersTable_filter'))

  // Mover a informação para o container personalizado
  $('.info-box').append($('#usersTable_info'))

  // Estilizar a paginação
  $('.pagination-box').append($('#usersTable_paginate'))
  $('#usersTable_paginate').addClass('flex space-x-2')
  $('#usersTable_paginate .paginate_button').addClass(
    'px-3 py-1 rounded-lg border border-gray-300 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-all duration-200'
  )
  $('#usersTable_paginate .paginate_button.current').addClass(
    'bg-blue-500 text-white border-blue-500'
  )

  // Reaplicar eventos quando a página é alterada
  table.on('draw', function () {
    addRowExpansionEvents()
  })

  // Alternar entre visualização de tabela e cards
  $('#tableViewBtn').click(function () {
    $('#tableView').addClass('active-view')
    $('#cardView').removeClass('active-view')
    $(this).removeClass('bg-gray-200 text-gray-700').addClass('btn-active')
    $('#cardViewBtn').removeClass('btn-active').addClass('bg-gray-200 text-gray-700')
  })

  $('#cardViewBtn').click(function () {
    $('#cardView').addClass('active-view')
    $('#tableView').removeClass('active-view')
    $(this).removeClass('bg-gray-200 text-gray-700').addClass('btn-active')
    $('#tableViewBtn').removeClass('btn-active').addClass('bg-gray-200 text-gray-700')
  })

  // Adicionar eventos inicialmente
  addRowExpansionEvents()
})

$(document).ready(function () {
  // Inicializar DataTables
  var table = $('#usersTable').DataTable({
    responsive: true,
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
    },
    pageLength: 10,
    order: [[1, 'asc']],
    columnDefs: [
      {
        orderable: false,
        targets: 0,
      },
    ],
  })

  // Adicionar eventos de expansão
  $('#usersTable tbody').on('click', '.dt-hasChild', function () {
    var tr = $(this)
    var row = table.row(tr)
    var funcionarioId = tr.find('.text-gray-500:contains("ID:")').text().replace('ID: ', '').trim()

    if (row.child.isShown()) {
      row.child.hide()
      tr.removeClass('shown')
      tr.find('.expand-icon').removeClass('fa-minus-circle').addClass('fa-plus-circle')
    } else {
      // Mostrar detalhes do container separado
      var detailsContent = $('#details-' + funcionarioId).html()
      row.child(detailsContent).show()
      tr.addClass('shown')
      tr.find('.expand-icon').removeClass('fa-plus-circle').addClass('fa-minus-circle')
    }
  })
})

$(document).ready(function () {
  // Inicializar DataTables
  var table = $('#usersTable').DataTable({
    responsive: true,
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
      search: 'Pesquisar:',
      searchPlaceholder: 'Digite o nome, cargo ou email...',
      info: 'Mostrando _START_ até _END_ de _TOTAL_ professores',
      infoEmpty: 'Mostrando 0 até 0 de 0 professores',
      infoFiltered: '(filtrado de _MAX_ professores no total)',
      lengthMenu: 'Mostrar _MENU_ professores por página',
      paginate: {
        first: 'Primeira',
        previous: 'Anterior',
        next: 'Próxima',
        last: 'Última',
      },
    },
    dom: '<"flex flex-col md:flex-row justify-between items-center mb-6"<"mb-4 md:mb-0"l><"search-box">><"overflow-auto"t><"flex flex-col md:flex-row justify-between items-center mt-6"<"info-box"i><"pagination-box"p>>',
    pageLength: 10,
    order: [[1, 'asc']],
    columnDefs: [
      {
        orderable: false,
        targets: 0,
      },
    ],
    initComplete: function () {
      // Personalizar a caixa de pesquisa
      customizeSearchBox()

      // Personalizar a informação de paginação
      customizePaginationInfo()

      // Mover elementos para os containers personalizados
      moveElementsToCustomContainers()

      // Adicionar eventos de expansão
      addRowExpansionEvents()
    },
  })

  // Função para personalizar a caixa de pesquisa
  function customizeSearchBox() {
    $('.dataTables_filter label')
      .contents()
      .filter(function () {
        return this.nodeType === 3
      })
      .remove()

    $('.dataTables_filter input')
      .addClass(
        'px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200'
      )
      .attr('placeholder', 'Pesquisar professores...')
      .wrap('<div class="relative"></div>')

    $('.dataTables_filter').prepend(
      '<i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>'
    )
    $('.dataTables_filter input').css('padding-left', '2.5rem')
  }

  // Função para personalizar a informação de paginação
  function customizePaginationInfo() {
    $('#usersTable_info')
      .addClass('text-sm text-gray-600 bg-blue-50 px-4 py-2 rounded-lg border border-blue-100')
      .prepend('<i class="fas fa-info-circle mr-2 text-blue-500"></i>')
  }

  // Função para mover elementos para containers personalizados
  function moveElementsToCustomContainers() {
    // Mover a caixa de pesquisa
    $('.search-box').append($('#usersTable_filter'))

    // Mover a informação
    $('.info-box').append($('#usersTable_info'))

    // Mover e estilizar a paginação
    $('.pagination-box').append($('#usersTable_paginate'))
    $('#usersTable_paginate').addClass('flex space-x-2')
    $('#usersTable_paginate .paginate_button').addClass(
      'px-3 py-1 rounded-lg border border-gray-300 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-all duration-200'
    )
    $('#usersTable_paginate .paginate_button.current').addClass(
      'bg-blue-500 text-white border-blue-500'
    )
  }

  // Função para adicionar eventos de expansão/recolhimento
  function addRowExpansionEvents() {
    $('#usersTable tbody').on('click', '.dt-hasChild', function () {
      const $row = $(this)
      const funcionarioId = $row.find('.text-gray-500').text().replace('ID: ', '').trim()
      const $childRow = $row.next('.dt-child')

      if ($childRow.length) {
        $row.toggleClass('dtr-expanded')
        $childRow.toggleClass('hidden')

        // Atualizar ícone
        const $icon = $row.find('.expand-icon')
        if ($row.hasClass('dtr-expanded')) {
          $icon.removeClass('fa-plus-circle').addClass('fa-minus-circle')
        } else {
          $icon.removeClass('fa-minus-circle').addClass('fa-plus-circle')
        }
      }
    })
  }

  // Alternar entre visualização de tabela e cards
  $('#tableViewBtn').click(function () {
    $('#tableView').removeClass('hidden')
    $('#cardView').addClass('hidden')
    $(this).removeClass('bg-gray-200 text-gray-700').addClass('bg-blue-500 text-white')
    $('#cardViewBtn').removeClass('bg-blue-500 text-white').addClass('bg-gray-200 text-gray-700')

    // Redesenhar a tabela para garantir que esteja visível corretamente
    table.draw()
  })

  $('#cardViewBtn').click(function () {
    $('#cardView').removeClass('hidden')
    $('#tableView').addClass('hidden')
    $(this).removeClass('bg-gray-200 text-gray-700').addClass('bg-blue-500 text-white')
    $('#tableViewBtn').removeClass('bg-blue-500 text-white').addClass('bg-gray-200 text-gray-700')
  })

  // Reaplicar eventos quando a página é alterada
  table.on('draw', function () {
    addRowExpansionEvents()
  })

  // Adicionar eventos inicialmente
  addRowExpansionEvents()

  // Inicializar com a visualização de tabela ativa
  $('#tableViewBtn').addClass('bg-blue-500 text-white')
  $('#cardViewBtn').addClass('bg-gray-200 text-gray-700')
})

$(document).ready(function () {
  // Inicializar DataTables
  var table = $('#usersTable').DataTable({
    responsive: true,
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
      search: 'Pesquisar:',
      searchPlaceholder: 'Digite o nome, cargo ou email...',
      info: 'Mostrando _START_ até _END_ de _TOTAL_ professores',
      infoEmpty: 'Mostrando 0 até 0 de 0 professores',
      infoFiltered: '(filtrado de _MAX_ professores no total)',
      lengthMenu: 'Mostrar _MENU_ professores por página',
      paginate: {
        first: 'Primeira',
        previous: 'Anterior',
        next: 'Próxima',
        last: 'Última',
      },
    },
    dom: '<"flex flex-col md:flex-row justify-between items-center mb-6"<"mb-4 md:mb-0"l><"search-box">><"overflow-auto"t><"flex flex-col md:flex-row justify-between items-center mt-6"<"info-box"i><"pagination-box"p>>',
    pageLength: 10,
    order: [[1, 'asc']],
    columnDefs: [
      {
        orderable: false,
        targets: 0,
      },
    ],
    initComplete: function () {
      // Personalizar a caixa de pesquisa
      customizeSearchBox()

      // Personalizar a informação de paginação
      customizePaginationInfo()

      // Mover elementos para os containers personalizados
      moveElementsToCustomContainers()

      // Adicionar eventos de expansão
      addRowExpansionEvents()
    },
  })

  // Função para personalizar a caixa de pesquisa
  function customizeSearchBox() {
    $('.dataTables_filter label')
      .contents()
      .filter(function () {
        return this.nodeType === 3
      })
      .remove()

    $('.dataTables_filter input')
      .addClass(
        'px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200'
      )
      .attr('placeholder', 'Pesquisar professores...')
      .wrap('<div class="relative"></div>')

    $('.dataTables_filter').prepend(
      '<i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>'
    )
    $('.dataTables_filter input').css('padding-left', '2.5rem')
  }

  // Função para personalizar a informação de paginação
  function customizePaginationInfo() {
    $('#usersTable_info')
      .addClass('text-sm text-gray-600 bg-blue-50 px-4 py-2 rounded-lg border border-blue-100')
      .prepend('<i class="fas fa-info-circle mr-2 text-blue-500"></i>')
  }

  // Função para mover elementos para containers personalizados
  function moveElementsToCustomContainers() {
    // Mover a caixa de pesquisa
    $('.search-box').append($('#usersTable_filter'))

    // Mover a informação
    $('.info-box').append($('#usersTable_info'))

    // Mover e estilizar a paginação
    $('.pagination-box').append($('#usersTable_paginate'))
    $('#usersTable_paginate').addClass('flex space-x-2')
    $('#usersTable_paginate .paginate_button').addClass(
      'px-3 py-1 rounded-lg border border-gray-300 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-all duration-200'
    )
    $('#usersTable_paginate .paginate_button.current').addClass(
      'bg-blue-500 text-white border-blue-500'
    )
  }

  // Função para adicionar eventos de expansão/recolhimento
  function addRowExpansionEvents() {
    $('#usersTable tbody').on('click', '.dt-hasChild', function () {
      var tr = $(this)
      var row = table.row(tr)
      var funcionarioId = tr
        .find('.text-gray-500:contains("ID:")')
        .text()
        .replace('ID: ', '')
        .trim()
      var childRow = tr.next('.dt-child')

      if (childRow.length) {
        tr.toggleClass('dtr-expanded')
        childRow.toggleClass('hidden')

        // Atualizar ícone
        var icon = tr.find('.expand-icon')
        if (tr.hasClass('dtr-expanded')) {
          icon.removeClass('fa-plus-circle').addClass('fa-minus-circle')
        } else {
          icon.removeClass('fa-minus-circle').addClass('fa-plus-circle')
        }
      }
    })
  }

  // Alternar entre visualização de tabela e cards
  $('#tableViewBtn').click(function () {
    $('#tableView').removeClass('hidden')
    $('#cardView').addClass('hidden')
    $(this).removeClass('bg-gray-200 text-gray-700').addClass('bg-blue-500 text-white')
    $('#cardViewBtn').removeClass('bg-blue-500 text-white').addClass('bg-gray-200 text-gray-700')

    // Redesenhar a tabela para garantir que esteja visível corretamente
    table.draw()
  })

  $('#cardViewBtn').click(function () {
    $('#cardView').removeClass('hidden')
    $('#tableView').addClass('hidden')
    $(this).removeClass('bg-gray-200 text-gray-700').addClass('bg-blue-500 text-white')
    $('#tableViewBtn').removeClass('bg-blue-500 text-white').addClass('bg-gray-200 text-gray-700')
  })

  // Reaplicar eventos quando a página é alterada
  table.on('draw', function () {
    addRowExpansionEvents()
  })

  // Adicionar eventos inicialmente
  addRowExpansionEvents()

  // Inicializar com a visualização de tabela ativa
  $('#tableViewBtn').addClass('bg-blue-500 text-white')
  $('#cardViewBtn').addClass('bg-gray-200 text-gray-700')
})

function toggleDetails(button) {
  var detailsContainer = $('#detailsContainer')

  // Alterna a visibilidade do container de detalhes
  detailsContainer.toggle()

  // Animação para abrir/fechar (opcional)
  if (detailsContainer.is(':visible')) {
    detailsContainer.slideDown() // Mostra a seção de detalhes com animação
  } else {
    detailsContainer.slideUp() // Esconde a seção de detalhes com animação
  }
}
