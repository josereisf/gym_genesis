-- Inserts para o schema `gym_genesis`
-- 3 registros por tabela, respeitando ordem de dependências
use gym_genesis;
-- 1. Tabelas independentes
-- 1.2. cargo (já existe 3, adicionando mais 17)
INSERT INTO cargo (nome, descricao) VALUES
  ('Instrutor', 'Responsável por orientar os alunos durante os treinos'),
  ('Personal Trainer', 'Especialista em treinamento individualizado'),
  ('Professor de Musculação', 'Acompanha os treinos de musculação e corrige técnicas'),
  ('Professor de Spinning', 'Conduz aulas de ciclismo indoor'),
  ('Professor de Pilates', 'Aplica exercícios de pilates solo e em aparelhos'),
  ('Professor de Yoga', 'Instrui práticas de yoga e alongamento'),
  ('Professor de Crossfit', 'Ministra treinos funcionais de alta intensidade'),
  ('Professor de Zumba', 'Conduz aulas de dança fitness com ritmos variados'),
  ('Professor de Dança', 'Ensina diferentes modalidades de dança para condicionamento físico'),
  ('Professor de Artes Marciais', 'Instrui lutas como jiu-jitsu, muay thai, judô e outras'),
  ('Professor de Boxe', 'Conduz treinos técnicos e físicos de boxe'),
  ('Professor de Kçãickboxing', 'Ensina técnicas de kickboxing aplicadas ao fitness'),
  ('Professor de Natao', 'Ensina e acompanha treinos de natação'),
  ('Professor de Hidroginástica', 'Aplica aulas de ginástica na água'),
  ('Professor de Ginástica Coletiva', 'Conduz aulas de ginástica em grupo'),
  ('Professor de Alongamento', 'Foca em aulas de flexibilidade e mobilidade'),
  ('Professor de Funcional', 'Ministra treinos funcionais e circuitos'),
  ('Professor de Calistenia', 'Instrui treinos com peso corporal'),
  ('Professor de Corrida', 'Acompanha e orienta treinos de corrida e atletismo'),
  ('Professor de Powerlifting', 'Especialista em levantamento de peso olímpico e força máxima');


-- 1.3. categoria_produto (já existe 3, adicionando mais 17)
INSERT INTO categoria_produto (nome, descricao) VALUES
  ('Calçados', 'Tênis e sapatos esportivos'),
  ('Bolsas', 'Bolsas esportivas'),
  ('Snacks', 'Lanches saudáveis'),
  ('Bebidas', 'Bebidas energéticas'),
  ('Equipamentos', 'Máquinas e pesos'),
  ('Livros', 'Livros de treinamento'),
  ('Aparelhos', 'Aparelhos eletrônicos'),
  ('Meias', 'Meias esportivas'),
  ('Luvas', 'Luvas para treino'),
  ('Bonés', 'Bonés e viseiras'),
  ('Pulseiras', 'Pulseiras fitness'),
  ('Relógios', 'Relógios esportivos'),
  ('Suporte', 'Suportes para equipamentos'),
  ('Faixas', 'Faixas de resistência'),
  ('Cintos', 'Cintos de levantamento'),
  ('Toalhas', 'Toalhas esportivas'),
  ('Shakers', 'Shakers para suplementos');

-- 1.4. produto (já existe 3, adicionando mais 17)
INSERT INTO produto (nome, descricao, preco, quantidade_estoque, imagem) VALUES
  ('Creatina', 'Suplemento para força', 120.00, 40, NULL),
  ('BCAA', 'Aminoácidos essenciais', 90.00, 60, NULL),
  ('Tênis Running', 'Tênis para corrida', 250.00, 30, NULL),
  ('Shorts Fitness', 'Shorts esportivo', 70.00, 80, NULL),
  ('Barra Olímpica', 'Barra para levantamento', 500.00, 10, NULL),
  ('Luvas de Treino', 'Proteção para mãos', 40.00, 100, NULL),
  ('Boné Esportivo', 'Boné para treino', 35.00, 50, NULL),
  ('Toalha Microfibra', 'Toalha leve', 25.00, 120, NULL),
  ('Shaker 500ml', 'Misturador de suplemento', 20.00, 90, NULL),
  ('Pulseira Smart', 'Monitoramento de treino', 180.00, 25, NULL),
  ('Livro Treino', 'Guia de exercícios', 60.00, 15, NULL),
  ('Snack Proteico', 'Lanche saudável', 8.00, 200, NULL),
  ('Bebida Isotônica', 'Reposição de eletrólitos', 6.00, 150, NULL),
  ('Cinto de Levantamento', 'Suporte lombar', 85.00, 40, NULL),
  ('Faixa Elástica', 'Resistência para treino', 30.00, 70, NULL),
  ('Meia Esportiva', 'Meia para treino', 15.00, 110, NULL),
  ('Bolsa Fitness', 'Bolsa para academia', 120.00, 20, NULL);

-- 1.5. exercicio (já existe 3, adicionando mais 17)
INSERT INTO exercicio (nome, grupo_muscular, descricao, video_url) VALUES
  ('Rosca Direta', 'Braços', 'Exercício para bíceps', NULL),
  ('Tríceps Testa', 'Braços', 'Exercício para tríceps', NULL),
  ('Leg Press', 'Pernas', 'Exercício para quadríceps', NULL),
  ('Flexão', 'Peitoral', 'Exercício de flexão de braços', NULL),
  ('Abdominal', 'Core', 'Exercício para abdômen', NULL),
  ('Remada Curvada', 'Costas', 'Exercício para dorsais', NULL),
  ('Desenvolvimento', 'Ombros', 'Exercício para deltoides', NULL),
  ('Panturrilha', 'Pernas', 'Exercício para panturrilhas', NULL),
  ('Elevação Lateral', 'Ombros', 'Exercício para ombros', NULL),
  ('Prancha', 'Core', 'Exercício de estabilidade', NULL),
  ('Stiff', 'Pernas', 'Exercício para posteriores', NULL),
  ('Pull Over', 'Costas', 'Exercício para dorsais', NULL),
  ('Crucifixo', 'Peitoral', 'Exercício para peitoral', NULL),
  ('Afundo', 'Pernas', 'Exercício para glúteos', NULL),
  ('Voador', 'Peitoral', 'Exercício para peitoral', NULL),
  ('Extensão de Pernas', 'Pernas', 'Exercício para quadríceps', NULL),
  ('Rosca Martelo', 'Braços', 'Exercício para antebraço', NULL);



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
-- 2.1. usuario (20 inserts)
INSERT INTO usuario (senha, email, tipo_usuario) VALUES
('senha4', 'lucas.silva@ex.com', 1),
('senha5', 'fernanda.souza@ex.com', 1),
('senha6', 'rafael.costa@ex.com', 1),
('senha7', 'juliana.lima@ex.com', 1),
('senha8', 'gabriel.rocha@ex.com', 1),
('senha9', 'patricia.nunes@ex.com', 1),
('senha10', 'rodrigo.alves@ex.com', 1),
('senha11', 'amanda.torres@ex.com', 1),
('senha12', 'thiago.martins@ex.com', 1),
('senha13', 'camila.prado@ex.com', 1),
('senha14', 'mariana.oliveira@ex.com', 1),
('senha15', 'bruno.ferreira@ex.com', 1),
('senha16', 'carolina.mendes@ex.com', 1),
('senha17', 'diego.ramos@ex.com', 1),
('senha18', 'larissa.duarte@ex.com', 1),
('senha19', 'felipe.barros@ex.com', 1),
('senha20', 'renata.carvalho@ex.com', 1),
('senha21', 'andre.goncalves@ex.com', 1),
('senha22', 'beatriz.lima@ex.com', 1),
('senha23', 'marcelo.pinto@ex.com', 1);

