INSERT INTO usuario (nome, email, senha, data_nascimento, genero) VALUES
('João Silva', 'joao1@example.com', 'senha1', '1990-01-01', 'M'),
('Maria Souza', 'maria2@example.com', 'senha2', '1985-05-12', 'F'),
('Carlos Lima', 'carlos3@example.com', 'senha3', '1992-07-23', 'M'),
('Ana Paula', 'ana4@example.com', 'senha4', '1995-03-30', 'F'),
('Rafael Costa', 'rafael5@example.com', 'senha5', '1988-08-15', 'M'),
('Juliana Dias', 'juliana6@example.com', 'senha6', '1991-02-20', 'F'),
('Lucas Rocha', 'lucas7@example.com', 'senha7', '1993-11-10', 'M'),
('Fernanda Alves', 'fernanda8@example.com', 'senha8', '1996-06-05', 'F'),
('Gabriel Mendes', 'gabriel9@example.com', 'senha9', '1994-04-18', 'M'),
('Patrícia Ferreira', 'patricia10@example.com', 'senha10', '1989-09-25', 'F');

INSERT INTO funcionario (nome, email, telefone, data_contratacao, salario, cargo_id) VALUES
('Marcos Pinto', 'marcos1@example.com', '1111-1111', '2023-01-15', 2500.00, 1),
('Sandra Meireles', 'sandra2@example.com', '2222-2222', '2023-02-01', 1800.00, 2),
('Bruno Oliveira', 'bruno3@example.com', '3333-3333', '2023-03-10', 3500.00, 3),
('Renata Cruz', 'renata4@example.com', '4444-4444', '2023-04-20', 3000.00, 4),
('Tiago Farias', 'tiago5@example.com', '5555-5555', '2023-05-05', 1600.00, 5),
('Viviane Lopes', 'viviane6@example.com', '6666-6666', '2023-06-12', 4000.00, 6),
('André Matos', 'andre7@example.com', '7777-7777', '2023-07-03', 1200.00, 7),
('Cláudia Reis', 'claudia8@example.com', '8888-8888', '2023-08-18', 2800.00, 8),
('Eduardo Borges', 'eduardo9@example.com', '9999-9999', '2023-09-09', 2000.00, 9),
('Tatiane Silva', 'tatiane10@example.com', '1010-1010', '2023-10-21', 2300.00, 10);

INSERT INTO endereco (usuario_id, cep, rua, numero, complemento, bairro, cidade, estado) VALUES
(1, '12345-678', 'Rua A', '100', 'Ap 1', 'Centro', 'São Paulo', 'SP'),
(2, '23456-789', 'Rua B', '200', '', 'Bela Vista', 'Rio de Janeiro', 'RJ'),
(3, '34567-890', 'Rua C', '300', 'Casa', 'Jardins', 'Belo Horizonte', 'MG'),
(4, '45678-901', 'Rua D', '400', '', 'Copacabana', 'Curitiba', 'PR'),
(5, '56789-012', 'Rua E', '500', 'Ap 12', 'Savassi', 'Fortaleza', 'CE');

INSERT INTO endereco (funcionario_id, cep, rua, numero, complemento, bairro, cidade, estado) VALUES
(1, '67890-123', 'Rua F', '600', '', 'Boa Vista', 'Recife', 'PE'),
(2, '78901-234', 'Rua G', '700', '', 'Imbiribeira', 'Salvador', 'BA'),
(3, '89012-345', 'Rua H', '800', '', 'Centro', 'Porto Alegre', 'RS'),
(4, '90123-456', 'Rua I', '900', '', 'Praia Grande', 'Florianópolis', 'SC'),
(5, '01234-567', 'Rua J', '1000', 'Casa', 'Estreito', 'Manaus', 'AM');

-- Inserts para cargo
INSERT INTO cargo (nome, descricao) VALUES
('Instrutor', 'Responsável por orientar os alunos'),
('Recepcionista', 'Atende alunos e visitantes'),
('Nutricionista', 'Elabora dietas personalizadas'),
('Personal Trainer', 'Treinos individuais'),
('Faxineiro', 'Limpeza da academia'),
('Gerente', 'Administração geral'),
('Estagiário', 'Apoio nas tarefas'),
('TI', 'Manutenção de sistemas'),
('Segurança', 'Segurança do local'),
('Vendas', 'Responsável pelas vendas');

