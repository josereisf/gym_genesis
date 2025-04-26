function carregarItensPedido() {
  fetch("./listar_item_pedido.php")
    .then((response) => response.json())
    .then((itens) => {
      const tbody = document.querySelector("#tabela-item-pedido tbody");
      tbody.innerHTML = ""; // Sempre limpar antes de adicionar os novos

      itens.forEach((item) => {
        const tr = document.createElement("tr");
        tr.setAttribute("data-pedido-id", item.pedido_idpedido);
        tr.setAttribute("data-produto-id", item.produto_idproduto);

        tr.innerHTML = `
          <td>${item.pedido_idpedido}</td>
          <td>${item.nome_cliente}</td>
          <td>${item.nome_produto}</td>
          <td class="editable" data-campo="quantidade">${item.quantidade}</td>
          <td class="editable" data-campo="preco_unitario">${parseFloat(item.preco_unitario).toFixed(2)}</td>
        `;

        tbody.appendChild(tr);
      });
    })
    .catch((error) => console.error("Erro ao carregar itens:", error));
}

// Carregar os itens ao inicializar a página
carregarItensPedido();

// Função para permitir a edição na célula da tabela
document
  .getElementById("tabela-item-pedido")
  .addEventListener("dblclick", function (e) {
    if (e.target.classList.contains("editable")) {
      const valorOriginal = e.target.textContent.trim();
      const novoValor = prompt("Novo valor:", valorOriginal);

      if (novoValor !== null && novoValor !== valorOriginal) {
        const linha = e.target.closest("tr");
        const pedidoId = linha.getAttribute("data-pedido-id");
        const produtoId = linha.getAttribute("data-produto-id");

        let campo;
        if (e.target.cellIndex === 2) {
          campo = "quantidade";
        } else if (e.target.cellIndex === 3) {
          campo = "preco_unitario";
        } else {
          // Clicou em algo que não é editável
          return;
        }

        // Envia a atualização para o servidor via POST
        fetch("./editar_item_pedido.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            pedido_idpedido: pedidoId,
            produto_idproduto: produtoId,
            campo: campo,
            novo_valor: novoValor,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              e.target.textContent = novoValor;
            } else {
              alert("Erro ao atualizar: " + data.message);
            }
          })
          .catch((error) => {
            console.error("Erro na requisição:", error);
          });
      }
    }
  });

// Função para carregar os itens ao inicializar a página
carregarItensPedido();