-- 1.6. alimento (já existe 3, adicionando mais 17)
INSERT INTO alimento (nome, calorias, carboidratos, proteinas, gorduras, porcao, categoria) VALUES
  ('Maçã', 52.00, 14.00, 0.30, 0.20, '100g', 'Fruta'),
  ('Ovo', 155.00, 1.10, 13.00, 11.00, '100g', 'Proteína'),
  ('Batata Doce', 86.00, 20.00, 1.60, 0.10, '100g', 'Carboidrato'),
  ('Aveia', 389.00, 66.00, 17.00, 7.00, '100g', 'Carboidrato'),
  ('Salmão', 208.00, 0.00, 20.00, 13.00, '100g', 'Proteína'),
  ('Brócolis', 34.00, 7.00, 2.80, 0.40, '100g', 'Vegetal'),
  ('Iogurte', 61.00, 4.70, 3.50, 3.30, '100g', 'Laticínio'),
  ('Pão Integral', 247.00, 41.00, 8.80, 3.40, '100g', 'Carboidrato'),
  ('Amêndoa', 579.00, 22.00, 21.00, 50.00, '100g', 'Oleaginosas'),
  ('Leite', 42.00, 5.00, 3.40, 1.00, '100g', 'Laticínio'),
  ('Peixe', 206.00, 0.00, 22.00, 12.00, '100g', 'Proteína'),
  ('Frango Grelhado', 165.00, 0.00, 31.00, 3.60, '100g', 'Proteína'),
  ('Arroz Branco', 130.00, 28.00, 2.70, 0.30, '100g', 'Carboidrato'),
  ('Quinoa', 120.00, 21.00, 4.10, 1.90, '100g', 'Carboidrato'),
  ('Batata Inglesa', 77.00, 17.00, 2.00, 0.10, '100g', 'Carboidrato'),
  ('Cenoura', 41.00, 10.00, 0.90, 0.20, '100g', 'Vegetal'),
  ('Abacate', 160.00, 9.00, 2.00, 15.00, '100g', 'Fruta');

INSERT INTO usuario ( senha, email, tipo_usuario) VALUES ("$2y$10$G5VlwS/rmR57/w37BN93GuSUjJqABSOGALBB7/c2Mtx/u2lSMq0U6", "acabate@gmail.com", 1);
INSERT INTO endereco (usuario_id, funcionario_id, cep, rua, numero, complemento, bairro, cidade, estado)
VALUES (21, NULL, '12345-678', 'Rua das Flores', '100', 'Apto 202', 'Jardim Primavera', 'São Paulo', 'SP');
INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_id)
VALUES (78.000, 198.00, 19.90, 32.00, '2025-08-25', 21);

INSERT INTO perfil_usuario (usuario_id, nome, cpf, telefone, data_nascimento, numero_matricula, foto_perfil) VALUES
  (1, 'Lucas Silva', '123.456.789-01', '11987654321', '1990-05-10', 'MAT2025001', 'padrao.png'),
  (2, 'Fernanda Souza', '234.567.890-12', '11876543210', '1988-08-22', 'MAT2025002', 'padrao.png'),
  (3, 'Rafael Costa', '345.678.901-23', '11765432109', '1995-03-15', 'MAT2025003', 'padrao.png'),
  (4, 'Juliana Lima', '456.789.012-34', '11654321098', '1992-12-01', 'MAT2025004', 'padrao.png'),
  (5, 'Gabriel Rocha', '567.890.123-45', '11543210987', '1987-07-19', 'MAT2025005', 'padrao.png'),
  (6, 'Patricia Nunes', '678.901.234-56', '11432109876', '1993-11-30', 'MAT2025006', 'padrao.png'),
  (7, 'Rodrigo Alves', '789.012.345-67', '11321098765', '1991-02-25', 'MAT2025007', 'padrao.png'),
  (8, 'Amanda Torres', '890.123.456-78', '11210987654', '1996-09-14', 'MAT2025008', 'padrao.png'),
  (9, 'Thiago Martins', '901.234.567-89', '11109876543', '1989-04-07', 'MAT2025009', 'padrao.png'),
  (10, 'Camila Prado', '012.345.678-90', '11098765432', '1994-06-21', 'MAT2025010', 'padrao.png'),
  (11, 'Mariana Oliveira', '123.111.222-33', '11912345678', '1992-01-12', 'MAT2025011', 'padrao.png'),
  (12, 'Bruno Ferreira', '234.222.333-44', '11923456789', '1990-09-03', 'MAT2025012', 'padrao.png'),
  (13, 'Carolina Mendes', '345.333.444-55', '11934567890', '1996-05-25', 'MAT2025013', 'padrao.png'),
  (14, 'Diego Ramos', '456.444.555-66', '11945678901', '1987-11-17', 'MAT2025014', 'padrao.png'),
  (15, 'Larissa Duarte', '567.555.666-77', '11956789012', '1993-03-08', 'MAT2025015', 'padrao.png'),
  (16, 'Felipe Barros', '678.666.777-88', '11967890123', '1989-07-19', 'MAT2025016', 'padrao.png'),
  (17, 'Renata Carvalho', '789.777.888-99', '11978901234', '1991-02-22', 'MAT2025017', 'padrao.png'),
  (18, 'André Gonçalves', '890.888.999-00', '11989012345', '1994-06-14', 'MAT2025018', 'padrao.png'),
  (19, 'Beatriz Lima', '901.999.000-11', '11990123456', '1992-10-30', 'MAT2025019', 'padrao.png'),
  (20, 'Marcelo Pinto', '012.000.111-22', '11901234567', '1988-12-05', 'MAT2025020', 'padrao.png');
  (21, 'Administrador', '012.002.431-22', '11905331567', '2002-12-05', 'MAT2025021', 'padrao.png');
-- 2.2. cupom_desconto (20 inserts)
INSERT INTO cupom_desconto (codigo, percentual_desconto, valor_desconto, data_validade, quantidade_uso, tipo) VALUES
('PROMO15', 15.00, NULL, '2025-12-31', 50, 'percentual'),
('FIXO30', NULL, 30.00, '2025-06-30', 30, 'fixo'),
('PROMO20', 20.00, NULL, '2025-09-30', 80, 'percentual'),
('FIXO10', NULL, 10.00, '2025-08-31', 100, 'fixo'),
('PROMO25', 25.00, NULL, '2025-10-31', 40, 'percentual'),
('FIXO50', NULL, 50.00, '2025-07-31', 20, 'fixo'),
('PROMO30', 30.00, NULL, '2025-11-30', 60, 'percentual'),
('FIXO5', NULL, 5.00, '2025-05-31', 150, 'fixo'),
('PROMO35', 35.00, NULL, '2025-12-15', 25, 'percentual'),
('FIXO25', NULL, 25.00, '2025-06-15', 70, 'fixo'),
('PROMO40', 40.00, NULL, '2025-09-15', 10, 'percentual'),
('FIXO15', NULL, 15.00, '2025-08-15', 90, 'fixo'),
('PROMO45', 45.00, NULL, '2025-10-15', 5, 'percentual'),
('FIXO35', NULL, 35.00, '2025-07-15', 15, 'fixo'),
('PROMO50', 50.00, NULL, '2025-11-15', 8, 'percentual'),
('FIXO40', NULL, 40.00, '2025-05-15', 12, 'fixo'),
('PROMO55', 55.00, NULL, '2025-12-05', 3, 'percentual'),
('FIXO45', NULL, 45.00, '2025-06-05', 7, 'fixo'),
('PROMO60', 60.00, NULL, '2025-09-05', 2, 'percentual'),
('FIXO60', NULL, 60.00, '2025-08-05', 1, 'fixo');


-- 3. Funcionário e endereço
-- 3.1. funcionario (continuação dos 20 inserts)
INSERT INTO usuario (senha, email, tipo_usuario) VALUES
  ('senha22', 'carlos@ex.com', 2),
  ('senha23', 'renata@ex.com', 2),
  ('senha24', 'joao@ex.com', 2),
  ('senha25', 'simone@ex.com', 2),
  ('senha26', 'felipe@ex.com', 2),
  ('senha27', 'patrician@ex.com', 2),
  ('senha28', 'roberto@ex.com', 2),
  ('senha29', 'julianap@ex.com', 2),
  ('senha30', 'fernando@ex.com', 2),
  ('senha31', 'amandat@ex.com', 2),
  ('senha32', 'ricardo@ex.com', 2),
  ('senha33', 'tatiane@ex.com', 2),
  ('senha34', 'gustavo@ex.com', 2),
  ('senha35', 'eliane@ex.com', 2),
  ('senha36', 'marcelo@ex.com', 2),
  ('senha37', 'vanessa@ex.com', 2),
  ('senha38', 'brunof@ex.com', 2),
  ('senha39', 'eduardo@ex.com', 2),
  ('senha40', 'mariana@ex.com', 2),
  ('senha41', 'paulo@ex.com', 2);
  