-- Inserts para avaliacao_fisica
INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_idusuario) VALUES
(70.5, 1.75, 23.0, 15.2, '2024-03-01', 1),
(85.2, 1.80, 26.3, 18.7, '2024-03-02', 2),
(60.0, 1.60, 23.4, 22.1, '2024-03-03', 3),
(95.0, 1.90, 26.3, 20.3, '2024-03-04', 4),
(65.3, 1.70, 22.6, 19.0, '2024-03-05', 5),
(78.5, 1.78, 24.8, 17.5, '2024-03-06', 6),
(90.2, 1.85, 26.3, 21.1, '2024-03-07', 7),
(72.0, 1.72, 24.3, 18.8, '2024-03-08', 8),
(68.4, 1.69, 23.9, 17.0, '2024-03-09', 9),
(80.0, 1.75, 26.1, 19.4, '2024-03-10', 10);

-- Inserts para assinatura
INSERT INTO assinatura (tipo, data_inicio, data_fim, valor, usuario_idusuario) VALUES
('Mensal', '2024-03-01', '2024-03-31', 99.90, 1),
('Mensal', '2024-03-02', '2024-04-01', 99.90, 2),
('Trimestral', '2024-03-03', '2024-06-03', 279.90, 3),
('Mensal', '2024-03-04', '2024-04-03', 99.90, 4),
('Anual', '2024-03-05', '2025-03-05', 999.90, 5),
('Mensal', '2024-03-06', '2024-04-06', 99.90, 6),
('Trimestral', '2024-03-07', '2024-06-07', 279.90, 7),
('Mensal', '2024-03-08', '2024-04-08', 99.90, 8),
('Anual', '2024-03-09', '2025-03-09', 999.90, 9),
('Mensal', '2024-03-10', '2024-04-10', 99.90, 10);

-- Inserts para produto
INSERT INTO produto (nome, descricao, preco, estoque) VALUES
('Whey Protein', 'Suplemento proteico', 150.00, 50),
('Creatina', 'Suplemento de creatina', 90.00, 40),
('BCAA', 'Aminoácidos essenciais', 80.00, 30),
('Pré-treino', 'Suplemento energético', 120.00, 20),
('Glutamina', 'Ajuda na recuperação muscular', 70.00, 25),
('Barrinha Proteica', 'Snack saudável', 10.00, 100),
('Camiseta Dry Fit', 'Roupas esportivas', 50.00, 60),
('Garrafa', 'Garrafa para treino', 30.00, 75),
('Luvas', 'Luvas para musculação', 45.00, 35),
('Corda de Pular', 'Equipamento para cardio', 25.00, 40);

-- Inserts para treino
INSERT INTO treino (nome, descricao, usuario_idusuario) VALUES
('Treino A', 'Pernas e glúteos', 1),
('Treino B', 'Peito e tríceps', 2),
('Treino C', 'Costas e bíceps', 3),
('Treino D', 'Abdômen e cardio', 4),
('Treino E', 'Corpo inteiro', 5),
('Treino F', 'Treino funcional', 6),
('Treino G', 'Hipertrofia superior', 7),
('Treino H', 'Hipertrofia inferior', 8),
('Treino I', 'Mobilidade e alongamento', 9),
('Treino J', 'Crossfit', 10);

-- Inserts para dieta
INSERT INTO dieta (nome, descricao, usuario_idusuario) VALUES
('Dieta A', 'Baixa caloria', 1),
('Dieta B', 'Alta proteína', 2),
('Dieta C', 'Ganhar massa', 3),
('Dieta D', 'Perder gordura', 4),
('Dieta E', 'Manutenção', 5),
('Dieta F', 'Ciclo de carboidrato', 6),
('Dieta G', 'Vegetariana', 7),
('Dieta H', 'Vegana', 8),
('Dieta I', 'Cetogênica', 9),
('Dieta J', 'Jejum intermitente', 10);

