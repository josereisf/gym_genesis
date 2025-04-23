Use gym_genesis;

<<<<<<< Updated upstream
=======
-- 1.1. horario
INSERT INTO horario (dia_semana, hora_inicio, hora_fim) VALUES
  ('Segunda', '08:00:00', '09:00:00'),
  ('Quarta', '10:00:00', '11:00:00'),
  ('Sexta',  '18:00:00', '19:00:00');

-- 1.2. cargo
INSERT INTO cargo (nome, descricao) VALUES
  ('Instrutor', 'Responsável por ministrar aulas'),
  ('Nutricionista', 'Elabora planos alimentares'),
  ('Recepcionista', 'Atende clientes na recepção');

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
  ('Supino', 'Peitoral', 'Exercício de supino reto', 'https://www.youtube.com/watch?v=SCVCLChKNOk'),
  ('Agachamento', 'Pernas', 'Agachamento livre', 'https://www.youtube.com/watch?v=Dy28eq2PjcM'),
  ('Puxada na barra', 'Costas', 'Puxada frontal', 'https://www.youtube.com/watch?v=V9t9xCZK1KM');


-- 1.6. alimento
INSERT INTO alimento (nome, calorias, carboidratos, proteinas, gorduras, porcao, categoria) VALUES
  ('Banana', 89.00, 23.00, 1.10, 0.30, '100g', 'Fruta'),
  ('Peito de Frango', 165.00, 0.00, 31.00, 3.60, '100g', 'Proteína'),
  ('Arroz Integral', 111.00, 23.00, 2.60, 0.90, '100g', 'Carboidrato');

-- 2. Usuario e tabelas dependentes diretas

-- 2.1. usuario
>>>>>>> Stashed changes
INSERT INTO usuario (nome, senha, email, cpf, data_de_nascimento, telefone, foto_de_perfil, numero_matricula, tipo_usuario) VALUES
('João Silva', 'senha1', 'joao1@example.com', '12345678901', '1990-01-01', '11987654321', 'foto1.jpg', '1001', 0),
('Maria Souza', 'senha2', 'maria2@example.com', '98765432100', '1985-05-12', '11923456789', 'foto2.jpg', '1002', 1),
('Carlos Lima', 'senha3', 'carlos3@example.com', '11223344556', '1992-07-23', '11876543210', 'foto3.jpg', '1003', 2),
('Ana Paula', 'senha4', 'ana4@example.com', '22334455667', '1995-03-30', '11765432109', 'foto4.jpg', '1004', 0),
('Rafael Costa', 'senha5', 'rafael5@example.com', '33445566778', '1988-08-15', '11654321098', 'foto5.jpg', '1005', 1),
('Juliana Dias', 'senha6', 'juliana6@example.com', '44556677889', '1991-02-20', '11543210987', 'foto6.jpg', '1006', 2),
('Lucas Rocha', 'senha7', 'lucas7@example.com', '55667788990', '1993-11-10', '11432109876', 'foto7.jpg', '1007', 0),
('Fernanda Alves', 'senha8', 'fernanda8@example.com', '66778899001', '1996-06-05', '11321098765', 'foto8.jpg', '1008', 1),
('Gabriel Mendes', 'senha9', 'gabriel9@example.com', '77889900112', '1994-04-18', '11210987654', 'foto9.jpg', '1009', 2),
('Patrícia Ferreira', 'senha10', 'patricia10@example.com', '88990011223', '1989-09-25', '11109876543', 'foto10.jpg', '1010', 0);

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
INSERT INTO assinatura (data_inicio, data_fim, usuario_idusuario) VALUES
('2024-03-01', '2024-03-31', 1),
('2024-03-02', '2024-04-01', 2),
('2024-03-03', '2024-06-03', 3),
('2024-03-04', '2024-04-03', 4),
('2024-03-05', '2025-03-05', 5),
('2024-03-06', '2024-04-06', 6),
('2024-03-07', '2024-06-07', 7),
('2024-03-08', '2024-04-08', 8),
('2024-03-09', '2025-03-09', 9),
('2024-03-10', '2024-04-10', 10);