INSERT INTO funcionario (nome, telefone, data_contratacao, salario, cargo_id, usuario_id) VALUES
  ('Carlos Mendes', '11666667777', '2024-02-20', 3200.00, 4, 21),
  ('Renata Farias', '11777778888', '2023-09-10', 4100.00, 5, 22),
  ('João Batista', '11888889999', '2025-03-05', 2800.00, 6, 23),
  ('Simone Lopes', '11999990000', '2024-04-12', 3500.00, 7, 24),
  ('Felipe Ramos', '11222223333', '2023-10-18', 3700.00, 8, 25),
  ('Patricia Nunes', '11333334445', '2025-05-22', 3300.00, 9, 26),
  ('Roberto Dias', '11444445556', '2024-06-30', 2900.00, 10, 27),
  ('Juliana Prado', '11555556667', '2023-11-25', 4200.00, 11, 28),
  ('Fernando Alves', '11666667788', '2025-07-14', 3100.00, 12, 29),
  ('Amanda Torres', '11777778899', '2024-08-19', 3600.00, 13, 30),
  ('Ricardo Lima', '11888889910', '2023-12-03', 4000.00, 14, 31),
  ('Tatiane Souza', '11999990021', '2025-09-27', 3400.00, 15, 32),
  ('Gustavo Pires', '11222223344', '2024-10-05', 3800.00, 16, 33),
  ('Eliane Rocha', '11333334456', '2023-01-15', 2950.00, 17, 34),
  ('Marcelo Cunha', '11444445567', '2025-02-28', 4100.00, 18, 35),
  ('Vanessa Martins', '11555556678', '2024-03-22', 3250.00, 19, 36),
  ('Bruno Ferreira', '11666667789', '2023-04-11', 3750.00, 20, 37);

-- Inserts para mais 3 funcionários
-- 3.1. funcionario
INSERT INTO funcionario (nome, telefone, data_contratacao, salario, cargo_id, usuario_id) VALUES
  ('Eduardo Lima', '11333334444', '2024-01-15', 3000.00, 1, 38),
  ('Mariana Souza', '11444445555', '2023-08-01', 4500.00, 2, 39),
  ('Paulo Rocha', '11555556666', '2025-02-10', 2500.00, 3, 40);

-- 3.2. endereco (continuação dos 20 inserts)
-- Endereços para os usuários (usuario_id de 1 a 20) com funcionario_id como NULL e CEPS reais
INSERT INTO endereco (usuario_id, funcionario_id, cep, rua, numero, complemento, bairro, cidade, estado) VALUES
  (1, NULL, '01001000', 'Rua A', '100', 'Apto 5', 'Centro', 'São Paulo', 'SP'),  -- São Paulo, SP
  (2, NULL, '04032000', 'Av. B', '200', 'Apto 10', 'Jardim', 'Santa', 'SP'),  -- Campinas, SP
  (3, NULL, '11002000', 'Rua C', '300', 'Apto 9', 'Vila', 'Ubatuba', 'SP'),  -- Ubatuba, SP
  (4, NULL, '04004000', 'Rua D', '400', 'Casa', 'Bairro Novo', 'Campinas', 'SP'),  -- Campinas, SP
  (5, NULL, '11013000', 'Av. E', '500', NULL, 'Centro', 'Santos', 'SP'),  -- Santos, SP
  (6, NULL, '07065000', 'Rua F', '600', 'Apto 2', 'Jardim', 'Guarulhos', 'SP'),  -- Guarulhos, SP
  (7, NULL, '18086000', 'Av. G', '700', NULL, 'Vila', 'Sorocaba', 'SP'),  -- Sorocaba, SP
  (8, NULL, '14090000', 'Rua H', '800', 'Casa 1', 'Bairro Alto', 'Ribeirão Preto', 'SP'),  -- Ribeirão Preto, SP
  (9, NULL, '12211000', 'Av. I', '900', NULL, 'Centro', 'São José dos Campos', 'SP'),  -- São José dos Campos, SP
  (10, NULL, '12030000', 'Rua J', '1000', 'Apto 3', 'Jardim', 'Taubaté', 'SP'),  -- Taubaté, SP
  (11, NULL, '06422000', 'Av. K', '1100', NULL, 'Vila', 'Barueri', 'SP'),  -- Barueri, SP
  (12, NULL, '06230000', 'Rua L', '1200', 'Casa', 'Bairro Novo', 'Osasco', 'SP'),  -- Osasco, SP
  (13, NULL, '09910000', 'Av. M', '1300', NULL, 'Centro', 'Diadema', 'SP'),  -- Diadema, SP
  (14, NULL, '06322000', 'Rua N', '1400', 'Apto 4', 'Jardim', 'Carapicuíba', 'SP'),  -- Carapicuíba, SP
  (15, NULL, '08730000', 'Av. O', '1500', NULL, 'Vila', 'Mogi das Cruzes', 'SP'),  -- Mogi das Cruzes, SP
  (16, NULL, '08690000', 'Rua P', '1600', 'Casa 2', 'Bairro Alto', 'Suzano', 'SP'),  -- Suzano, SP
  (17, NULL, '18135000', 'Av. Q', '1700', NULL, 'Centro', 'Itapevi', 'SP'),  -- Itapevi, SP
  (18, NULL, '06714000', 'Rua R', '1800', 'Apto 5', 'Jardim', 'Cotia', 'SP'),  -- Cotia, SP
  (19, NULL, '13232000', 'Av. S', '1900', NULL, 'Vila', 'Jandira', 'SP'),  -- Jandira, SP
  (20, NULL, '06520000', 'Rua T', '2000', 'Casa', 'Bairro Novo', 'Santana de Parnaíba', 'SP');  -- Santana de Parnaíba, SP

INSERT INTO endereco (usuario_id, funcionario_id, cep, rua, numero, complemento, bairro, cidade, estado) VALUES
  (NULL, 1, '01001000', 'Rua A', '100', 'Apto 5', 'Centro', 'São Paulo', 'SP'),  -- São Paulo, SP
  (NULL, 2, '04032000', 'Av. B', '200', 'Apto 10', 'Jardim', 'Santa', 'SP'),  -- Campinas, SP
  (NULL, 3, '11002000', 'Rua C', '300', 'Apto 9', 'Vila', 'Ubatuba', 'SP'),  -- Ubatuba, SP
  (NULL, 4, '04004000', 'Rua D', '400', 'Casa', 'Bairro Novo', 'Campinas', 'SP'),  -- Campinas, SP
  (NULL, 5, '11013000', 'Av. E', '500', NULL, 'Centro', 'Santos', 'SP'),  -- Santos, SP
  (NULL, 6, '07065000', 'Rua F', '600', 'Apto 2', 'Jardim', 'Guarulhos', 'SP'),  -- Guarulhos, SP
  (NULL, 7, '18086000', 'Av. G', '700', NULL, 'Vila', 'Sorocaba', 'SP'),  -- Sorocaba, SP
  (NULL, 8, '14090000', 'Rua H', '800', 'Casa 1', 'Bairro Alto', 'Ribeirão Preto', 'SP'),  -- Ribeirão Preto, SP
  (NULL, 9, '12211000', 'Av. I', '900', NULL, 'Centro', 'São José dos Campos', 'SP'),  -- São José dos Campos, SP
  (NULL, 10, '12030000', 'Rua J', '1000', 'Apto 3', 'Jardim', 'Taubaté', 'SP'),  -- Taubaté, SP
  (NULL, 11, '06422000', 'Av. K', '1100', NULL, 'Vila', 'Barueri', 'SP'),  -- Barueri, SP
  (NULL, 12, '06230000', 'Rua L', '1200', 'Casa', 'Bairro Novo', 'Osasco', 'SP'),  -- Osasco, SP
  (NULL, 13, '09910000', 'Av. M', '1300', NULL, 'Centro', 'Diadema', 'SP'),  -- Diadema, SP
  (NULL, 14, '06322000', 'Rua N', '1400', 'Apto 4', 'Jardim', 'Carapicuíba', 'SP'),  -- Carapicuíba, SP
  (NULL, 15, '08730000', 'Av. O', '1500', NULL, 'Vila', 'Mogi das Cruzes', 'SP'),  -- Mogi das Cruzes, SP
  (NULL, 16, '08690000', 'Rua P', '1600', 'Casa 2', 'Bairro Alto', 'Suzano', 'SP'),  -- Suzano, SP
  (NULL, 17, '18135000', 'Av. Q', '1700', NULL, 'Centro', 'Itapevi', 'SP'),  -- Itapevi, SP
  (NULL, 18, '06714000', 'Rua R', '1800', 'Apto 5', 'Jardim', 'Cotia', 'SP'),  -- Cotia, SP
  (NULL, 19, '13232000', 'Av. S', '1900', NULL, 'Vila', 'Jandira', 'SP'),  -- Jandira, SP
  (NULL, 20, '06520000', 'Rua T', '2000', 'Casa', 'Bairro Novo', 'Santana de Parnaíba', 'SP');  -- Santana de Parnaíba, SP

-- 4. Assinatura e plano
-- 4.2. plano
-- Inserção de planos disponíveis
INSERT INTO `gym_genesis`.`plano` (`tipo`, `duracao`)
VALUES
('Mensal', '30 dias'),
('Trimestral', '90 dias'),
('Anual', '365 dias');