-- Inserts para pedido
INSERT INTO pedido (data_pedido, valor_total, usuario_idusuario) VALUES
('2024-04-01', 200.00, 1),
('2024-04-02', 150.00, 2),
('2024-04-03', 300.00, 3),
('2024-04-04', 250.00, 4),
('2024-04-05', 100.00, 5),
('2024-04-06', 180.00, 6),
('2024-04-07', 220.00, 7),
('2024-04-08', 175.00, 8),
('2024-04-09', 90.00, 9),
('2024-04-10', 320.00, 10);

-- Inserts para item_pedido
INSERT INTO item_pedido (quantidade, preco_unitario, pedido_idpedido, produto_idproduto) VALUES
(2, 150.00, 1, 1),
(1, 90.00, 2, 2),
(3, 80.00, 3, 3),
(1, 120.00, 4, 4),
(2, 70.00, 5, 5),
(5, 10.00, 6, 6),
(2, 50.00, 7, 7),
(3, 30.00, 8, 8),
(1, 45.00, 9, 9),
(4, 25.00, 10, 10);

INSERT INTO meta_usuario (usuario_id, descricao, data_inicio, data_fim, status)
VALUES
(1, 'Perder 5kg em 2 meses', '2025-01-01', '2025-03-01', 'ativa'),
(2, 'Ganhar massa muscular', '2025-02-15', '2025-06-15', 'ativa'),
(3, 'Melhorar resistência cardiovascular', '2025-01-20', '2025-04-20', 'ativa'),
(4, 'Reduzir percentual de gordura', '2025-03-01', '2025-06-01', 'ativa'),
(5, 'Aumentar força', '2025-01-10', '2025-04-10', 'inativa'),
(6, 'Manutenção corporal', '2025-02-01', '2025-05-01', 'ativa'),
(7, 'Preparação para maratona', '2025-03-15', '2025-07-15', 'ativa'),
(8, 'Reabilitação pós-cirurgia', '2025-01-05', '2025-04-05', 'inativa'),
(9, 'Condicionamento físico geral', '2025-02-20', '2025-05-20', 'ativa'),
(10, 'Treino funcional', '2025-03-10', '2025-06-10', 'ativa');

INSERT INTO historico_treino (treino_id, usuario_id, data_execucao, observacoes)
VALUES
(1, 1, '2025-04-01 09:00:00', 'Sentiu cansaço no final'),
(2, 2, '2025-04-01 10:00:00', 'Treino tranquilo'),
(3, 3, '2025-04-02 08:00:00', 'Boa performance'),
(4, 4, '2025-04-02 11:00:00', 'Dores nas costas'),
(5, 5, '2025-04-03 07:30:00', 'Recomenda alongamento'),
(6, 6, '2025-04-03 09:15:00', 'Executou tudo com calma'),
(7, 7, '2025-04-04 08:45:00', 'Faltou energia'),
(8, 8, '2025-04-04 10:00:00', 'Excelente disposição'),
(9, 9, '2025-04-05 09:00:00', 'Pouca resistência'),
(10, 10, '2025-04-05 10:30:00', 'Executou todos os exercícios corretamente');

INSERT INTO treino_exercicio (treino_id, exercicio_id, series, repeticoes, carga, intervalo_segundos)
VALUES
(1, 1, 3, 12, 20.0, 60),
(2, 2, 4, 10, 25.5, 90),
(3, 3, 3, 15, 15.0, 45),
(4, 4, 4, 8, 30.0, 60),
(5, 5, 3, 12, 22.5, 75),
(6, 6, 3, 10, 27.0, 60),
(7, 7, 4, 12, 18.0, 90),
(8, 8, 3, 15, 20.0, 45),
(9, 9, 3, 10, 16.0, 60),
(10, 10, 3, 12, 19.0, 60);

