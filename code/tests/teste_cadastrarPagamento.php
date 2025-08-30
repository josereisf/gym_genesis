<?php

require_once __DIR__ . '/../funcao.php';

$id_usuario = 1; // ID do usuário que está fazendo o pagamento
$valor = 100.00; // Valor do pagamento
$data_pagamento = "2023-03-15"; // Data do pagamento
$status = "pendente"; // Status do pagamento

$resposta = cadastrarPagamento($id_usuario, $valor, $data_pagamento, $status);

echo '<pre>';
print_r($resposta);
echo '</pre>';