INSERT INTO `gym_genesis`.`assinatura` 
(`data_inicio`, `data_fim`, `usuario_id`, `plano_id`)
VALUES
('2025-04-01', '2025-07-01', 1, 1), -- Usuário 1, Plano Mensal
('2025-03-15', '2025-06-15', 2, 2), -- Usuário 2, Plano Trimestral
('2025-04-10', '2026-04-10', 3, 3), -- Usuário 3, Plano Anual
('2025-05-01', '2025-06-01', 4, 1), -- Usuário 4, Plano Mensal
('2025-05-15', '2025-08-15', 5, 2), -- Usuário 5, Plano Trimestral
('2025-06-10', '2026-06-10', 6, 3), -- Usuário 6, Plano Anual
('2025-07-01', '2025-08-01', 7, 1), -- Usuário 7, Plano Mensal
('2025-07-15', '2025-10-15', 8, 2), -- Usuário 8, Plano Trimestral
('2025-08-10', '2026-08-10', 9, 3), -- Usuário 9, Plano Anual
('2025-09-01', '2025-10-01', 10, 1), -- Usuário 10, Plano Mensal
('2025-09-15', '2025-12-15', 11, 2), -- Usuário 11, Plano Trimestral
('2025-10-10', '2026-10-10', 12, 3), -- Usuário 12, Plano Anual
('2025-11-01', '2025-12-01', 13, 1), -- Usuário 13, Plano Mensal
('2025-11-15', '2026-02-15', 14, 2), -- Usuário 14, Plano Trimestral
('2025-12-10', '2026-12-10', 15, 3), -- Usuário 15, Plano Anual
('2026-01-01', '2026-02-01', 16, 1), -- Usuário 16, Plano Mensal
('2026-01-15', '2026-04-15', 17, 2), -- Usuário 17, Plano Trimestral
('2026-02-10', '2027-02-10', 18, 3), -- Usuário 18, Plano Anual
('2026-03-01', '2026-04-01', 19, 1), -- Usuário 19, Plano Mensal
('2026-03-15', '2026-06-15', 20, 2); -- Usuário 20, Plano Trimestral



-- 5. Dieta, refeição e dieta_alimento
-- 5. Dieta, refeição e dieta_alimento (continuação dos 20 inserts)

-- 5.1. dieta
INSERT INTO `gym_genesis`.`dieta` 
(`descricao`, `data_inicio`, `data_fim`, `usuario_id`) 
VALUES
  ('Dieta low carb', '2025-04-01', '2025-06-01', 4),
  ('Dieta vegana', '2025-05-10', NULL, 5),
  ('Dieta cetogênica', '2025-06-15', NULL, 6),
  ('Dieta mediterrânea', '2025-07-01', '2025-09-01', 7),
  ('Dieta paleolítica', '2025-08-05', NULL, 8),
  ('Dieta DASH', '2025-09-10', NULL, 9),
  ('Dieta flexível', '2025-10-01', '2025-12-01', 10),
  ('Dieta vegetariana', '2025-11-15', NULL, 11),
  ('Dieta sem glúten', '2025-12-20', NULL, 12),
  ('Dieta sem lactose', '2026-01-05', NULL, 13),
  ('Dieta de hipertrofia', '2026-02-10', NULL, 14),
  ('Dieta de manutenção', '2026-03-01', NULL, 15),
  ('Dieta detox', '2026-04-10', '2026-05-10', 16),
  ('Dieta de reeducação alimentar', '2026-05-15', NULL, 17),
  ('Dieta para atletas', '2026-06-20', NULL, 18),
  ('Dieta para emagrecimento', '2026-07-01', NULL, 19),
  ('Dieta personalizada', '2026-08-10', NULL, 20);

  -- 5.1. dieta
INSERT INTO `gym_genesis`.`dieta` 
(`descricao`, `data_inicio`, `data_fim`, `usuario_id`) 
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
  (3, 'Jantar', '19:00:00'),
  (4, 'Café da manhã', '07:30:00'),
  (5, 'Almoço', '12:15:00'),
  (6, 'Jantar', '19:30:00'),
  (7, 'Café da manhã', '16:00:00'),
  (8, 'Jantar', '22:00:00'),
  (9, 'Café da manhã', '17:30:00'),
  (10, 'Almoço', '20:00:00'),
  (11, 'Café da manhã', '08:00:00'),
  (12, 'Almoço', '13:00:00'),
  (13, 'Jantar', '20:30:00'),
  (14, 'Café da manhã', '10:00:00'),
  (15, 'Almoço', '15:30:00'),
  (16, 'Jantar', '21:30:00'),
  (17, 'Café da manhã', '18:00:00'),
  (18, 'Almoço', '21:00:00'),
  (19, 'Café da manhã', '06:30:00'),
  (20, 'Jantar', '23:00:00');

INSERT INTO `gym_genesis`.`dieta_alimentar` 
(`alimento_id`, `refeicao_id`, `quantidade`, `observacao`)
VALUES
  (1, 1, '200g', 'Proteína para o café da manhã'),
  (2, 2, '150g', 'Carboidrato para o almoço'),
  (3, 3, '100g', 'Fibras para o jantar'),
  (4, 4, '50g', 'Aveia para café da manhã'),
  (5, 5, '120g', 'Salmão grelhado no almoço'),
  (6, 6, '80g', 'Brócolis no jantar'),
  (7, 7, '170g', 'Iogurte natural no lanche da tarde'),
  (8, 8, '30g', 'Amêndoas na ceia'),
  (9, 9, '200ml', 'Leite desnatado pré-treino'),
  (10, 10, '150g', 'Peixe pós-treino'),
  (11, 11, '100g', 'Frango grelhado no café da manhã'),
  (12, 12, '130g', 'Arroz branco no almoço'),
  (13, 13, '70g', 'Quinoa no jantar'),
  (14, 14, '90g', 'Batata inglesa no lanche da manhã'),
  (15, 15, '60g', 'Cenoura no lanche da tarde'),
  (16, 16, '80g', 'Abacate na ceia'),
  (17, 17, '110g', 'Banana pré-treino'),
  (18, 18, '140g', 'Peito de frango pós-treino'),
  (19, 19, '200g', 'Ovo cozido no café da manhã'),
  (20, 20, '150g', 'Frango assado no jantar');



-- 6. Treino, treino_exercicio e historico_treino
-- 6.1. treino (continuação dos 20 inserts)
INSERT INTO treino (tipo, horario, descricao, funcionario_id) VALUES
  ('Hipertrofia', '09:00:00', 'Treino de membros inferiores', 4),
  ('Funcional', '17:00:00', 'Circuito funcional', 5),
  ('Cardio', '07:30:00', 'Bicicleta ergométrica', 6),
  ('Força', '19:00:00', 'Treino de costas', 7),
  ('Resistência', '08:30:00', 'Treino de resistência muscular', 8),
  ('Cardio', '18:30:00', 'Corrida intervalada', 9),
  ('Funcional', '10:00:00', 'Treino funcional avançado', 10),
  ('Hipertrofia', '20:00:00', 'Treino de braços', 11),
  ('Força', '06:30:00', 'Treino de pernas', 12),
  ('Cardio', '17:30:00', 'Elíptico', 13),
  ('Resistência', '09:30:00', 'Treino de core', 14),
  ('Funcional', '19:30:00', 'Circuito funcional intermediário', 15),
  ('Hipertrofia', '08:00:00', 'Treino de peitoral', 16),
  ('Força', '18:00:00', 'Treino de ombros', 17),
  ('Cardio', '07:00:00', 'Corrida longa', 18),
  ('Resistência', '20:30:00', 'Treino de resistência avançado', 19),
  ('Funcional', '10:30:00', 'Circuito funcional básico', 20);
  INSERT INTO treino (tipo, horario, descricao, funcionario_id) VALUES
  ('Força', '08:00:00', 'Treino de força peitoral', 1),
  ('Cardio','18:00:00', 'Corrida na esteira',      2),
  ('Resistência','10:00:00', 'Circuito full body',   3);

-- 6.2. treino_exercicio (continuação dos 20 inserts)
INSERT INTO treino_exercicio (treino_id, exercicio_id, series, repeticoes, carga, intervalo_segundos) VALUES
  (4, 4, 4, 12, 70.00, 60),
  (5, 5, 3, 15, NULL, 45),
  (6, 6, 5, 10, 50.00, 90),
  (7, 7, 4, 8, 80.00, 120),
  (8, 8, 3, 20, NULL, 30),
  (9, 9, 4, 10, 60.00, 60),
  (10, 10, 5, 12, 40.00, 75),
  (11, 11, 3, 15, NULL, 45),
  (12, 12, 4, 10, 55.00, 60),
  (13, 13, 5, 8, 90.00, 120),
  (14, 14, 3, 20, NULL, 30),
  (15, 15, 4, 12, 65.00, 60),
  (16, 16, 5, 10, 45.00, 90),
  (17, 17, 4, 8, 85.00, 120),
  (18, 1, 3, 15, NULL, 45),
  (19, 2, 4, 10, 75.00, 60),
  (20, 3, 5, 8, 95.00, 120);
  -- 6.2. treino_exercicio