INSERT INTO pagamento (usuario_id, valor, data_pagamento, metodo, status_pagamento)
VALUES
(1, 149.99, '2025-03-01', 'cartao', 'confirmado'),
(2, 199.00, '2025-03-02', 'boleto', 'pendente'),
(3, 129.50, '2025-03-03', 'pix', 'confirmado'),
(4, 179.90, '2025-03-04', 'cartao', 'confirmado'),
(5, 89.99, '2025-03-05', 'pix', 'cancelado'),
(6, 220.00, '2025-03-06', 'boleto', 'confirmado'),
(7, 150.75, '2025-03-07', 'cartao', 'confirmado'),
(8, 199.99, '2025-03-08', 'cartao', 'confirmado'),
(9, 99.00, '2025-03-09', 'pix', 'confirmado'),
(10, 135.00, '2025-03-10', 'boleto', 'pendente');

INSERT INTO pagamento_detalhe (pagamento_id, tipo, bandeira_cartao, ultimos_digitos, codigo_qr_pix, link_download_boleto)
VALUES
(1, 'cartao', 'Visa', '1234', NULL, NULL),
(2, 'boleto', NULL, NULL, NULL, 'https://boleto.exemplo.com/boleto1.pdf'),
(3, 'pix', NULL, NULL, 'PIX1234567890', NULL),
(4, 'cartao', 'Mastercard', '5678', NULL, NULL),
(5, 'pix', NULL, NULL, 'PIX9988776655', NULL),
(6, 'boleto', NULL, NULL, NULL, 'https://boleto.exemplo.com/boleto6.pdf'),
(7, 'cartao', 'Elo', '4321', NULL, NULL),
(8, 'cartao', 'Visa', '8765', NULL, NULL),
(9, 'pix', NULL, NULL, 'PIX5544332211', NULL),
(10, 'boleto', NULL, NULL, NULL, 'https://boleto.exemplo.com/boleto10.pdf');

INSERT INTO resposta_forum (mensagem, data_resposta, forum_idtopico, usuario_idusuario)
VALUES
('Você pode fazer agachamento livre para pernas.', '2025-04-01 10:30:00', 1, 2),
('Aumente a ingestão de proteína.', '2025-04-02 11:00:00', 2, 3),
('Tente treinar ao menos 4x por semana.', '2025-04-03 09:45:00', 3, 4),
('Esse suplemento é eficaz sim!', '2025-04-04 12:10:00', 4, 5),
('Lembre-se de descansar bem.', '2025-04-05 14:20:00', 5, 6),
('A dieta cetogênica pode ajudar.', '2025-04-06 16:05:00', 6, 7),
('Use carga leve no início.', '2025-04-07 08:30:00', 7, 8),
('Esse plano cobre todos os músculos.', '2025-04-08 15:10:00', 8, 9),
('Consulte seu nutricionista.', '2025-04-09 13:50:00', 9, 10),
('Recomendo whey protein isolado.', '2025-04-10 17:25:00', 10, 1);

INSERT INTO aula_agendada (horario_idhorario, data_aula, usuario_idusuario)
VALUES
(1, '2025-04-20', 1),
(2, '2025-04-21', 2),
(3, '2025-04-22', 3),
(4, '2025-04-23', 4),
(5, '2025-04-24', 5),
(6, '2025-04-25', 6),
(7, '2025-04-26', 7),
(8, '2025-04-27', 8),
(9, '2025-04-28', 9),
(10, '2025-04-29', 10);

INSERT INTO cupom_desconto (codigo, percentual_desconto, valor_desconto, data_validade, usuario_idusuario, tipo)
VALUES
('GEN10', 10.00, NULL, '2025-06-01', 1, 'percentual'),
('FIT20', 20.00, NULL, '2025-06-15', 2, 'percentual'),
('FIX50', NULL, 50.00, '2025-07-01', 3, 'fixo'),
('WELCOME15', 15.00, NULL, '2025-06-10', 4, 'percentual'),
('SAVE30', NULL, 30.00, '2025-05-30', 5, 'fixo'),
('PROMO5', 5.00, NULL, '2025-05-01', 6, 'percentual'),
('TOP25', 25.00, NULL, '2025-08-01', 7, 'percentual'),
('VALE40', NULL, 40.00, '2025-07-20', 8, 'fixo'),
('FLEX60', NULL, 60.00, '2025-08-15', 9, 'fixo'),
('DESCONTO10', 10.00, NULL, '2025-06-05', 10, 'percentual');