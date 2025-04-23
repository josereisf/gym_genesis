let carrinho = [];
let total = 0;

function adicionarAoCarrinho(nome, preco) {
  carrinho.push({ nome, preco });

  const carrinhoLista = document.getElementById('carrinho');
  const novoItem = document.createElement('li');
  novoItem.textContent = `${nome} - R$ ${preco.toFixed(2)}`;
  carrinhoLista.appendChild(novoItem);

  total += preco;
  document.getElementById('total').textContent = `Total: R$ ${total.toFixed(2)}`;
}