-- Inserts para produto
INSERT INTO produto (nome, descricao, preco, quantidade_estoque, imagem) VALUES
('Whey Protein', 'Suplemento proteico', 150.00, 50, 'imagens/whey_protein.jpg'),
('Creatina', 'Suplemento de creatina', 90.00, 40, 'imagens/creatina.jpg'),
('BCAA', 'Aminoácidos essenciais', 80.00, 30, 'imagens/bcaa.jpg'),
('Pré-treino', 'Suplemento energético', 120.00, 20, 'imagens/pre_treino.jpg'),
('Glutamina', 'Ajuda na recuperação muscular', 70.00, 25, 'imagens/glutamina.jpg'),
('Barrinha Proteica', 'Snack saudável', 10.00, 100, 'imagens/barrinha.jpg'),
('Camiseta Dry Fit', 'Roupas esportivas', 50.00, 60, 'imagens/camiseta.jpg'),
('Garrafa', 'Garrafa para treino', 30.00, 75, 'imagens/garrafa.jpg'),
('Luvas', 'Luvas para musculação', 45.00, 35, 'imagens/luvas.jpg'),
('Corda de Pular', 'Equipamento para cardio', 25.00, 40, 'imagens/corda.jpg');

-- Inserts para treino
INSERT INTO treino (tipo, horario, descricao, usuario_idusuario) VALUES
('Treino A', '07:00:00', 'Pernas e glúteos', 1),
('Treino B', '08:00:00', 'Peito e tríceps', 2),
('Treino C', '09:00:00', 'Costas e bíceps', 3),
('Treino D', '10:00:00', 'Abdômen e cardio', 4),
('Treino E', '11:00:00', 'Corpo inteiro', 5),
('Treino F', '12:00:00', 'Treino funcional', 6),
('Treino G', '13:00:00', 'Hipertrofia superior', 7),
('Treino H', '14:00:00', 'Hipertrofia inferior', 8),
('Treino I', '15:00:00', 'Mobilidade e alongamento', 9),
('Treino J', '16:00:00', 'Crossfit', 10);

-- Inserts para dieta
INSERT INTO dieta (descricao, data_inicio, data_fim, usuario_idusuario) VALUES
('Baixa caloria', '2024-03-01', '2024-03-31', 1),
('Alta proteína', '2024-03-02', '2024-04-01', 2),
('Ganhar massa', '2024-03-03', '2024-04-02', 3),
('Perder gordura', '2024-03-04', '2024-04-03', 4),
('Manutenção', '2024-03-05', '2024-04-04', 5),
('Ciclo de carboidrato', '2024-03-06', '2024-04-05', 6),
('Vegetariana', '2024-03-07', '2024-04-06', 7),
('Vegana', '2024-03-08', '2024-04-07', 8),
('Cetogênica', '2024-03-09', '2024-04-08', 9),
('Jejum intermitente', '2024-03-10', '2024-04-09', 10);

-- Inserts para pedido
INSERT INTO pedido (usuario_idusuario, data_pedido, status) VALUES
(1, '2024-04-01', 'processando'),
(2, '2024-04-02', 'enviado'),
(3, '2024-04-03', 'concluído'),
(4, '2024-04-04', 'processando'),
(5, '2024-04-05', 'enviado'),
(6, '2024-04-06', 'concluído'),
(7, '2024-04-07', 'processando'),
(8, '2024-04-08', 'enviado'),
(9, '2024-04-09', 'concluído'),
(10, '2024-04-10', 'processando');

INSERT INTO produto (nome, descricao, preco, quantidade_estoque, imagem) VALUES
('Whey Protein', 'Proteína concentrada para ganho de massa muscular', 120.50, 30, 'img/produtos/1.jpg'),
('Camisa Dry Fit', 'Camisa esportiva leve e respirável', 45.90, 50, 'img/produtos/2.jpg'),
('Corda de Pular', 'Acessório para exercícios aeróbicos', 25.00, 100, 'img/produtos/3.jpg'),
('Halter 10kg', 'Equipamento de musculação', 80.00, 20, 'img/produtos/4.jpg'),
('Tênis de Corrida', 'Calçado leve com amortecimento', 220.00, 15, 'img/produtos/5.jpg'),
('Mochila Esportiva', 'Mochila prática para treinos e dia a dia', 99.99, 25, 'img/produtos/6.jpg'),
('Smartwatch Fit', 'Relógio com monitor cardíaco e GPS', 299.99, 10, 'img/produtos/7.jpg'),
('Guia de Treino Funcional', 'Livro com treinos para todos os níveis', 39.90, 40, 'img/produtos/8.jpg'),
('Gel para Massagem', 'Cosmético para alívio muscular', 19.90, 60, 'img/produtos/9.jpg'),
('Água de Coco', 'Bebida natural hidratante', 5.00, 80, 'img/produtos/10.jpg');

-- Inserts para item_pedido
INSERT INTO item_pedido (pedido_idpedido, produto_idproduto, quantidade) VALUES
(1, 1, 1),
(1, 3, 2),
(2, 2, 1),
(2, 6, 1),
(3, 4, 1),
(4, 5, 1),
(4, 9, 3),
(5, 7, 1),
(6, 8, 2),
(7, 10, 5);