INSERT INTO treino_exercicio (treino_id, exercicio_id, series, repeticoes, carga, intervalo_segundos) VALUES
  (1, 1, 4, 10, 60.00, 60),
  (2, 3, 3, 15, NULL, 30),
  (3, 2, 5, 12, 80.00, 90);

-- 6.3. historico_treino (continuação dos 20 inserts)
INSERT INTO historico_treino (usuario_id, treino_id, data_execucao, observacoes) VALUES
  (4, 4, '2025-04-13 09:00:00', 'Treino intenso'),
  (5, 5, '2025-04-14 17:00:00', 'Circuito completo'),
  (6, 6, '2025-04-15 07:30:00', 'Boa performance'),
  (7, 7, '2025-04-16 19:00:00', 'Aumentar carga próxima vez'),
  (8, 8, '2025-04-17 08:30:00', 'Resistência melhorando'),
  (9, 9, '2025-04-18 18:30:00', 'Corrida rápida'),
  (10, 10, '2025-04-19 10:00:00', 'Treino funcional avançado'),
  (11, 11, '2025-04-20 20:00:00', 'Braços fadigados'),
  (12, 12, '2025-04-21 06:30:00', 'Treino de pernas completo'),
  (13, 13, '2025-04-22 17:30:00', 'Elíptico 40min'),
  (14, 14, '2025-04-23 09:30:00', 'Core fortalecido'),
  (15, 15, '2025-04-24 19:30:00', 'Circuito intermediário'),
  (16, 16, '2025-04-25 08:00:00', 'Peitoral evoluindo'),
  (17, 17, '2025-04-26 18:00:00', 'Ombros cansados'),
  (18, 18, '2025-04-27 07:00:00', 'Corrida longa concluída'),
  (19, 19, '2025-04-28 20:30:00', 'Resistência avançada'),
  (20, 20, '2025-04-29 10:30:00', 'Circuito básico realizado');
-- 6.1. treino




-- 6.3. historico_treino
INSERT INTO historico_treino (usuario_id, treino_id, data_execucao, observacoes) VALUES
  (1, 1, '2025-04-10 08:00:00', 'Sem observações'),
  (2, 2, '2025-04-11 18:00:00', 'Melhor tempo'),
  (3, 3, '2025-04-12 10:00:00', 'Fadiga alta');

-- 7. Forum, resposta_forum
-- 7.1. forum (continuação dos 20 inserts)
INSERT INTO forum (titulo, descricao, usuario_id) VALUES
  ('Dúvida sobre agachamento', 'Qual a postura correta?', 4),
  ('Suplementação', 'Creatina é segura?', 5),
  ('Lesão no ombro', 'Como evitar?', 6),
  ('Treino funcional', 'Sugestões de exercícios?', 7),
  ('Cardio em jejum', 'Vale a pena?', 8),
  ('Dieta flexível', 'Como montar?', 9),
  ('Equipamento para casa', 'O que comprar?', 10),
  ('Treino para iniciantes', 'Por onde começar?', 11),
  ('Alongamento', 'Antes ou depois do treino?', 12),
  ('Avaliação física', 'Qual a frequência ideal?', 13),
  ('Treino HIIT', 'Resultados reais?', 14),
  ('Nutrição esportiva', 'Dicas de pré-treino?', 15),
  ('Treino de core', 'Exercícios recomendados?', 16),
  ('Recuperação muscular', 'Como acelerar?', 17),
  ('Treino de resistência', 'Como evoluir?', 18),
  ('Treino em grupo', 'Vantagens?', 19),
  ('Treino outdoor', 'Precauções?', 20);
  INSERT INTO forum (titulo, descricao, usuario_id) VALUES
  ('Dúvida Treino Peitoral', 'Como evoluir no supino?', 1),
  ('Nutrição Pós-Treino',    'O que comer após o treino?', 2),
  ('Equipamentos',           'Qual melhor barra?', 3);


-- 7.2. resposta_forum (continuação dos 20 inserts)
INSERT INTO resposta_forum (mensagem, usuario_id, forum_id) VALUES
  ('Mantenha a coluna neutra.', 5, 4),
  ('Sim, creatina é segura para a maioria.', 6, 5),
  ('Fortaleça o manguito rotador.', 7, 6),
  ('Use cones e cordas para circuitos.', 8, 7),
  ('Pode ajudar na queima de gordura.', 9, 8),
  ('Calcule macros e ajuste conforme objetivo.', 10, 9),
  ('Halteres e elásticos são ótimos.', 11, 10),
  ('Comece com treinos leves e progressivos.', 12, 11),
  ('Alongue após o treino para melhor recuperação.', 13, 12),
  ('A cada 3 meses é recomendado.', 14, 13),
  ('HIIT traz resultados rápidos, mas exige cuidado.', 15, 14),
  ('Banana e aveia são boas opções.', 16, 15),
  ('Prancha e abdominal são essenciais.', 17, 16),
  ('Durma bem e hidrate-se.', 18, 17),
  ('Aumente gradualmente o volume.', 19, 18),
  ('Motiva e melhora desempenho.', 20, 19),
  ('Use protetor solar e hidrate-se.', 4, 20);
-- 7.1. forum

-- 7.2. resposta_forum
INSERT INTO resposta_forum (mensagem, usuario_id, forum_id) VALUES
  ('Tente aumentar 2kg por semana.', 2, 1),
  ('Carboidrato e proteína juntos.', 3, 2),
  ('Barra olímpica convencional.', 1, 3);





-- 9. Pagamento e pagamento_detalhe
INSERT INTO `gym_genesis`.`pagamento` 
(`valor`, `data_pagamento`, `metodo`, `status`)
VALUES
  (70.00, '2025-04-18 09:30:00', 'cartao', 'sucesso'),
  (1000.00, '2025-04-18 09:35:00', 'pix', 'sucesso'),
  (120.00, '2025-04-19 16:00:00', 'boleto', 'sucesso'),
  (120.00, '2025-04-19 16:05:00', 'cartao', 'falha'),
  (120.00, '2025-04-20 18:00:00', 'pix', 'sucesso'),
  (40.00, '2025-04-20 18:05:00', 'boleto', 'sucesso'),
  (35.00, '2025-04-21 11:10:00', 'cartao', 'sucesso'),
  (25.00, '2025-04-21 11:15:00', 'pix', 'sucesso'),
  (180.00, '2025-04-22 13:30:00', 'boleto', 'sucesso'),
  (60.00, '2025-04-22 13:35:00', 'cartao', 'sucesso'),
  (8.00, '2025-04-23 16:30:00', 'pix', 'sucesso'),
  (85.00, '2025-04-23 16:35:00', 'boleto', 'sucesso'),
  (30.00, '2025-04-24 18:30:00', 'cartao', 'sucesso'),
  (15.00, '2025-04-24 18:35:00', 'pix', 'sucesso'),
  (120.00, '2025-04-25 10:50:00', 'boleto', 'sucesso'),
  (150.00, '2025-04-25 10:55:00', 'cartao', 'sucesso'),
  (80.00, '2025-04-26 13:00:00', 'pix', 'sucesso'),
  (30.00, '2025-04-26 13:05:00', 'boleto', 'sucesso');
  INSERT INTO `gym_genesis`.`pagamento` 
(`valor`, `data_pagamento`, `metodo`, `status`)
VALUES
  (150.00, '2025-04-20 10:00:00', 'cartao', 'sucesso'),
  (200.00, '2025-04-21 11:30:00', 'pix', 'sucesso'),
  (50.00, '2025-04-22 14:00:00', 'boleto', 'falha');


