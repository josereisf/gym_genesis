$(document).ready(function () {
  let tabela = $('#dados').data('tabela');
  let id = $('#dados').data('id');

  console.log("Tabela:", tabela);
  console.log("ID:", id);

  listarTabela(tabela, id);
});

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

        if (Array.isArray(dados)) {
          const selectGenerico = $('#select_generico');
          selectGenerico.empty();

          dados.forEach(item => {
            const chaves = Object.keys(item);

            // Identifica a chave que contém '_id' (cargo_id, usuario_id, dieta_id, etc.)
            const chaveId = chaves.find(k => k.includes('_id'));

            if (chaveId) {
              let chaveNome;

              // Verifica a chaveId e mapeia para o nome correspondente
              if (chaveId.includes('cargo')) {
                chaveNome = 'nome_cargo';   // Se for cargo_id, usa nome_cargo
              } else if (chaveId.includes('usuario')) {
                chaveNome = 'nome_usuario'; // Se for usuario_id, usa nome_usuario
              } else if (chaveId.includes('dieta')) {
                chaveNome = 'descricao';    // Se for dieta_id, usa descricao
              } else if (chaveId.includes('treino')) {
                chaveNome = 'tipo';         // Se for treino_id, usa tipo
              } else if (chaveId.includes('alimento')) {
                chaveNome = 'nome';         // Se for alimento_id, usa nome
              }

              // Verifica se chaveNome existe no item antes de adicionar a opção
              if (chaveNome && item.hasOwnProperty(chaveNome)) {
                selectGenerico.append(
                  $('<option></option>')
                    .val(item[chaveId])      // valor da opção é o _id
                    .text(item[chaveNome])    // texto da opção é o nome correspondente
                );
              } else {
                console.log(`Erro: ChaveNome (${chaveNome}) não encontrada para o item com chaveId ${chaveId}`);
              }
            } else {
              console.log('Erro: Dados não estão no formato esperado. Falta chave com _id');
            }
          });
        } else {
          console.error('Erro: Dados retornados não são um array.');
        }
      } else {
        console.error('Erro: Dados de sucesso não retornados.');
      }
    },
    error: function (xhr, status, error) {
      console.error('Erro na requisição:', status, error);
    }
  })
}
