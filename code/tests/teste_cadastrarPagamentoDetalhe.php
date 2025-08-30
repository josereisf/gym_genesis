<?php

require_once __DIR__ . '/../funcao.php';


$pagamento_id = 1; // ID do pagamento
$tipo = "cartao"; // Tipo de pagamento
$bandeira_cartao = "Visa"; // Bandeira do cartão
$ultimos_digitos = "1234"; // Últimos dígitos do cartão
$codigo_pix = "null"; // Código Pix
$linha_digitavel_boleto = "null"; // Linha digitável do boleto

$resposta = cadastrarPagamentoDetalhe($pagamento_id, $tipo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto);

echo '<pre>';
print_r($resposta);
echo '</pre>';