INSERT INTO `gym_genesis`.`pagamento_detalhe` 
(`tipo`, `bandeira_cartao`, `ultimos_digitos`, `codigo_pix`, `linha_digitavel_boleto`, `pagamento_id`)
VALUES
  ('cartao', 'Mastercard', '5678', NULL, NULL, 4),
  ('pix', NULL, NULL, 'pix-codigo-xyz001', NULL, 5),
  ('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000012000', 6),
  ('cartao', 'Visa', '4321', NULL, NULL, 7),
  ('pix', NULL, NULL, 'pix-codigo-xyz002', NULL, 8),
  ('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000004000', 9),
  ('cartao', 'Elo', '8765', NULL, NULL, 10),
  ('pix', NULL, NULL, 'pix-codigo-xyz003', NULL, 11),
  ('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000018000', 12),
  ('cartao', 'Mastercard', '3456', NULL, NULL, 13),
  ('pix', NULL, NULL, 'pix-codigo-xyz004', NULL, 14),
  ('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000008500', 15),
  ('cartao', 'Visa', '6543', NULL, NULL, 16),
  ('pix', NULL, NULL, 'pix-codigo-xyz005', NULL, 17),
  ('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000012000', 18),
  ('cartao', 'Elo', '7890', NULL, NULL, 19),
  ('pix', NULL, NULL, 'pix-codigo-xyz006', NULL, 20),
  ('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000008000', 1),
  ('cartao', 'Mastercard', '0987', NULL, NULL, 2),
  ('pix', NULL, NULL, 'pix-codigo-xyz007', NULL, 3);


-- 9.2. pagamento_detalhe
INSERT INTO `gym_genesis`.`pagamento_detalhe` 
(`tipo`, `bandeira_cartao`, `ultimos_digitos`, `codigo_pix`, `linha_digitavel_boleto`, `pagamento_id`)
VALUES
  ('cartao', 'Visa', '1234', NULL, NULL, 1),
  ('pix', NULL, NULL, 'pix-codigo-xyz987', NULL, 2),
  ('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000005000', 3);
  



-- 8. Pedido, item_pedido
INSERT INTO `gym_genesis`.`pedido` 
(`usuario_id`, `data_pedido`, `status`, `pagamento_id`)
VALUES
  (4, '2025-04-18 09:00:00', 'processando', 4),
  (5, '2025-04-19 15:30:00', 'enviado', 5),
  (6, '2025-04-20 17:45:00', 'concluído', 6),
  (7, '2025-04-21 11:00:00', 'processando', 7),
  (8, '2025-04-22 13:15:00', 'enviado', 8),
  (9, '2025-04-23 16:20:00', 'concluído', 9),
  (10, '2025-04-24 18:10:00', 'processando', 10),
  (11, '2025-04-25 10:40:00', 'enviado', 11),
  (12, '2025-04-26 12:55:00', 'concluído', 12),
  (13, '2025-04-27 14:30:00', 'processando', 13),
  (14, '2025-04-28 16:45:00', 'enviado', 14),
  (15, '2025-04-29 19:00:00', 'concluído', 15),
  (16, '2025-04-30 08:20:00', 'processando', 16),
  (17, '2025-05-01 09:35:00', 'enviado', 17),
  (18, '2025-05-02 11:50:00', 'concluído', 18),
  (19, '2025-05-03 13:05:00', 'processando', 19),
  (20, '2025-05-04 15:20:00', 'enviado', 20);
  -- 8.1. pedido
INSERT INTO `gym_genesis`.`pedido` 
(`usuario_id`, `data_pedido`, `status`, `pagamento_id`)
VALUES
  (1, '2025-04-15 14:00:00', 'processando', 1),
  (2, '2025-04-16 10:30:00', 'enviado', 2),
  (3, '2025-04-17 18:45:00', 'concluído', 3);

INSERT INTO `gym_genesis`.`item_pedido` 
(`pedido_id`, `produto_id`, `quantidade`, `preco_unitario`)
VALUES
  (4, 4, 1, 70.00),
  (4, 5, 2, 500.00),
  (5, 6, 3, 40.00),
  (5, 7, 1, 35.00),
  (6, 8, 2, 25.00),
  (6, 9, 1, 20.00),
  (7, 10, 1, 180.00),
  (7, 11, 2, 60.00),
  (8, 12, 4, 8.00),
  (8, 13, 2, 6.00),
  (9, 14, 1, 85.00),
  (9, 15, 3, 30.00),
  (10, 16, 2, 15.00),
  (10, 17, 1, 120.00),
  (11, 1, 1, 150.00),
  (11, 2, 2, 80.00),
  (12, 3, 1, 30.00),
  (12, 4, 2, 70.00),
  (13, 5, 1, 500.00),
  (13, 6, 3, 40.00),
  (14, 7, 2, 35.00),
  (14, 8, 1, 25.00),
  (15, 9, 2, 20.00),
  (15, 10, 1, 180.00),
  (16, 11, 1, 60.00),
  (16, 12, 2, 8.00),
  (17, 13, 1, 6.00),
  (17, 14, 2, 85.00),
  (18, 15, 1, 30.00),
  (18, 16, 3, 15.00),
  (19, 17, 2, 120.00),
  (19, 1, 1, 150.00),
  (20, 2, 2, 80.00),
  (20, 3, 1, 30.00);
  -- 8.2. item_pedido
INSERT INTO `gym_genesis`.`item_pedido` 
(`pedido_id`, `produto_id`, `quantidade`, `preco_unitario`)
VALUES
  (1, 1, 2, 50.00),  -- Produto 1, 2 unidades, preço unitário 50
  (2, 3, 1, 100.00), -- Produto 3, 1 unidade, preço unitário 100
  (3, 2, 4, 25.00);  -- Produto 2, 4 unidades, preço unitário 25

-- 9. Pagamento e pagamento_detalhe

-- 9.1. pagamento


-- 10. Avaliacao fisica e Aula agendada
-- 10.1. avaliacao_fisica (continuação dos 20 inserts)
INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_id) VALUES
  (72.000, 1.78, 22.72, 16.00, '2025-04-04', 4),
  (68.500, 1.70, 23.72, 17.50, '2025-04-05', 5),
  (90.200, 1.85, 26.36, 21.00, '2025-04-06', 6),
  (65.800, 1.68, 23.32, 14.50, '2025-04-07', 7),
  (74.300, 1.80, 22.93, 18.00, '2025-04-08', 8),
  (82.700, 1.82, 24.98, 19.00, '2025-04-09', 9),
  (59.900, 1.62, 22.83, 15.00, '2025-04-10', 10),
  (77.400, 1.76, 24.99, 20.00, '2025-04-11', 11),
  (63.200, 1.65, 23.22, 16.50, '2025-04-12', 12),
  (88.600, 1.90, 24.52, 22.00, '2025-04-13', 13),
  (70.800, 1.75, 23.12, 17.00, '2025-04-14', 14),
  (79.900, 1.80, 24.65, 19.50, '2025-04-15', 15),
  (61.500, 1.60, 24.06, 18.00, '2025-04-16', 16),
  (85.300, 1.88, 24.13, 20.00, '2025-04-17', 17),
  (73.700, 1.77, 23.52, 16.00, '2025-04-18', 18),
  (67.900, 1.72, 22.93, 15.50, '2025-04-19', 19),
  (80.500, 1.85, 23.52, 18.50, '2025-04-20', 20);
  -- 10.1. avaliacao_fisica
INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_id) VALUES
  (70.500, 1.75, 23.02, 15.00, '2025-04-01', 1),
  (85.000, 1.80, 26.23, 20.00, '2025-04-02', 2),
  (60.300, 1.65, 22.04, 18.00, '2025-04-03', 3);

-- 10.2. aula_agendada (continuação dos 20 inserts)
INSERT INTO `gym_genesis`.`aula_agendada` 
(`data_aula`, `dia_semana`, `hora_inicio`, `hora_fim`, `treino_id`, `funcionario_id`) 
VALUES 
('2025-05-01', 'Quinta', '09:00:00', '10:00:00', 4, 1),
('2025-05-02', 'Sexta', '17:00:00', '18:00:00', 5, 2),
('2025-05-03', 'Sábado', '07:30:00', '08:30:00', 6, 3),
('2025-05-04', 'Domingo', '19:00:00', '20:00:00', 7, 4),
('2025-05-05', 'Segunda', '08:30:00', '09:30:00', 8, 5),
('2025-05-06', 'Terça', '18:30:00', '19:30:00', 9, 6),
('2025-05-07', 'Quarta', '10:00:00', '11:00:00', 10, 7),
('2025-05-08', 'Quinta', '20:00:00', '21:00:00', 11, 8),
('2025-05-09', 'Sexta', '06:30:00', '07:30:00', 12, 9),
('2025-05-10', 'Sábado', '17:30:00', '18:30:00', 13, 10),
('2025-05-11', 'Domingo', '09:30:00', '10:30:00', 14, 11),
('2025-05-12', 'Segunda', '19:30:00', '20:30:00', 15, 12),
('2025-05-13', 'Terça', '08:00:00', '09:00:00', 16, 13),
('2025-05-14', 'Quarta', '18:00:00', '19:00:00', 17, 14),
('2025-05-15', 'Quinta', '07:00:00', '08:00:00', 18, 15),
('2025-05-16', 'Sexta', '20:30:00', '21:30:00', 19, 16),
('2025-05-17', 'Sábado', '10:30:00', '11:30:00', 20, 17);
-- 10.2. aula_agendada





