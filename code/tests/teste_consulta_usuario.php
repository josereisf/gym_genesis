<?php
require_once '../funcao.php'; // Inclui arquivo de configuração
// Config banco
$host = "localhost";
$user = "root";
$pass = "123";
$dbname = "gym_genesis";

// Cria conexão
$conn = conectar();

// Checa conexão
if ($conn->connect_error) {
    die(json_encode(['error' => 'Erro na conexão: ' . $conn->connect_error]));
}

// Sua query enorme - aqui só exibe 1 campo pra exemplo, substitui pela sua completa depois
$sql = "
SELECT
    u.idusuario,
    u.nome AS nome_usuario,
    u.email,
    u.cpf,
    u.telefone,
    u.numero_matricula,
    u.tipo_usuario,
    e.cep,
    e.rua,
    e.numero,
    e.complemento,
    e.bairro,
    e.cidade,
    e.estado,
    a.idassinatura,
    a.data_inicio,
    a.data_fim,
    p.idplano,
    p.tipo AS tipo_plano,
    p.duracao,
    af.idavaliacao,
    af.peso,
    af.altura,
    af.imc,
    af.percentual_gordura,
    af.data_avaliacao,
    d.iddieta,
    d.descricao AS descricao_dieta,
    d.data_inicio,
    d.data_fim,
    r.idrefeicao,
    r.tipo AS tipo_refeicao,
    r.horario,
    al.idalimento,
    al.nome AS nome_alimento,
    al.calorias,
    al.carboidratos,
    al.proteinas,
    al.gorduras,
    da.quantidade,
    da.observacao,
    t.idtreino,
    t.tipo AS tipo_treino,
    t.horario AS horario_treino,
    t.descricao AS descricao_treino,
    te.idtreino2,
    te.series,
    te.repeticoes,
    te.carga,
    te.intervalo_segundos,
    ex.idexercicio,
    ex.nome AS nome_exercicio,
    ex.grupo_muscular,
    aa.idaula,
    aa.data_aula,
    aa.dia_semana,
    aa.hora_inicio,
    aa.hora_fim,
    ht.idhistorico,
    ht.data_execucao,
    ht.observacoes,
    mu.idmeta,
    mu.descricao AS descricao_meta,
    mu.data_inicio,
    mu.data_limite,
    mu.status,
    f.idtopico,
    f.titulo,
    f.descricao AS descricao_topico,
    f.data_criacao,
    rf.idresposta,
    rf.mensagem,
    rf.data_resposta,
    pd.idpedido,
    pd.data_pedido,
    pd.status AS status_pedido,
    ip.quantidade AS quantidade_produto,
    ip.preco_unitario,
    pr.idproduto,
    pr.nome AS nome_produto,
    pr.descricao AS descricao_produto,
    pr.preco,
    pg.idpagamento,
    pg.valor,
    pg.data_pagamento,
    pg.metodo,
    pg.status AS status_pagamento,
    pd2.tipo AS tipo_pagamento,
    pd2.bandeira_cartao,
    pd2.ultimos_digitos,
    pa.idprofessor_aluno,
    prof.nome AS nome_professor,
    rs.idrecuperacao_senha,
    rs.codigo,
    rs.tempo_expiracao
FROM
    gym_genesis.usuario u
    LEFT JOIN gym_genesis.endereco e ON u.idusuario = e.usuario_id
    LEFT JOIN gym_genesis.assinatura a ON u.idusuario = a.usuario_idusuario
    LEFT JOIN gym_genesis.plano p ON a.plano_idplano = p.idplano
    LEFT JOIN gym_genesis.avaliacao_fisica af ON u.idusuario = af.usuario_idusuario
    LEFT JOIN gym_genesis.dieta d ON u.idusuario = d.usuario_idusuario
    LEFT JOIN gym_genesis.refeicao r ON d.iddieta = r.dieta_id
    LEFT JOIN gym_genesis.dieta_alimentar da ON r.idrefeicao = da.refeicao_idrefeicao
    LEFT JOIN gym_genesis.alimento al ON da.alimento_idalimento = al.idalimento
    LEFT JOIN gym_genesis.treino t ON u.idusuario = t.usuario_idusuario
    LEFT JOIN gym_genesis.treino_exercicio te ON t.idtreino = te.treino_id
    LEFT JOIN gym_genesis.exercicio ex ON te.exercicio_id = ex.idexercicio
    LEFT JOIN gym_genesis.aula_agendada aa ON u.idusuario = aa.usuario_idusuario
    LEFT JOIN gym_genesis.historico_treino ht ON u.idusuario = ht.usuario_id
    LEFT JOIN gym_genesis.meta_usuario mu ON u.idusuario = mu.usuario_id
    LEFT JOIN gym_genesis.forum f ON u.idusuario = f.usuario_idusuario
    LEFT JOIN gym_genesis.resposta_forum rf ON u.idusuario = rf.usuario_idusuario
    LEFT JOIN gym_genesis.pedido pd ON u.idusuario = pd.usuario_idusuario
    LEFT JOIN gym_genesis.item_pedido ip ON pd.idpedido = ip.pedido_idpedido
    LEFT JOIN gym_genesis.produto pr ON ip.produto_idproduto = pr.idproduto
    LEFT JOIN gym_genesis.pagamento pg ON pd.pagamento_idpagamento = pg.idpagamento
    LEFT JOIN gym_genesis.pagamento_detalhe pd2 ON pg.idpagamento = pd2.pagamento_idpagamento
    LEFT JOIN gym_genesis.professor_aluno pa ON u.idusuario = pa.idaluno
    LEFT JOIN gym_genesis.usuario prof ON pa.idprofessor = prof.idusuario
    LEFT JOIN gym_genesis.recuperacao_senha rs ON u.idusuario = rs.usuario_idusuario
WHERE
    u.idusuario = 1;
";

// Executa a query
$result = $conn->query($sql);

if (!$result) {
    die(json_encode(['error' => 'Erro na query: ' . $conn->error]));
}

// Cria array pra armazenar resultados
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Fecha conexão
$conn->close();

// Retorna JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