INSERT INTO meta_usuario (usuario_id, descricao, data_inicio, data_limite, status)
VALUES
(1, 'Perder 5kg em 2 meses', '2025-01-01', '2025-03-01', 'ativa'),
(2, 'Ganhar massa muscular', '2025-02-15', '2025-06-15', 'ativa'),
(3, 'Melhorar resistência cardiovascular', '2025-01-20', '2025-04-20', 'ativa'),
(4, 'Reduzir percentual de gordura', '2025-03-01', '2025-06-01', 'ativa'),
(5, 'Aumentar força', '2025-01-10', '2025-04-10', 'cancelada'),
(6, 'Manutenção corporal', '2025-02-01', '2025-05-01', 'ativa'),
(7, 'Preparação para maratona', '2025-03-15', '2025-07-15', 'ativa'),
(8, 'Reabilitação pós-cirurgia', '2025-01-05', '2025-04-05', 'cancelada'), 
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

INSERT INTO exercicio (nome, grupo_muscular, descricao, video_url) VALUES
('Supino reto', 'Peitoral', 'Exercício para trabalhar o peitoral maior, realizado deitado em um banco com barra', 'https://link-para-video.com/supino_reto'),
('Agachamento', 'Quadríceps', 'Exercício que trabalha principalmente os músculos das pernas e glúteos', 'https://link-para-video.com/agachamento'),
('Puxada na barra', 'Costas', 'Exercício para trabalhar as costas, utilizando uma barra suspensa', 'https://link-para-video.com/puxada_na_barra'),
('Remada curvada', 'Costas', 'Exercício que foca no desenvolvimento dos músculos das costas e bíceps', 'https://link-para-video.com/remada_curvada'),
('Flexão de braços', 'Peitoral', 'Exercício que trabalha o peitoral e os músculos dos ombros e tríceps', 'https://link-para-video.com/flexao_de_bracos'),
('Desenvolvimento com barra', 'Ombros', 'Exercício que trabalha os ombros, realizado com barra acima da cabeça', 'https://link-para-video.com/desenvolvimento_com_barra'),
('Rosca direta', 'Bíceps', 'Exercício para fortalecimento do bíceps, realizado com barra ou halteres', 'https://link-para-video.com/rosca_direta'),
('Leg press', 'Quadríceps', 'Exercício de extensão de pernas utilizando uma máquina de leg press', 'https://link-para-video.com/leg_press'),
('Elevação lateral', 'Ombros', 'Exercício para trabalhar os músculos laterais dos ombros, utilizando halteres', 'https://link-para-video.com/elevacao_lateral'),
('Abdominal reto', 'Abdômen', 'Exercício para o fortalecimento da musculatura abdominal, realizado deitado no chão', 'https://link-para-video.com/abdominal_reto');

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

INSERT INTO pagamento (usuario_idusuario, valor, data_pagamento, metodo, status)
VALUES
(1, 149.99, '2025-03-01', 'cartao', 'sucesso'),
(2, 199.00, '2025-03-02', 'boleto', 'falha'),
(3, 129.50, '2025-03-03', 'pix', 'sucesso'),
(4, 179.90, '2025-03-04', 'cartao', 'sucesso'),
(5, 89.99, '2025-03-05', 'pix', 'falha'),
(6, 220.00, '2025-03-06', 'boleto', 'sucesso'),
(7, 150.75, '2025-03-07', 'cartao', 'sucesso'),
(8, 199.99, '2025-03-08', 'cartao', 'sucesso'),
(9, 99.00, '2025-03-09', 'pix', 'sucesso'),
(10, 135.00, '2025-03-10', 'boleto', 'falha');

INSERT INTO pagamento_detalhe (pagamento_idpagamento, tipo, bandeira_cartao, ultimos_digitos, codigo_pix, linha_digitavel_boleto)
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

INSERT INTO forum (titulo, descricao, data_criacao, usuario_idusuario) VALUES
('Dúvidas sobre treinos de musculação', 'Espaço para tirar dúvidas sobre treinos de musculação', '2025-04-19', 1),
('Dicas de nutrição para hipertrofia', 'Compartilhe dicas e estratégias nutricionais para ganhar massa muscular', '2025-04-19', 2),
('Treinos para emagrecimento', 'Discussões sobre treinos focados em emagrecimento e queima de gordura', '2025-04-18', 3),
('Exercícios para fortalecer o core', 'Dicas e sugestões para trabalhar a musculatura do core', '2025-04-17', 4),
('Melhores exercícios para o peito', 'Quais são os melhores exercícios para o desenvolvimento do peitoral?', '2025-04-16', 5),
('Treinos para iniciantes', 'Sugestões de treinos para quem está começando na musculação', '2025-04-15', 6),
('Suplementos: vale a pena?', 'Discussão sobre os benefícios e malefícios dos suplementos alimentares', '2025-04-14', 7),
('Exercícios para emagrecer rápido', 'Quais os melhores exercícios para quem busca emagrecer de forma mais rápida?', '2025-04-13', 8),
('Cuidados com a alimentação pós-treino', 'Discussões sobre a alimentação ideal para recuperação após os treinos', '2025-04-12', 9),
('Treinos para glúteos e pernas', 'Melhores exercícios para aumentar e definir os glúteos e as pernas', '2025-04-11', 10);

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

