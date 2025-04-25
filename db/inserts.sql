-- Inserts para o schema `gym_genesis`
-- 3 registros por tabela, respeitando ordem de dependências
use gym_genesis;
-- 1. Tabelas independentes


-- 1.2. cargo
INSERT INTO `gym_genesis`.`cargo` 
(`nome`, `descricao`) 
VALUES
  ('Gerente', 'Responsável pela supervisão geral da equipe'),
  ('Assistente', 'Apoio nas atividades administrativas'),
  ('Vendedor', 'Responsável pelas vendas e atendimento ao cliente');


-- 1.3. categoria_produto
INSERT INTO categoria_produto (nome, descricao) VALUES
  ('Suplementos', 'Produtos nutricionais'),
  ('Roupas', 'Vestuário esportivo'),
  ('Acessórios', 'Equipamentos e acessórios');

-- 1.4. produto
INSERT INTO produto (nome, descricao, preco, quantidade_estoque, imagem) VALUES
  ('Whey Protein', 'Proteína concentrada', 150.00, 50, NULL),
  ('Camiseta Dry Fit', 'Tecido respirável', 80.00, 200, NULL),
  ('Garrafa Squeeze', 'Capacidade 700ml', 30.00, 100, NULL);

-- 1.5. exercicio
INSERT INTO exercicio (nome, grupo_muscular, descricao, video_url) VALUES
  ('Supino', 'Peitoral', 'Exercício de supino reto', NULL),
  ('Agachamento', 'Pernas', 'Agachamento livre', NULL),
  ('Puxada na barra', 'Costas', 'Puxada frontal', NULL);

-- 1.6. alimento
INSERT INTO alimento (nome, calorias, carboidratos, proteinas, gorduras, porcao, categoria) VALUES
  ('Banana', 89.00, 23.00, 1.10, 0.30, '100g', 'Fruta'),
  ('Peito de Frango', 165.00, 0.00, 31.00, 3.60, '100g', 'Proteína'),
  ('Arroz Integral', 111.00, 23.00, 2.60, 0.90, '100g', 'Carboidrato');

-- 2. Usuario e tabelas dependentes diretas

-- 2.1. usuario
INSERT INTO usuario (nome, senha, email, cpf, data_de_nascimento, telefone, foto_de_perfil, numero_matricula, tipo_usuario) VALUES
  ('Ana Silva',     'senha1', 'ana@ex.com',  '12345678901', '1990-05-10', '11999990000', NULL, 'MAT1001', 1),
  ('Bruno Costa',   'senha2', 'bruno@ex.com','98765432100', '1985-07-22', '11988881111', NULL, 'MAT1002', 2),
  ('Carla Pereira', 'senha3', 'carla@ex.com','56473829100', '1992-12-01', '11977772222', NULL, 'MAT1003', 1);

-- 2.2. cupom_desconto
INSERT INTO cupom_desconto (codigo, percentual_desconto, valor_desconto, data_validade, quantidade_uso, tipo) VALUES
  ('PROMO10', 10.00, NULL, '2025-12-31', 100, 'percentual'),
  ('FIXO20', NULL, 20.00, '2025-06-30', 50, 'fixo'),
  ('PROMO5', 5.00, NULL, '2025-09-30', 200, 'percentual');

-- 3. Funcionário e endereço

-- 3.1. funcionario
INSERT INTO funcionario (nome, email, telefone, data_contratacao, salario, cargo_id) VALUES
  ('Eduardo Lima', 'eduardo@ex.com', '11333334444', '2024-01-15', 3000.00, 1),
  ('Mariana Souza','mariana@ex.com','11444445555', '2023-08-01', 4500.00, 2),
  ('Paulo Rocha',  'paulo@ex.com',  '11555556666', '2025-02-10', 2500.00, 3);

-- 3.2. endereco
INSERT INTO endereco (usuario_id, funcionario_id, cep, rua, numero, complemento, bairro, cidade, estado) VALUES
  (1, NULL, '01001000', 'Rua A', '100', NULL, 'Centro', 'São Paulo', 'SP'),
  (2, NULL, '02002000', 'Av. B',  '200', 'Apto 10', 'Jardim', 'São Paulo', 'SP'),
  (NULL, 1, '03003000', 'Rua C', '300', NULL, 'Vila', 'São Paulo', 'SP');

-- 4. Assinatura e plano

