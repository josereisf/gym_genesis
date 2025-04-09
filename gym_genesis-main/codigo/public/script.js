const tabelas = [
    "alimento", "assinatura", "aula_agendada", "avaliacao_fisica", "avaliador", "cargo",
    "categoria_produto", "cupom_desconto", "dieta", "dieta_alimento", "endereco",
    "endereco_entrega", "exercicio", "forum", "funcionario", "historico_treino", "horario",
    "item_pedido", "meta_usuario", "pagamento", "pagamento_detalhe", "pedido", "plano",
    "produto", "refeicao", "resposta_forum", "treino", "treino_exercicio", "usuario"
  ];
  
  const select = document.getElementById("selectTabelas");
  const resultado = document.getElementById("resultado");
  
  // Preenche o select com as tabelas
  tabelas.forEach(tabela => {
    const option = document.createElement("option");
    option.value = tabela;
    option.textContent = tabela;
    select.appendChild(option);
  });
  
  // Ao selecionar uma tabela, faz a requisição
  select.addEventListener("change", async () => {
    const tabela = select.value;
  
    if (!tabela) {
      resultado.innerHTML = "";
      return;
    }
  
    try {
      // Atualizado para usar query string, compatível com seu backend
      const res = await fetch(`/tabela?nome=${tabela}`);
      const dados = await res.json();
  
      if (!Array.isArray(dados) || dados.length === 0) {
        resultado.innerHTML = "<p>Nenhum dado encontrado.</p>";
        return;
      }
  
      const colunas = Object.keys(dados[0]);
      let html = "<table border='1'><thead><tr>";
  
      colunas.forEach(coluna => {
        html += `<th>${coluna}</th>`;
      });
  
      html += "</tr></thead><tbody>";
  
      dados.forEach(linha => {
        html += "<tr>";
        colunas.forEach(coluna => {
          html += `<td>${linha[coluna]}</td>`;
        });
        html += "</tr>";
      });
  
      html += "</tbody></table>";
  
      resultado.innerHTML = html;
  
    } catch (err) {
      resultado.innerHTML = `<p>Erro ao buscar os dados: ${err.message}</p>`;
    }
  });
  