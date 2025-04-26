<?php
require_once '../../code/funcao.php';

$conexao = conectar();

$sql = "
SELECT 
  ip.pedido_idpedido,
  ip.produto_idproduto,
  p.nome AS nome_produto,
  u.nome AS nome_cliente,
  ip.quantidade,
  ip.preco_unitario
FROM item_pedido ip
INNER JOIN produto p ON ip.produto_idproduto = p.idproduto
INNER JOIN pedido ped ON ip.pedido_idpedido = ped.idpedido
INNER JOIN usuario u ON ped.usuario_idusuario = u.idusuario
";

$resultado = mysqli_query($conexao, $sql);

$itens = [];
while ($item = mysqli_fetch_assoc($resultado)) {
  $itens[] = $item;
}

echo json_encode($itens);
?>
