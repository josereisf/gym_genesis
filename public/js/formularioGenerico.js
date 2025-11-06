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
    error: function () {
      alert('Erro ao listar os dados.');
    }
  });
}

// Função para preencher os selects de chaves estrangeiras
function preencherChavesEstrangeiras() {
  $('select.chaveEstrangeira').each(function () {
    let select = $(this);
    let tabela = select.data('tabela');
    let campo = select.data('campo');
    let ideditar = select.data('ideditar');

    // Fazendo a requisição AJAX para preencher o select de chaves estrangeiras
    $.ajax({
      url: 'http://localhost:83/public/api/index.php?entidade=' + tabela + '&acao=listar',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({}),
      success: function (data) {
        if (data.sucesso) {
          const chaveEstrangeira = data.dados;
          if (campo.includes('treino')) {
            nome_campo = 'tipo';
          }
          if (campo.includes('exercicio')) {
            nome_campo = 'nome';
          }
          if (campo.includes('cargo')) {
            nome_campo = 'nome_cargo';
          }
          if (campo.includes('usuario') || campo.includes('funcionario')) {
            if (tabela === 'funcionario' || tabela === 'perfil_professor') {
              ideditar += 20;
              console.log('Ajustando ideditar para funcionario:', ideditar);
            }
            nome_campo = 'nome_usuario';
          }
          if (campo.includes('dieta')) {
            nome_campo = 'descricao';
          }
          if (campo.includes('pagamento')) {
            nome_campo = 'metodo';
          }
          // Limpar o select antes de adicionar as opções
          select.empty();
          select.append('<option value="">Selecione...</option>');
          //select.append('<option value="">Selecione...</option>'); // Adicionar a opção padrão
          // Adiciona as opções para cada chave estrangeira
          chaveEstrangeira.forEach(function (item) {
            if (item[campo] == ideditar) {
              selecionado = true;
            }
            else {
              selecionado = false;
            }
            //  console.log('Adicionando opção:', {
            //    value: item[campo], // ID do item
            //    text: item[nome_campo], // Texto do campo (ex: 'nome', 'descricao', etc.)
            //    selected: selecionado
            //  });
            select.append(
              $('<option>', {
                value: item[campo], // ID do item
                text: item[nome_campo], // Texto do campo (ex: 'nome', 'descricao', etc.)
                selected: selecionado
              })
            );
          });
        }
      },
      error: function () {
        alert('Erro ao carregar as chaves estrangeiras.');
      }
    });
  });
}

function editarRegistro(tabela) {
  let id = "2";
  let dadosFormulario = $('#formGenerico').serializeArray();
  let dadosParaEnviar = {};
  console.log('Dados para enviar:', dadosParaEnviar);

  dadosFormulario.forEach(function (item) {
    dadosParaEnviar[item.name] = item.value;
  });

  
  // Adicionar o ID aos dados que serão enviados
  dadosParaEnviar.id = id;
  console.log('Dados para enviar:', dadosParaEnviar);


  const teste = JSON.stringify(dadosParaEnviar);
  console.log('Dados JSON:', teste);

  $.ajax({
    url: 'http://localhost:83/public/api/index.php?entidade=' + tabela + '&acao=editar',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify(dadosParaEnviar), // Enviar os dados do formulário
    success: function (data) {
      if (data.sucesso) {
        alert('Registro editado com sucesso!');
        // Redirecionar ou atualizar a página conforme necessário
        window.location.href = 'listar.php?tabela=' + tabela;
      } else {
        alert('Erro ao editar: ' + (data.mensagem || 'Erro desconhecido'));
      }
    },
    error: function (xhr, status, error) {
      // console.error('Erro na requisição:', error);
      // alert('Erro na comunicação com o servidor');
      console.error(error);
    }
  });
}