-- 4.2. plano
INSERT INTO `gym_genesis`.`plano` 
(`tipo`, `duracao`)
VALUES
('Mensal', '30 dias'),
('Trimestral', '90 dias'),
('Anual', '365 dias');
-- 4.1. assinatura
INSERT INTO `gym_genesis`.`assinatura` 
(`data_inicio`, `data_fim`, `usuario_idusuario`, `plano_idplano`)
VALUES
('2025-04-01', '2025-07-01', 1, 1),
('2025-03-15', '2025-06-15', 2, 2),
('2025-04-10', '2025-07-10', 3, 3);


-- 5. Dieta, refeição e dieta_alimento

-- 5.1. dieta
INSERT INTO `gym_genesis`.`dieta` 
(`descricao`, `data_inicio`, `data_fim`, `usuario_idusuario`) 
VALUES
  ('Dieta de ganho de massa', '2025-01-01', '2025-03-01', 1),
  ('Dieta de definição', '2025-02-15', NULL, 2),
  ('Dieta equilibrada', '2025-03-01', NULL, 3);


-- 5.2. refeicao
INSERT INTO `gym_genesis`.`refeicao` 
(`dieta_id`, `tipo`, `horario`) 
VALUES
  (1, 'Café da manhã', '07:00:00'),
  (2, 'Almoço', '12:00:00'),
  (3, 'Jantar', '19:00:00');


-- 5.3. dieta_alimento
INSERT INTO `gym_genesis`.`dieta_alimentar` 
(`alimento_idalimento`, `refeicao_idrefeicao`, `quantidade`, `observacoes`)
VALUES
(1, 1, '200g', 'Proteína para o café da manhã'),
(2, 2, '150g', 'Carboidrato para o almoço'),
(3, 3, '100g', 'Fibras para o jantar');


-- 6. Treino, treino_exercicio e historico_treino

-- 6.1. treino
INSERT INTO treino (tipo, horario, descricao, usuario_idusuario) VALUES
  ('Força', '08:00:00', 'Treino de força peitoral', 1),
  ('Cardio','18:00:00', 'Corrida na esteira',      2),
  ('Resistência','10:00:00', 'Circuito full body',   3);

-- 6.2. treino_exercicio
INSERT INTO treino_exercicio (treino_id, exercicio_id, series, repeticoes, carga, intervalo_segundos) VALUES
  (1, 1, 4, 10, 60.00, 60),
  (2, 3, 3, 15, NULL, 30),
  (3, 2, 5, 12, 80.00, 90);

-- 6.3. historico_treino
INSERT INTO historico_treino (usuario_id, treino_id, data_execucao, observacoes) VALUES
  (1, 1, '2025-04-10 08:00:00', 'Sem observações'),
  (2, 2, '2025-04-11 18:00:00', 'Melhor tempo'),
  (3, 3, '2025-04-12 10:00:00', 'Fadiga alta');

-- 7. Forum, resposta_forum

-- 7.1. forum
INSERT INTO forum (titulo, descricao, data_criacao, usuario_idusuario) VALUES
  ('Dúvida Treino Peitoral', 'Como evoluir no supino?', '2025-04-01 09:00:00', 1),
  ('Nutrição Pós-Treino',    'O que comer após o treino?', '2025-04-02 12:00:00', 2),
  ('Equipamentos',           'Qual melhor barra?', '2025-04-03 15:00:00', 3);

-- 7.2. resposta_forum
INSERT INTO resposta_forum (mensagem, data_resposta, usuario_idusuario, forum_idtopico) VALUES
  ('Tente aumentar 2kg por semana.', '2025-04-01 10:00:00', 2, 1),
  ('Carboidrato e proteína juntos.', '2025-04-02 13:00:00', 3, 2),
  ('Barra olímpica convencional.',  '2025-04-03 16:00:00', 1, 3);

-- 8. Pedido, item_pedido
INSERT INTO `gym_genesis`.`pagamento` 
(`valor`, `data_pagamento`, `metodo`, `status`)
VALUES
  (150.00, '2025-04-20 10:00:00', 'cartao', 'sucesso'),
  (200.00, '2025-04-21 11:30:00', 'pix', 'sucesso'),
  (50.00, '2025-04-22 14:00:00', 'boleto', 'falha');