-- 11. Meta usuario
INSERT INTO meta_usuario (usuario_id, descricao, data_inicio, data_limite, status) VALUES
  (4, 'Ganhar 3kg de massa muscular', '2025-04-01', '2025-07-01', 'ativa'),
  (5, 'Reduzir percentual de gordura para 15%', '2025-04-01', '2025-08-01', 'ativa'),
  (6, 'Fazer 10 pull-ups seguidos', '2025-04-01', '2025-09-01', 'ativa'),
  (7, 'Participar de uma corrida de 10km', '2025-04-01', '2025-10-01', 'ativa'),
  (8, 'Melhorar flexibilidade', '2025-04-01', '2025-07-15', 'ativa'),
  (9, 'Manter dieta por 60 dias', '2025-04-01', '2025-06-01', 'ativa'),
  (10, 'Aumentar carga no agachamento', '2025-04-01', '2025-07-01', 'ativa'),
  (11, 'Reduzir IMC para 22', '2025-04-01', '2025-08-01', 'ativa'),
  (12, 'Fazer 5km de bicicleta em 15min', '2025-04-01', '2025-09-01', 'ativa'),
  (13, 'Treinar 5x por semana', '2025-04-01', '2025-07-01', 'ativa'),
  (14, 'Atingir 80kg de peso', '2025-04-01', '2025-08-01', 'ativa'),
  (15, 'Completar circuito funcional', '2025-04-01', '2025-09-01', 'ativa'),
  (16, 'Reduzir gordura abdominal', '2025-04-01', '2025-10-01', 'ativa'),
  (17, 'Melhorar postura', '2025-04-01', '2025-07-15', 'ativa'),
  (18, 'Fazer 20 flexões seguidas', '2025-04-01', '2025-06-01', 'ativa'),
  (19, 'Aumentar resistência cardiovascular', '2025-04-01', '2025-07-01', 'ativa'),
  (20, 'Manter rotina de treinos por 90 dias', '2025-04-01', '2025-08-01', 'ativa');


INSERT INTO meta_usuario (usuario_id, descricao, data_inicio, data_limite, status) VALUES
  (1, 'Perder 5kg em 3 meses', '2025-04-01', '2025-07-01', 'ativa'),
  (2, 'Correr 5km em 30min',   '2025-04-01', '2025-06-01', 'ativa'),
  (3, 'Aumentar força no supino','2025-04-01','2025-07-01', 'ativa');





