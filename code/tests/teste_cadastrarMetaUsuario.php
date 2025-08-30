<?php

require_once __DIR__ . '/../funcao.php';

$id_usuario = 1; // Exemplo de ID de usuário
$meta = "Atingir 10 vendas no mês"; // Exemplo de meta
$descricao = "Meta de vendas para o mês de março"; // Exemplo de descrição
$data_inicio = "2023-03-01"; // Exemplo de data de início
$data_limite = "2023-03-31"; // Exemplo de data limite
$status = "ativa"; // Exemplo de status

$resposta = cadastrarMetaUsuario($id_usuario, $descricao, $data_inicio, $data_limite, $status);

// Exibe a resposta
var_dump($resposta);