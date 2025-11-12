$(document).ready(function () {
  let tabela_principal = $("#dados").data("tabela");
  let id = $("#dados").data("id");

  console.log("Tabela:", tabela_principal);
  console.log("ID:", id);

  listarTabela(tabela_principal, id);
});

// Função que lista os dados da tabela principal
function listarTabela(tabela, id) {
  let idtabela;
  idtabela = getIdTabela(tabela);
  $.ajax({
    url:
      "http://localhost:83/public/api/index.php?entidade=" +
      tabela +
      "&acao=listar",
    method: "POST",
    contentType: "application/json",
    data: JSON.stringify({ idtabela: id }),
    success: function (data) {
      if (data.sucesso) {
        const dados = data.dados;
        console.table(dados);
      }
    }
  });
}

// Função para preencher os selects de chaves estrangeiras
function preencherChavesEstrangeiras() {
  $("select.chaveEstrangeira").each(function () {
    let tabela_principal = $("#dados").data("tabela");
    let select = $(this);
    let campo = select.data("campo");
    let ideditar = select.data("ideditar");
    let tabela = campo.split("_")[0];

    if (tabela_principal == "perfil_usuario" || ( tabela == "usuario" && tabela_principal == "funcionario")) {
      tabela = "usuario";
    } else if (tabela == "usuario" && tabela_principal !== "perfil_professor") {
      tabela = "perfil_usuario";
    } else if (tabela == "dieta") {
      tabela = "refeicao";
    }
    // Fazendo a requisição AJAX para preencher o select de chaves estrangeiras
    $.ajax({
      url:
        "http://localhost:83/public/api/index.php?entidade=" +
        tabela +
        "&acao=listar",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({}),
      success: function (data) {
        if (data.sucesso) {
          const chaveEstrangeira = data.dados;
          if (campo.includes("treino")) {
            nome_campo = "tipo";
          }
          if (campo.includes("exercicio")) {
            nome_campo = "nome";
          }
          if (campo.includes("cargo")) {
            nome_campo = "nome";
          }
          if (campo.includes("usuario") || campo.includes("funcionario")) {
            nome_campo = "nome_usuario";
          }
          if (
            campo.includes("usuario") &&
            (tabela_principal == "perfil_usuario" || tabela_principal == "funcionario" || tabela_principal == "perfil_professor")
          ) {
            nome_campo = "idusuario";
          }
          if (campo.includes("dieta")) {
            nome_campo = "descricao";
          }
          if (campo.includes("pagamento")) {
            nome_campo = "idpagamento";
          }
          if (campo.includes("forum")) {
            nome_campo = "titulo";
          }
          console.log("Nome do campo para exibição:", tabela_principal);
          // Limpar o select antes de adicionar as opções
          select.empty();
          select.append('<option value="">Selecione...</option>');
          //select.append('<option value="">Selecione...</option>'); // Adicionar a opção padrão
          // Adiciona as opções para cada chave estrangeira
          chaveEstrangeira.forEach(function (item) {
            console.log("Item da chave estrangeira:", item);
            let id = Object.keys(item).find(
              (key) => key.startsWith("id") && !key.endsWith("_id")
            );
            if (tabela_principal === "funcionario" && campo.includes("usuario")) {
              id = "idusuario";
            }

            console.log("ID da tabela:", id);
            if (item[id] == ideditar) {
              selecionado = true;
            } else {
              selecionado = false;
            }
            console.log("Adicionando opção:", {
              item,
              value: item[id], // ID do item
              text: item[nome_campo], // Texto do campo (ex: 'nome', 'descricao', etc.)
              selected: selecionado,
            });
            select.append(
              $("<option>", {
                value: item[id], // ID do item
                text: item[nome_campo], // Texto do campo (ex: 'nome', 'descricao', etc.)
                selected: selecionado,
              })
            );
          });
        }
      },
      error: function () {
        alert("Erro ao carregar as chaves estrangeiras.");
      },
    });
  });
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
function editarRegistro(tabela) {
  let id = "2";
  let dadosFormulario = $("#formGenerico").serializeArray();
  let dadosParaEnviar = {};
  //console.log('Dados para enviar:', dadosParaEnviar);

  dadosFormulario.forEach(function (item) {
    dadosParaEnviar[item.name] = item.value;
  });

  // Adicionar o ID aos dados que serão enviados
  dadosParaEnviar.id = id;
  //console.log('Dados para enviar:', dadosParaEnviar);

  const teste = JSON.stringify(dadosParaEnviar);
  //console.log('Dados JSON:', teste);

  $.ajax({
    url:
      "http://localhost:83/public/api/index.php?entidade=" +
      tabela +
      "&acao=editar",
    method: "POST",
    contentType: "application/json",
    data: JSON.stringify(dadosParaEnviar), // Enviar os dados do formulário
    success: function (data) {
      if (data.sucesso) {
        alert("Registro editado com sucesso!" + (data.mensagem || "Erro desconhecido"));
        // Redirecionar ou atualizar a página conforme necessário
      } else {
        alert("Erro ao editar: " + (data.mensagem || "Erro desconhecido"));
      }
    },
    error: function (xhr, status, error) {
      // console.error('Erro na requisição:', error);
      // alert('Erro na comunicação com o servidor');
      console.error(error);
    },
  });
}
