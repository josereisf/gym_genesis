<?php

require_once __DIR__ . '/../funcao.php';

$id = 1;

if (!empty(deletarPagamentoDetalhe($id))) {
    echo "Detalhe de pagamento deletado com sucesso.";
} else {
    echo "Falha ao deletar o detalhe de pagamento.";
}
    