-- 9.2. pagamento_detalhe
INSERT INTO `gym_genesis`.`pagamento_detalhe` 
(`tipo`, `bandeira_cartao`, `ultimos_digitos`, `codigo_pix`, `linha_digitavel_boleto`, `pagamento_idpagamento`)
VALUES
  ('cartao', 'Visa', '1234', NULL, NULL, 1),
  ('pix', NULL, NULL, 'pix-codigo-xyz987', NULL, 2),
  ('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000005000', 3);
  
-- 8.1. pedido
INSERT INTO `gym_genesis`.`pedido` 
(`usuario_idusuario`, `data_pedido`, `status`, `pagamento_idpagamento`)
VALUES
  (1, '2025-04-15 14:00:00', 'processando', 1),
  (2, '2025-04-16 10:30:00', 'enviado', 2),
  (3, '2025-04-17 18:45:00', 'concluído', 3);


-- 8.2. item_pedido
INSERT INTO `gym_genesis`.`item_pedido` 
(`pedido_idpedido`, `produto_idproduto`, `quantidade`, `preco_unitario`)
VALUES
  (1, 1, 2, 50.00),  -- Produto 1, 2 unidades, preço unitário 50
  (2, 3, 1, 100.00), -- Produto 3, 1 unidade, preço unitário 100
  (3, 2, 4, 25.00);  -- Produto 2, 4 unidades, preço unitário 25


-- 9. Pagamento e pagamento_detalhe

-- 9.1. pagamento



-- Inserindo registros na tabela pagamento_assinatura
INSERT INTO `gym_genesis`.`pagamento_assinatura` 
(`valor`, `data_pagamento`, `metodo`, `status`, `assinatura_idassinatura`)
VALUES
(99.90, NOW(), 'cartao', 'sucesso', 1),
(79.90, NOW(), 'pix', 'sucesso', 2),
(59.90, NOW(), 'boleto', 'falha', 3);

-- Inserindo registros na tabela pagamento_detalhe_assinatura
-- Supondo que os IDs gerados automaticamente para os pagamentos acima foram 1, 2 e 3
INSERT INTO `gym_genesis`.`pagamento_detalhe_assinatura`
(`tipo`, `bandeira_cartao`, `ultimos_digitos`, `codigo_pix`, `linha_digitavel_boleto`, `pagamento_idpagamento`)
VALUES
('cartao', 'Visa', '1234', NULL, NULL, 1),
('pix', NULL, NULL, 'pix-codigo-abc123', NULL, 2),
('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000005990', 3);

-- 10. Avaliacao fisica e Aula agendada

-- 10.1. avaliacao_fisica
INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_idusuario) VALUES
  (70.500, 1.75, 23.02, 15.00, '2025-04-01', 1),
  (85.000, 1.80, 26.23, 20.00, '2025-04-02', 2),
  (60.300, 1.65, 22.04, 18.00, '2025-04-03', 3);

-- 10.2. aula_agendada
INSERT INTO `gym_genesis`.`aula_agendada` 
(`data_aula`, `dia_semana`, `hora_inicio`, `hora_fim`, `usuario_idusuario`) 
VALUES 
('2025-04-25', 'Sexta', '08:00:00', '09:00:00', 1);

INSERT INTO `gym_genesis`.`aula_agendada` 
(`data_aula`, `dia_semana`, `hora_inicio`, `hora_fim`, `usuario_idusuario`) 
VALUES 
('2025-04-27', 'Domingo', '10:00:00', '11:30:00', 2);

INSERT INTO `gym_genesis`.`aula_agendada` 
(`data_aula`, `dia_semana`, `hora_inicio`, `hora_fim`, `usuario_idusuario`) 
VALUES 
('2025-04-29', 'Terça', '17:00:00', '18:00:00', 3);

-- 11. Meta usuario
INSERT INTO meta_usuario (usuario_id, descricao, data_inicio, data_limite, status) VALUES
  (1, 'Perder 5kg em 3 meses', '2025-04-01', '2025-07-01', 'ativa'),
  (2, 'Correr 5km em 30min',   '2025-04-01', '2025-06-01', 'ativa'),
  (3, 'Aumentar força no supino','2025-04-01','2025-07-01', 'ativa');


INSERT INTO `gym_genesis`.`recuperacao_senha` 
(`codigo`, `usuario_idusuario`)
VALUES
('ABC123XYZ', 1),
('RESET456DEF', 2),
('TOKEN789GHI', 3);

