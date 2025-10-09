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

            // --- PREENCHER SELECT DE CARGO ---
            const selectCargo = $('#select_cargo_id');
            selectCargo.empty();
            dados.forEach(item => {
              // 'idperfil' é o id do cargo e 'nome_cargo' é o nome
              if (item.idperfil && item.nome_cargo) {
                selectCargo.append(
                  $('<option></option>').val(item.idperfil).text(item.nome_cargo)
                );
              }
            });

            // --- PREENCHER SELECT DE USUÁRIO ---
            const selectUsuario = $('#select_usuario_id');
            selectUsuario.empty();
            dados.forEach(item => {
              // 'usuario_id' e 'nome' (ou outro campo se houver)
              if (item.usuario_id && item.nome) {
                selectUsuario.append(
                  $('<option></option>').val(item.usuario_id).text(item.nome)
                );
              }
            });

          } else {
            console.log('Erro: Dados não estão no formato esperado.');
          }
        } else {
          console.log('Erro: Dados não encontrados');
        }
      },
      error: function (error) {
        console.error('Erro ao buscar dados:', error);
      }
    });
  }