INSERT INTO horario (dia_semana, hora_inicio, hora_fim) 
VALUES
('Segunda', '06:00:00', '10:00:00'),
('Segunda', '17:00:00', '21:00:00'),
('Terça', '06:00:00', '10:00:00'),
('Terça', '17:00:00', '21:00:00'),
('Quarta', '07:00:00', '11:00:00'),
('Quarta', '18:00:00', '22:00:00'),
('Quinta', '06:30:00', '10:30:00'),
('Quinta', '17:30:00', '21:30:00'),
('Sexta', '06:00:00', '10:00:00'),
('Sábado', '08:00:00', '12:00:00');

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

INSERT INTO cupom_desconto (codigo, percentual_desconto, valor_desconto, data_validade, quantidade_uso, tipo)
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

INSERT INTO categoria_produto (nome, descricao) VALUES 
('Suplementos', 'Produtos para suplementação alimentar e performance'),
('Roupas Fitness', 'Vestuário esportivo para treinos e atividades físicas'),
('Acessórios', 'Itens como luvas, cintos e faixas para treino'),
('Equipamentos', 'Máquinas, pesos e outros equipamentos de ginástica'),
('Calçados Esportivos', 'Tênis e calçados apropriados para atividades físicas'),
('Bolsas e Mochilas', 'Bolsas esportivas e mochilas para academia'),
('Eletrônicos', 'Relógios, fones e gadgets fitness'),
('Livros e Guias', 'Material educativo sobre treino e nutrição'),
('Cosméticos', 'Produtos de cuidados pessoais voltados ao público fitness'),
('Hidratantes', 'Produtos para hidratação corporal e cuidados com a pele');



-- Inserts para a tabela plano
INSERT INTO plano (tipo, duracao, assinatura_idassinatura) VALUES
('Mensal', 'Plano com renovação mensal', 99.90),
('Trimestral', 'Plano com 3 meses de acesso', 279.90),
('Semestral', 'Plano com 6 meses de acesso', 499.90),
('Anual', 'Plano com 1 ano de acesso', 899.90),
('VIP', 'Plano premium com benefícios exclusivos', 1299.90),
('Familiar', 'Plano para até 4 pessoas', 1499.90),
('Estudante', 'Desconto especial para estudantes', 79.90),
('Empresarial', 'Para empresas e grupos', 2499.90),
('Personal Trainer', 'Plano com acompanhamento personalizado', 1599.90),
('Off-Peak', 'Acesso em horários fora do pico', 69.90);

-- Inserts para a tabela alimento
INSERT INTO alimento (nome, calorias) VALUES
('Frango grelhado', 165),
('Arroz integral', 110),
('Ovos', 70),
('Batata doce', 90),
('Brócolis', 55),
('Banana', 105),
('Aveia', 150),
('Peito de peru', 120),
('Iogurte natural', 80),
('Amêndoas', 170);

-- Inserts para a tabela dieta_alimento
INSERT INTO dieta_alimento (id_dieta, id_alimento, quantidade) VALUES
(1, 1, 200),
(1, 2, 150),
(2, 3, 100),
(2, 4, 200),
(3, 5, 100),
(3, 6, 1),
(4, 7, 80),
(4, 8, 100),
(5, 9, 150),
(5, 10, 50);

-- Inserts para a tabela refeicao
INSERT INTO refeicao (id_dieta, horario, descricao) VALUES
(1, '08:00:00', 'Café da manhã: ovos, aveia e banana'),
(1, '12:30:00', 'Almoço: frango grelhado, arroz integral e brócolis'),
(2, '07:00:00', 'Café da manhã: iogurte natural e amêndoas'),
(2, '13:00:00', 'Almoço: peito de peru e batata doce'),
(3, '10:00:00', 'Lanche da manhã: banana e aveia'),
(3, '18:00:00', 'Jantar: frango grelhado e brócolis'),
(4, '09:00:00', 'Pré-treino: ovos e batata doce'),
(4, '20:00:00', 'Ceia: iogurte e amêndoas'),
(5, '06:30:00', 'Café: aveia, banana e leite'),
(5, '14:00:00', 'Almoço: arroz integral, frango e brócolis');