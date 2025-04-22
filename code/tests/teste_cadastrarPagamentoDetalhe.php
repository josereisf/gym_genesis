<?php
// Incluindo o arquivo com a função que será testada
require_once '../funcao.php';

// Teste 1: Pagamento com Cartão
$pagamento_idpagamento = 1; // Substitua por um ID válido existente no banco
$tipo = 'cartao';
$bandeira_cartao = 'Visa';
$ultimos_digitos = '1234';
$codigo_pix = null;
$linha_digitavel_boleto = null;

$funcionou = cadastrarPagamentoDetalhe(
    $pagamento_idpagamento,
    $tipo,
    $bandeira_cartao,
    $ultimos_digitos,
    $codigo_pix,
    $linha_digitavel_boleto
);

echo $funcionou ? "Cartão: Pagamento detalhado cadastrado com sucesso!\n" : "Cartão: Falha ao cadastrar pagamento detalhado.\n";

// Teste 2: Pagamento com Pix
$tipo = 'pix';
$bandeira_cartao = null;
$ultimos_digitos = null;
$codigo_pix = '1234567890abcdef';
$linha_digitavel_boleto = null;

$funcionou = cadastrarPagamentoDetalhe(
    $pagamento_idpagamento,
    $tipo,
    $bandeira_cartao,
    $ultimos_digitos,
    $codigo_pix,
    $linha_digitavel_boleto
);

echo $funcionou ? "<br>Pix: Pagamento detalhado cadastrado com sucesso!\n" : "Pix: Falha ao cadastrar pagamento detalhado.\n";

// Teste 3: Pagamento com Boleto
$tipo = 'boleto';
$bandeira_cartao = null;
$ultimos_digitos = null;
$codigo_pix = null;
$linha_digitavel_boleto = '34191.79001 01043.510047 91020.150008 8 80770000002000';

$funcionou = cadastrarPagamentoDetalhe(
    $pagamento_idpagamento,
    $tipo,
    $bandeira_cartao,
    $ultimos_digitos,
    $codigo_pix,
    $linha_digitavel_boleto
);

echo $funcionou ? "<br>Boleto: Pagamento detalhado cadastrado com sucesso!\n" : "Boleto: Falha ao cadastrar pagamento detalhado.\n";
?>
