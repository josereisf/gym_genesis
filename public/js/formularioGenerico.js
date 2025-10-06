async function listarTabela(tabela, id) {
  try {
    const response = await fetch(
      'http://localhost:83/public/api/index.php?entidade=' + tabela + '&acao=listar',
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id }) // Envia o ID como JSON
      }
    );

    const data = await response.json();

    if (data.sucesso) {
      const dados = data.dados;

      // Preenche todos os inputs com base nos dados retornados
      for (const campo in dados) {
        if (dados.hasOwnProperty(campo)) {
          // Se o input existir com o nome correspondente
          const input = document.getElementById(campo);
          if (input) {
            input.value = dados[campo];  // Preenche o valor do input
          }
        }
      }
    } else {
      console.log('Erro: Dados não encontrados');
    }
  } catch (error) {
    console.error('Erro ao buscar dados:', error);
  }
}
