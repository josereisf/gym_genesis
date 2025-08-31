<?php

require_once __DIR__ . '/../funcao.php';

// ID do detalhe que será editado (PK da tabela pagamento_detalhe)
$idPagamentoDetalhe = 1;

// FK para pagamento
$pagamento_id = 1;

// Dados de teste
$tipo = 'pix';
$bandeira_cartao = 'Visa';
$ultimos_digitos = '1234';
$codigo_pix = 'abcd-efgh';
$linha_digitavel_boleto = '00000.00000.00000.00000';

// Chamando a função
$resposta = editarPagamentoDetalhe(
    $idPagamentoDetalhe,
    $pagamento_id,
    $tipo,
    $bandeira_cartao,
    $ultimos_digitos,
    $codigo_pix,
    $linha_digitavel_boleto
);

if ($resposta) {
    echo "✅ Edição realizada com sucesso!";
} else {
    echo "❌ Erro ao editar pagamento.";
}
