$(document).ready(function () {
  let tabela = $('#dados').data('tabela');
  let id = $('#dados').data('id');

  console.log("Tabela:", tabela);
  console.log("ID:", id);

  listarTabela(tabela, id);
});

// Função que lista os dados da tabela principal
function listarTabela(tabela, id) {
  $.ajax({
    url: 'http://localhost:83/public/api/index.php?entidade=' + tabela + '&acao=listar',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({ id: id }),
    success: function (data) {
      if (data.sucesso) {
        const dados = data.dados;
        console.table(dados);
        
      }
    },
    error: function() {
      alert('Erro ao listar os dados.');
    }
  });
}

// Função para preencher os selects de chaves estrangeiras
function preencherChavesEstrangeiras() {
  $('select.chaveEstrangeira').each(function() {
    let select = $(this);
    let tabela = select.data('tabela');
    let campo = select.data('campo');

    // Fazendo a requisição AJAX para preencher o select de chaves estrangeiras
    $.ajax({
      url: 'http://localhost:83/public/api/index.php?entidade=' + tabela + '&acao=listar',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({}),
      success: function (data) {
        if (data.sucesso) {
          const chaveEstrangeira = data.dados;
          if (campo.includes('treino')){
            nome_campo = 'tipo';
          }
          if (campo.includes('exercicio')){
            nome_campo = 'nome';
          }
          if (campo.includes('cargo')) {
            chaveNome = 'nome_cargo';   // Se for cargo_id, usa nome_cargo
          } 
          if (campo.includes('usuario')) {
          chaveNome = 'nome_professor'; // Se for usuario_id, usa nome_usuario
        }

          // Limpar o select antes de adicionar as opções
          select.empty();
          select.append('<option value="">Selecione...</option>'); // Adicionar a opção padrão

          // Adiciona as opções para cada chave estrangeira
          chaveEstrangeira.forEach(function(item) {
            select.append(
              $('<option>', {
                value: item.id, // ID do item
                text: item[nome_campo], // Texto do campo (ex: 'nome', 'descricao', etc.)
              })
            );
          });
        }
      },
      error: function() {
        alert('Erro ao carregar as chaves estrangeiras.');
      }
    });
  });
}