-- 12. Recuperação de senha
INSERT INTO `gym_genesis`.`recuperacao_senha` (`codigo`, `usuario_id`, `tempo_expiracao`)
VALUES ('J1K2L3', 4, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('M4N5O6', 5, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('P7Q8R9', 6, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('S1T2U3', 7, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('V4W5X6', 8, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('Y7Z8A9', 9, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('B1C2D3', 10, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('E4F5G6', 11, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('H7I8J9', 12, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('K1L2M3', 13, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('N4O5P6', 14, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('Q7R8S9', 15, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('T1U2V3', 16, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('W4X5Y6', 17, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('Z7A8B9', 18, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('C1D2E3', 19, DATE_ADD(NOW(), INTERVAL 1 HOUR)),
  ('F4G5H6', 20, DATE_ADD(NOW(), INTERVAL 1 HOUR));





INSERT INTO `gym_genesis`.`assinatura` 
(`data_inicio`, `data_fim`, `usuario_id`, `plano_id`)
VALUES 
('2025-08-25', '2025-09-21', 21, 2);

INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_id) VALUES
  (70.400, 1.75, 22.98, 15.2, '2025-04-11', 21),
  (72.800, 1.76, 23.51, 16.0, '2025-04-18', 21),
  (74.600, 1.77, 23.79, 16.8, '2025-04-25', 21),
  (75.300, 1.78, 23.76, 17.3, '2025-05-02', 21),
  (76.100, 1.78, 21.01, 17.9, '2025-05-09', 21),
  (77.400, 1.78, 21.43, 18.5, '2025-05-16', 21),
  (78.900, 1.78, 21.89, 19.1, '2025-05-23', 21),
  (80.200, 1.78, 25.30, 19.6, '2025-05-30', 21),
  (81.500, 1.78, 25.72, 20.2, '2025-06-06', 21),
  (82.800, 1.78, 26.14, 20.7, '2025-06-13', 21);


INSERT INTO meta_usuario (usuario_id, descricao, data_inicio, data_limite, status) VALUES
  (21, 'Ganhar 3kg de massa muscular', '2025-04-01', '2025-07-01', 'ativa'),
  (21, 'Reduzir percentual de gordura para 15%', '2025-04-01', '2025-08-01', 'ativa'),
  (21, 'Fazer 10 pull-ups seguidos', '2025-04-01', '2025-09-01', 'ativa'),
  (21, 'Participar de uma corrida de 10km', '2025-04-01', '2025-10-01', 'ativa'),
  (21, 'Melhorar flexibilidade', '2025-04-01', '2025-07-15', 'ativa'),
  (21, 'Manter dieta por 60 dias', '2025-04-01', '2025-06-01', 'ativa'),
  (21, 'Aumentar carga no agachamento', '2025-04-01', '2025-07-01', 'ativa'),
  (21, 'Reduzir IMC para 22', '2025-04-01', '2025-08-01', 'ativa'),
  (21, 'Fazer 5km de bicicleta em 15min', '2025-04-01', '2025-09-01', 'ativa'),
  (21, 'Treinar 5x por semana', '2025-04-01', '2025-07-01', 'ativa');

  INSERT INTO treino (tipo, horario, descricao, funcionario_id) VALUES
  ('Hipertrofia', '09:00:00', 'Treino de membros inferiores', 1),
  ('Funcional', '17:00:00', 'Circuito funcional', 1),
  ('Cardio', '07:30:00', 'Bicicleta ergométrica', 1),
  ('Força', '19:00:00', 'Treino de costas', 1),
  ('Resistência', '08:30:00', 'Treino de resistência muscular', 1),
  ('Cardio', '18:30:00', 'Corrida intervalada', 1),
  ('Funcional', '10:00:00', 'Treino funcional avançado', 1),
  ('Hipertrofia', '20:00:00', 'Treino de braços', 1),
  ('Força', '06:30:00', 'Treino de pernas', 1),
  ('Cardio', '17:30:00', 'Elíptico', 1);

  INSERT INTO treino_exercicio (treino_id, exercicio_id, series, repeticoes, carga, intervalo_segundos) VALUES
  (21, 1, 4, 12, 60.00, 60),
  (22, 2, 3, 15, NULL, 45),
  (23, 3, 5, 10, 50.00, 90),
  (24, 4, 4, 8, 70.00, 120),
  (25, 5, 3, 20, NULL, 30),
  (26, 6, 4, 10, 55.00, 60),
  (27, 7, 5, 12, 40.00, 75),
  (28, 8, 3, 15, NULL, 45),
  (29, 9, 4, 10, 65.00, 60),
  (30, 10, 5, 8, 85.00, 120);

INSERT INTO `gym_genesis`.`aula_agendada` (`data_aula`, `dia_semana`, `hora_inicio`, `hora_fim`, `treino_id`, `funcionario_id`) VALUES 
('2025-05-18', 'Domingo', '08:00:00', '09:00:00', 10, 1),
('2025-05-19', 'Segunda', '17:30:00', '18:30:00', 10, 1),
('2025-05-20', 'Terça', '07:00:00', '08:00:00', 10, 1),
('2025-05-21', 'Quarta', '19:00:00', '20:00:00', 10, 1),
('2025-05-22', 'Quinta', '09:30:00', '10:30:00', 10, 1),
('2025-05-23', 'Sexta', '06:00:00', '07:00:00', 10, 1),
('2025-05-10', 'Sábado', '16:00:00', '17:00:00', 10, 1),
('2025-05-25', 'Domingo', '10:00:00', '11:00:00', 10, 1),
('2025-05-26', 'Segunda', '18:30:00', '19:30:00', 10, 1),
('2025-05-27', 'Terça', '07:30:00', '08:30:00', 10, 1);

INSERT INTO historico_peso (peso, data_registro, usuario_id) VALUES
  (78.50, '2025-08-01 08:00:00', 21),
  (77.80, '2025-08-15 08:00:00', 21),
  (85.20, '2025-08-01 09:00:00', 21),
  (84.90, '2025-08-15 09:00:00', 21),
  (92.00, '2025-08-01 10:00:00', 21),
  (91.50, '2025-08-15 10:00:00', 21),
  (70.00, '2025-08-01 07:30:00', 21),
  (69.80, '2025-08-15 07:30:00', 21),
  (68.00, '2025-08-01 08:15:00', 21),
  (67.50, '2025-08-15 08:15:00', 21),
  (80.00, '2025-08-01 09:45:00', 21),
  (79.60, '2025-08-15 09:45:00', 21),
  (75.00, '2025-08-01 10:30:00', 21),
  (74.80, '2025-08-15 10:30:00', 21),
  (82.00, '2025-08-01 11:00:00', 21),
  (81.70, '2025-08-15 11:00:00', 21),
  (90.00, '2025-08-01 11:30:00', 21),
  (89.50, '2025-08-15 11:30:00', 21),
  (65.00, '2025-08-01 12:00:00', 21),
  (64.80, '2025-08-15 12:00:00', 21);
INSERT INTO `gym_genesis`.`dicas_nutricionais` 
(titulos, descricao, icone, cor) 
VALUES
('Proteínas pós-treino', 'Consumir proteínas logo após o treino ajuda na recuperação.', 'fas fa-apple-alt', 'green-400'),
('Hidratação', 'Beber água antes, durante e após o treino é essencial.', 'fas fa-tint', 'blue-400'),
('Carboidratos pré-treino', 'Comer carboidratos leves antes do treino dá energia rápida.', 'fas fa-bread-slice', 'yellow-400'),
('Sono e recuperação', 'Dormir bem é fundamental para recuperação muscular.', 'fas fa-bed', 'purple-400'),
('Frutas e fibras', 'Frutas ricas em fibras ajudam na digestão e saciedade.', 'fas fa-lemon', 'orange-400'),
('Alongamento', 'Alongar antes e depois do treino reduz risco de lesões.', 'fas fa-walking', 'pink-400'),
('Treino de força', 'Exercícios de força aumentam massa magra e metabolismo.', 'fas fa-dumbbell', 'red-400'),
('Vitaminas', 'Vitamina C e D fortalecem o sistema imunológico.', 'fas fa-capsules', 'teal-400'),
('Postura', 'Manter a postura correta evita dores e lesões.', 'fas fa-child', 'indigo-400'),
('Descanso ativo', 'Dias de descanso podem incluir caminhadas leves.', 'fas fa-shoe-prints', 'gray-400'),
('Ômega 3', 'Consuma peixes ou sementes para saúde cardiovascular.', 'fas fa-fish', 'blue-500'),
('Cafeína', 'Café antes do treino pode aumentar desempenho.', 'fas fa-coffee', 'brown-400'),
('Lanches saudáveis', 'Prefira castanhas e frutas secas entre refeições.', 'fas fa-seedling', 'green-500'),
('Treino funcional', 'Exercícios funcionais melhoram mobilidade.', 'fas fa-running', 'yellow-500'),
('Equilíbrio alimentar', 'Inclua todos os grupos alimentares no dia.', 'fas fa-balance-scale', 'purple-500'),
('Aquecimento', 'Aqueça o corpo antes de treinar para evitar lesões.', 'fas fa-fire', 'red-500'),
('Magnésio', 'Ajuda na contração muscular e recuperação.', 'fas fa-tablets', 'blue-300'),
('Pequenas metas', 'Definir metas pequenas ajuda a manter disciplina.', 'fas fa-flag-checkered', 'orange-500'),
('Respeite limites', 'Escute seu corpo e evite exageros no treino.', 'fas fa-heartbeat', 'pink-500'),
('Consistência', 'Resultados vêm da disciplina diária, não de excessos.', 'fas fa-calendar-check', 'green-600');

  INSERT INTO `gym_genesis`.`perfil_professor` (`usuario_id`, `foto_perfil`, `experiencia_anos`, `modalidade`, `avaliacao_media`, `descricao`, `horarios_disponiveis`, `telefone`) VALUES
(21, 'carlos_silva.jpg', 5, 'Presencial', 4.75, 'Personal trainer especializado em musculação e condicionamento físico', 'Segunda a Sexta: 6h-10h e 18h-22h', '(11) 99999-0001'),
(22, 'ana_pereira.png', 3, 'Online', 4.80, 'Especialista em treinamento funcional e pilates', 'Terça e Quinta: 7h-12h, Sábado: 8h-14h', '(11) 99999-0002'),
(23, 'pedro_alves.jpg', 7, 'Híbrido', 4.90, 'Professor de educação física com foco em emagrecimento', 'Segunda a Sexta: 5h-9h e 17h-21h', '(11) 99999-0003'),
(24, 'juliana_costa.jpg', 2, 'Presencial', 4.65, 'Especialista em treino para terceira idade', 'Segunda, Quarta, Sexta: 8h-12h', '(11) 99999-0004'),
(25, 'rafael_lima.png', 8, 'Online', 4.85, 'Coach de crossfit e alta performance', 'Terça a Sábado: 6h-15h', '(11) 99999-0005'),
(26, 'fernanda_oliveira.jpg', 4, 'Presencial', 4.70, 'Personal trainer feminino e gestante', 'Segunda a Sexta: 9h-18h', '(11) 99999-0006'),
(27, 'marcos_santos.jpg', 6, 'Híbrido', 4.88, 'Especialista em reabilitação física', 'Terça e Quinta: 14h-20h, Sábado: 9h-13h', '(11) 99999-0007'),
(28, 'patricia_rocha.png', 5, 'Online', 4.82, 'Professora de yoga e meditação', 'Segunda a Domingo: 6h-22h (agendamento)', '(11) 99999-0008'),
(29, 'rodrigo_martins.jpg', 10, 'Presencial', 4.95, 'Treinador de atletas profissionais', 'Segunda a Sexta: 5h-8h e 16h-20h', '(11) 99999-0009'),
(30, 'camila_ferreira.jpg', 3, 'Híbrido', 4.68, 'Especialista em dança fitness', 'Quarta e Sexta: 14h-19h, Sábado: 10h-16h', '(11) 99999-0010'),
(31, 'lucas_ribeiro.png', 4, 'Presencial', 4.73, 'Personal trainer para iniciantes', 'Segunda a Sexta: 11h-15h e 19h-23h', '(11) 99999-0011'),
(32, 'tatiane_souza.jpg', 7, 'Online', 4.87, 'Especialista em nutrição esportiva e treino', 'Terça a Sexta: 8h-17h', '(11) 99999-0012'),
(33, 'bruno_carvalho.jpg', 2, 'Presencial', 4.60, 'Professor de artes marciais e defesa pessoal', 'Segunda, Quarta, Sexta: 18h-22h', '(11) 99999-0013'),
(34, 'vanessa_lima.png', 5, 'Híbrido', 4.78, 'Especialista em pilates e alongamento', 'Terça e Quinta: 9h-16h, Sábado: 8h-12h', '(11) 99999-0014'),
(35, 'diegonascimento.jpg', 9, 'Presencial', 4.92, 'Treinador de alto rendimento', 'Segunda a Sábado: 5h-10h e 16h-21h', '(11) 99999-0015'),
(36, 'amanda_costa.jpg', 3, 'Online', 4.71, 'Personal trainer para mulheres', 'Segunda a Sexta: 10h-15h e 19h-22h', '(11) 99999-0016'),
(37, 'thiago_oliveira.png', 6, 'Presencial', 4.84, 'Especialista em musculação e hipertrofia', 'Terça a Sexta: 6h-12h e 17h-21h', '(11) 99999-0017'),
(38, 'carolina_silva.jpg', 4, 'Híbrido', 4.76, 'Professora de hidroginástica e natação', 'Segunda, Quarta, Sexta: 7h-13h', '(11) 99999-0018'),
(39, 'gustavo_rocha.png', 8, 'Online', 4.89, 'Coach de emagrecimento e transformação corporal', 'Terça a Domingo: 6h-23h', '(11) 99999-0019'),
(40, 'isabela_martins.jpg', 5, 'Presencial', 4.81, 'Especialista em treino funcional outdoor', 'Segunda a Sexta: 6h-9h e 17h-20h', '(11) 99999-0020');

INSERT INTO aula_usuario (idaula, usuario_id) VALUES (1, 1);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (1, 2);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (2, 1);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (2, 3);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (3, 2);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (3, 4);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (4, 5);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (4, 1);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (5, 6);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (5, 2);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (6, 7);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (6, 3);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (7, 8);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (7, 4);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (8, 9);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (8, 5);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (9, 10);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (9, 6);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (10, 7);
INSERT INTO aula_usuario (idaula, usuario_id) VALUES (10, 8);
