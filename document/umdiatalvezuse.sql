-- Inserts para o schema `gym_genesis`
-- 3 registros por tabela, respeitando ordem de dependências
use gym_genesis;
-- 1. Tabelas independentes
-- 1.2. cargo (já existe 3, adicionando mais 17)
INSERT INTO cargo (nome, descricao) VALUES
  ('Instrutor', 'Responsável por orientar os alunos'),
  ('Nutricionista', 'Especialista em nutrição'),
  ('Personal Trainer', 'Treinamento personalizado'),
  ('Recepcionista', 'Atendimento na recepção'),
  ('Limpeza', 'Serviços de limpeza'),
  ('Manutenção', 'Cuidados com equipamentos'),
  ('Supervisor', 'Supervisão de setores'),
  ('Estagiário', 'Apoio em diversas áreas'),
  ('Consultor', 'Consultoria especializada'),
  ('Diretor', 'Direção geral'),
  ('Financeiro', 'Gestão financeira'),
  ('Marketing', 'Promoção e divulgação'),
  ('TI', 'Tecnologia da informação'),
  ('Fisioterapeuta', 'Reabilitação física'),
  ('Psicólogo', 'Apoio psicológico'),
  ('Administrador', 'Gestão administrativa'),
  ('Atendente', 'Atendimento ao cliente');

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
-- 2.1. usuario (20 inserts)
INSERT INTO usuario (nome, senha, email, cpf, data_de_nascimento, telefone, foto_de_perfil, numero_matricula, tipo_usuario) VALUES
('Lucas Oliveira', 'senha4', 'lucas2@ex.com', '11122233344', '1991-03-15', '11911112222', 'padrao.png', 'MAT1004', 1),
('Rafael Souza', 'senha6', 'rafae23l@ex.com', '33344455566', '1995-06-25', '11933334444', 'padrao.png', 'MAT1006', 1),
('Gabriel Martins', 'senha8', 'gabriel@ex.com', '55566677788', '1990-01-20', '11955556666', 'padrao.png', 'MAT1008', 1),
('Rodrigo Melo', 'senha10', 'rodrigo@ex.com', '77788899900', '1992-07-05', '11977778888', 'padrao.png', 'MAT1010', 1),
('Thiago Fernandes', 'senha12', 'thiago@ex.com', '99900011122', '1989-02-28', '11999990011', 'padrao.png', 'MAT1012', 1),
('Vinicius Rocha', 'senha14', 'vinicius@ex.com', '11122233355', '1993-12-03', '11911112223', 'padrao.png', 'MAT1014', 1),
('Felipe Barros', 'senha16', 'felipe@ex.com', '33344455577', '1988-09-27', '11933334445', 'padrao.png', 'MAT1016', 1),
('Bruno Teixeira', 'senha18', 'brunot@ex.com', '55566677799', '1992-06-06', '11955556667', 'padrao.png', 'MAT1018', 1),
('Diego Cardoso', 'senha20', 'diego@ex.com', '77788899911', '1987-07-09', '11977778889', 'padrao.png', 'MAT1020', 1),
('Pedro Henrique', 'senha22', 'pedro@ex.com', '99900011133', '1991-11-02', '11999990012', 'padrao.png', 'MAT1022', 1),
('Carlos Souza', 'senha24', 'carlos2@ex.com', '11133344477', '1994-02-10', '11911123334', 'padrao.png', 'MAT1024', 1),
('João Mendes', 'senha25', 'joao@ex.com', '22244455588', '1992-12-22', '11922234445', 'padrao.png', 'MAT1025', 1),
('Marcelo Silva', 'senha26', 'marcelo@ex.com', '33355566699', '1993-04-11', '11933345556', 'padrao.png', 'MAT1026', 1),
('Lucas Santos', 'senha27', 'lucas2.santos@ex.com', '44466677700', '1990-09-18', '11944456667', 'padrao.png', 'MAT1027', 1),
('Ricardo Lima', 'senha28', 'ricardo@ex.com', '55577788811', '1988-05-21', '11955567778', 'padrao.png', 'MAT1028', 1),
('André Costa', 'senha29', 'andre@ex.com', '66688899922', '1992-02-09', '11966678889', 'padrao.png', 'MAT1029', 1),
('Fernando Alves', 'senha30', 'fernando@ex.com', '77799900033', '1995-03-01', '11977779900', 'padrao.png', 'MAT1030', 1),
('Bruno Costa', 'senha31', 'bruno.costa@ex.com', '88800011144', '1990-06-15', '11988880011', 'padrao.png', 'MAT1031', 1),
('Mateus Oliveira', 'senha32', 'mateus@ex.com', '99911122255', '1994-11-27', '11999991122', 'padrao.png', 'MAT1032', 1),
('Gustavo Pereira', 'senha33', 'gustavo2@ex.com', '11122233366', '1991-01-17', '11911112234', 'padrao.png', 'MAT1033', 1),
('Renato Rocha', 'senha34', 'renato@ex.com', '22233344477', '1993-05-08', '11922223345', 'padrao.png', 'MAT1034', 1);

INSERT INTO usuario (nome, senha, email, cpf, data_de_nascimento, telefone, foto_de_perfil, numero_matricula, tipo_usuario) VALUES
('José Almeida', 'senha46', 'jose@ex.com', '22233344488', '1994-07-12', '11922223367', 'padrao.png', 'MAT1046', 1),
('Eduardo Costa', 'senha47', 'eduardo@ex.com', '33344455599', '1991-04-03', '11933334478', 'padrao.png', 'MAT1047', 1),
("adm", "$2y$10$G5VlwS/rmR57/w37BN93GuSUjJqABSOGALBB7/c2Mtx/u2lSMq0U6", "acabate@gmail.com", "456.498.465-12", "2025-08-19", "(62) 93228-4585", "padrao.png", "929467119175905", 1),
('Felipe Oliveira', 'senha48', 'felipe.oliveira@ex.com', '44455566600', '1993-10-15', '11944445579', 'padrao.png', 'MAT1048', 1),
('Luiz Souza', 'senha49', 'luiz@ex.com', '55566677711', '1989-02-08', '11955556680', 'padrao.png', 'MAT1049', 1),
('Rogério Barbosa', 'senha50', 'rogerio@ex.com', '66677788822', '1995-01-30', '11966667781', 'padrao.png', 'MAT1050', 1),
('Sérgio Pereira', 'senha51', 'sergio@ex.com', '77788899933', '1990-03-25', '11977778892', 'padrao.png', 'MAT1051', 1),
('Gustavo Santos', 'senha52', 'gustavo43@ex.com', '88899900044', '1993-08-16', '11988889903', 'padrao.png', 'MAT1052', 1),
('Carlos Eduardo', 'senha53', 'carlos@ex.com', '99900011177', '1991-12-04', '11999990014', 'padrao.png', 'MAT1053', 1),
('Roberto Lima', 'senha54', 'roberto@ex.com', '00011122288', '1995-02-20', '11900001115', 'padrao.png', 'MAT1054', 1),
('Vitor Costa', 'senha55', 'vitor@ex.com', '11122233300', '1992-07-29', '11911112268', 'padrao.png', 'MAT1055', 1),
('Marcos Santos', 'senha56', 'marcos.santos@ex.com', '22233344411', '1987-11-18', '11922223379', 'padrao.png', 'MAT1056', 1),
('Anderson Ribeiro', 'senha57', 'anderson@ex.com', '33344455522', '1994-04-22', '11933334480', 'padrao.png', 'MAT1057', 1),
('Mário Souza', 'senha58', 'mario@ex.com', '44455566633', '1990-01-15', '11944445591', 'padrao.png', 'MAT1058', 1),
('Douglas Lima', 'senha59', 'douglas@ex.com', '55566677744', '1992-05-10', '11955556692', 'padrao.png', 'MAT1059', 1),
('Daniel Costa', 'senha60', 'daniel@ex.com', '66677788855', '1988-09-29', '11966667793', 'padrao.png', 'MAT1060', 1);

INSERT INTO usuario (nome, senha, email, cpf, data_de_nascimento, telefone, foto_de_perfil, numero_matricula, tipo_usuario) VALUES
('Fernanda Lima', 'senha5', 'fernanda@ex.com', '22233344455', '1988-11-30', '11922223333', 'padrao.png', 'MAT1005', 2),
('Juliana Costa', 'senha7', 'juliana@ex.com', '44455566677', '1993-09-12', '11944445555', 'padrao.png', 'MAT1007', 2),
('Patricia Alves', 'senha9', 'patricia@ex.com', '66677788899', '1987-04-18', '11966667777', 'padrao.png', 'MAT1009', 2),
('Amanda Ribeiro', 'senha11', 'amanda@ex.com', '88899900011', '1994-10-22', '11988889999', 'padrao.png', 'MAT1011', 2),
('Camila Duarte', 'senha13', 'camila@ex.com', '00011122233', '1996-08-14', '11900001112', 'padrao.png', 'MAT1013', 2),
('Beatriz Gomes', 'senha15', 'beatriz@ex.com', '22233344466', '1991-05-19', '11922223334', 'padrao.png', 'MAT1015', 2),
('Larissa Pinto', 'senha17', 'larissa@ex.com', '44455566688', '1995-03-11', '11944445556', 'padrao.png', 'MAT1017', 2),
('Mariana Freitas', 'senha19', 'marianaf@ex.com', '66677788800', '1990-12-21', '11966667778', 'padrao.png', 'MAT1019', 2),
('Aline Castro', 'senha21', 'aline@ex.com', '88899900022', '1994-04-16', '11988889910', 'padrao.png', 'MAT1021', 2),
('Sofia Almeida', 'senha23', 'sofia@ex.com', '00011122244', '1996-01-29', '11900001113', 'padrao.png', 'MAT1023', 2),
('Claudia Rodrigues', 'senha35', 'claudia@ex.com', '11122233388', '1992-02-17', '11911112245', 'padrao.png', 'MAT1035', 2),
('Patrícia Costa', 'senha36', 'patricia.costa@ex.com', '22233344499', '1994-09-25', '11922223356', 'padrao.png', 'MAT1036', 2),
('Mariana Pereira', 'senha37', 'mariana.pereira@ex.com', '33344455500', '1990-08-30', '11933334467', 'padrao.png', 'MAT1037', 2),
('Vanessa Souza', 'senha38', 'vanessa@ex.com', '44455566611', '1993-07-18', '11944445568', 'padrao.png', 'MAT1038', 2),
('Tatiane Lima', 'senha39', 'tatiane@ex.com', '55566677722', '1991-03-29', '11955556679', 'padrao.png', 'MAT1039', 2),
('Verônica Barros', 'senha40', 'veronica@ex.com', '66677788833', '1987-06-13', '11966667780', 'padrao.png', 'MAT1040', 2),
('Priscila Costa', 'senha41', 'priscila@ex.com', '77788899944', '1994-10-12', '11977778891', 'padrao.png', 'MAT1041', 2),
('Sabrina Rocha', 'senha42', 'sabrina@ex.com', '88899900055', '1995-11-23', '11988889902', 'padrao.png', 'MAT1042', 2),
('Isabela Lima', 'senha43', 'isabela@ex.com', '99900011166', '1990-01-07', '11999990013', 'padrao.png', 'MAT1043', 2),
('Carla Santos', 'senha44', 'carla@ex.com', '00011122277', '1992-06-19', '11900001114', 'padrao.png', 'MAT1044', 2),
('Letícia Oliveira', 'senha45', 'leticia@ex.com', '11122233399', '1993-05-04', '11911112256', 'padrao.png', 'MAT1045', 2);

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
-- 2.1. usuario
INSERT INTO usuario (nome, senha, email, cpf, data_de_nascimento, telefone, foto_de_perfil, numero_matricula, tipo_usuario) VALUES
  ('Ana Silva',     'senha1', 'ana@ex.com',  '12345678901', '1990-05-10', '11999990000', NULL, 'MAT1001', 1),
  ('Bruno Costa',   'senha2', 'bruno@ex.com','98765432100', '1985-07-22', '11988881111', NULL, 'MAT1002', 2),
  ('Carla Pereira', 'senha3', 'carla3@ex.com','56473829100', '1992-12-01', '11977772222', NULL, 'MAT1003', 1);

-- 2.2. cupom_desconto
INSERT INTO cupom_desconto (codigo, percentual_desconto, valor_desconto, data_validade, quantidade_uso, tipo) VALUES
  ('PROMO10', 10.00, NULL, '2025-12-31', 100, 'percentual'),
  ('FIXO20', NULL, 20.00, '2025-06-30', 50, 'fixo'),
  ('PROMO5', 5.00, NULL, '2025-09-30', 200, 'percentual');

-- 3. Funcionário e endereço
-- 3.1. funcionario (continuação dos 20 inserts)
INSERT INTO funcionario (nome, email, telefone, data_contratacao, salario, cargo_id) VALUES
  ('Carlos Mendes', 'carlos@ex.com', '11666667777', '2024-02-20', 3200.00, 4),
  ('Renata Farias', 'renata@ex.com', '11777778888', '2023-09-10', 4100.00, 5),
  ('João Batista', 'joao@ex.com', '11888889999', '2025-03-05', 2800.00, 6),
  ('Simone Lopes', 'simone@ex.com', '11999990000', '2024-04-12', 3500.00, 7),
  ('Felipe Ramos', 'felipe@ex.com', '11222223333', '2023-10-18', 3700.00, 8),
  ('Patricia Nunes', 'patrician@ex.com', '11333334445', '2025-05-22', 3300.00, 9),
  ('Roberto Dias', 'roberto@ex.com', '11444445556', '2024-06-30', 2900.00, 10),
  ('Juliana Prado', 'julianap@ex.com', '11555556667', '2023-11-25', 4200.00, 11),
  ('Fernando Alves', 'fernando@ex.com', '11666667788', '2025-07-14', 3100.00, 12),
  ('Amanda Torres', 'amandat@ex.com', '11777778899', '2024-08-19', 3600.00, 13),
  ('Ricardo Lima', 'ricardo@ex.com', '11888889910', '2023-12-03', 4000.00, 14),
  ('Tatiane Souza', 'tatiane@ex.com', '11999990021', '2025-09-27', 3400.00, 15),
  ('Gustavo Pires', 'gustavo@ex.com', '11222223344', '2024-10-05', 3800.00, 16),
  ('Eliane Rocha', 'eliane@ex.com', '11333334456', '2023-01-15', 2950.00, 17),
  ('Marcelo Cunha', 'marcelo@ex.com', '11444445567', '2025-02-28', 4100.00, 18),
  ('Vanessa Martins', 'vanessa@ex.com', '11555556678', '2024-03-22', 3250.00, 19),
  ('Bruno Ferreira', 'brunof@ex.com', '11666667789', '2023-04-11', 3750.00, 20);

-- 3.1. funcionario
INSERT INTO funcionario (nome, email, telefone, data_contratacao, salario, cargo_id) VALUES
  ('Eduardo Lima', 'eduardo@ex.com', '11333334444', '2024-01-15', 3000.00, 1),
  ('Mariana Souza','mariana@ex.com','11444445555', '2023-08-01', 4500.00, 2),
  ('Paulo Rocha',  'paulo@ex.com',  '11555556666', '2025-02-10', 2500.00, 3);

-- 3.2. endereco (continuação dos 20 inserts)
INSERT INTO endereco (usuario_id, funcionario_id, cep, rua, numero, complemento, bairro, cidade, estado) VALUES
  (4, NULL, '04004000', 'Rua D', '400', 'Casa', 'Bairro Novo', 'Campinas', 'SP'),
  (NULL, 5, '05005000', 'Av. E', '500', NULL, 'Centro', 'Santos', 'SP'),
  (6, NULL, '06006000', 'Rua F', '600', 'Apto 2', 'Jardim', 'Guarulhos', 'SP'),
  (NULL, 7, '07007000', 'Av. G', '700', NULL, 'Vila', 'Sorocaba', 'SP'),
  (8, NULL, '08008000', 'Rua H', '800', 'Casa 1', 'Bairro Alto', 'Ribeirão Preto', 'SP'),
  (NULL, 9, '09009000', 'Av. I', '900', NULL, 'Centro', 'São José dos Campos', 'SP'),
  (10, NULL, '10010000', 'Rua J', '1000', 'Apto 3', 'Jardim', 'Taubaté', 'SP'),
  (NULL, 11, '11011000', 'Av. K', '1100', NULL, 'Vila', 'Barueri', 'SP'),
  (12, NULL, '12012000', 'Rua L', '1200', 'Casa', 'Bairro Novo', 'Osasco', 'SP'),
  (NULL, 13, '13013000', 'Av. M', '1300', NULL, 'Centro', 'Diadema', 'SP'),
  (14, NULL, '14014000', 'Rua N', '1400', 'Apto 4', 'Jardim', 'Carapicuíba', 'SP'),
  (NULL, 15, '15015000', 'Av. O', '1500', NULL, 'Vila', 'Mogi das Cruzes', 'SP'),
  (16, NULL, '16016000', 'Rua P', '1600', 'Casa 2', 'Bairro Alto', 'Suzano', 'SP'),
  (NULL, 17, '17017000', 'Av. Q', '1700', NULL, 'Centro', 'Itapevi', 'SP'),
  (18, NULL, '18018000', 'Rua R', '1800', 'Apto 5', 'Jardim', 'Cotia', 'SP'),
  (NULL, 19, '19019000', 'Av. S', '1900', NULL, 'Vila', 'Jandira', 'SP'),
  (20, NULL, '20020000', 'Rua T', '2000', 'Casa', 'Bairro Novo', 'Santana de Parnaíba', 'SP');
-- 3.2. endereco
INSERT INTO endereco (usuario_id, funcionario_id, cep, rua, numero, complemento, bairro, cidade, estado) VALUES
  (1, NULL, '01001000', 'Rua A', '100', "Apto 5", 'Centro', 'São Paulo', 'SP'),
  (NULL, 2, '02002000', 'Av. B',  '200', 'Apto 10', 'Jardim', 'Santa ', 'SP'),
  (NULL, 1, '03003000', 'Rua C', '300', "Apto 9", 'Vila', 'Ubatuba', 'SP');

-- 4. Assinatura e plano
-- 4.2. plano
-- Inserção de planos disponíveis
INSERT INTO `gym_genesis`.`plano` (`tipo`, `duracao`)
VALUES
('Mensal', '30 dias'),
('Trimestral', '90 dias'),
('Anual', '365 dias');
-- 4.1. assinatura (continuação dos 20 inserts)
INSERT INTO `gym_genesis`.`assinatura` 
(`data_inicio`, `data_fim`, `usuario_idusuario`, `plano_idplano`)
VALUES
('2025-05-01', '2025-06-01', 4, 1),
('2025-05-15', '2025-08-15', 5, 2),
('2025-06-10', '2026-06-10', 6, 3),
('2025-07-01', '2025-08-01', 7, 1),
('2025-07-15', '2025-10-15', 8, 2),
('2025-08-10', '2026-08-10', 9, 3),
('2025-09-01', '2025-10-01', 10, 1),
('2025-09-15', '2025-12-15', 11, 2),
('2025-10-10', '2026-10-10', 12, 3),
('2025-11-01', '2025-12-01', 13, 1),
('2025-11-15', '2026-02-15', 14, 2),
('2025-12-10', '2026-12-10', 15, 3),
('2026-01-01', '2026-02-01', 16, 1),
('2026-01-15', '2026-04-15', 17, 2),
('2026-02-10', '2027-02-10', 18, 3),
('2026-03-01', '2026-04-01', 19, 1),
('2026-03-15', '2026-06-15', 20, 2);

-- 4.1. assinatura
-- Inserção de assinaturas vinculadas a usuários e planos
INSERT INTO `gym_genesis`.`assinatura`
(`data_inicio`, `data_fim`, `usuario_idusuario`, `plano_idplano`)
VALUES
('2025-04-01', '2025-07-01', 1, 1), -- Usuário 1, Plano Mensal
('2025-03-15', '2025-06-15', 2, 2), -- Usuário 2, Plano Trimestral
('2025-04-10', '2026-04-10', 3, 3), -- Usuário 3, Plano Anual
('2025-05-01', '2025-06-01', 4, 1),
('2025-05-15', '2025-08-15', 5, 2),
('2025-06-10', '2026-06-10', 6, 3),
('2025-07-01', '2025-08-01', 7, 1),
('2025-07-15', '2025-10-15', 8, 2),
('2025-08-10', '2026-08-10', 9, 3),
('2025-09-01', '2025-10-01', 10, 1),
('2025-09-15', '2025-12-15', 11, 2),
('2025-10-10', '2026-10-10', 12, 3),
('2025-11-01', '2025-12-01', 13, 1),
('2025-11-15', '2026-02-15', 14, 2),
('2025-12-10', '2026-12-10', 15, 3),
('2026-01-01', '2026-02-01', 16, 1),
('2026-01-15', '2026-04-15', 17, 2),
('2026-02-10', '2027-02-10', 18, 3),
('2026-03-01', '2026-04-01', 19, 1),
('2026-03-15', '2026-06-15', 20, 2),
('2025-04-01', '2025-07-01', 1, 1), -- Usuário 1, Plano Mensal
('2025-03-15', '2025-06-15', 2, 2), -- Usuário 2, Plano Trimestral
('2025-04-10', '2026-04-10', 3, 3); -- Usuário 3, Plano Anual



-- 5. Dieta, refeição e dieta_alimento
-- 5. Dieta, refeição e dieta_alimento (continuação dos 20 inserts)

-- 5.1. dieta
INSERT INTO `gym_genesis`.`dieta` 
(`descricao`, `data_inicio`, `data_fim`, `usuario_idusuario`) 
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
(`descricao`, `data_inicio`, `data_fim`, `usuario_idusuario`) 
VALUES
  ('Dieta de ganho de massa', '2025-01-01', '2025-03-01', 1),
  ('Dieta de definição', '2025-02-15', NULL, 2),
  ('Dieta equilibrada', '2025-03-01', NULL, 3);

-- 5.2. refeicao
INSERT INTO `gym_genesis`.`refeicao` 
(`dieta_id`, `tipo`, `horario`) 
VALUES
  (4, 'Café da manhã', '07:30:00'),
  (5, 'Almoço', '12:15:00'),
  (6, 'Jantar', '19:30:00'),
  (7, 'Café da manhã', '16:00:00'),
  (8, 'Jantar', '22:00:00'),    -- Alterado para Jantar
  (9, 'Café da manhã', '17:30:00'),
  (10, 'Almoço', '20:00:00'),    -- Alterado para Almoço
  (11, 'Café da manhã', '08:00:00'),
  (12, 'Almoço', '13:00:00'),
  (13, 'Jantar', '20:30:00'),
  (14, 'Café da manhã', '10:00:00'),
  (15, 'Almoço', '15:30:00'),
  (16, 'Jantar', '21:30:00'),    -- Alterado para Jantar
  (17, 'Café da manhã', '18:00:00'),
  (18, 'Almoço', '21:00:00');    -- Alterado para Almoço

-- 5.2. refeicao
INSERT INTO `gym_genesis`.`refeicao` 
(`dieta_id`, `tipo`, `horario`) 
VALUES
  (1, 'Café da manhã', '07:00:00'),
  (2, 'Almoço', '12:00:00'),
  (3, 'Jantar', '19:00:00');

-- 5.3. dieta_alimentar
INSERT INTO `gym_genesis`.`dieta_alimentar` 
(`alimento_idalimento`, `refeicao_idrefeicao`, `quantidade`, `observacao`)
VALUES
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
  (18, 18, '140g', 'Peito de frango pós-treino');





-- 5.3. dieta_alimento
INSERT INTO `gym_genesis`.`dieta_alimentar` 
(`alimento_idalimento`, `refeicao_idrefeicao`, `quantidade`, `observacao`)
VALUES
(1, 1, '200g', 'Proteína para o café da manhã'),
(2, 2, '150g', 'Carboidrato para o almoço'),
(3, 3, '100g', 'Fibras para o jantar');


-- 6. Treino, treino_exercicio e historico_treino
-- 6.1. treino (continuação dos 20 inserts)
INSERT INTO treino (tipo, horario, descricao, usuario_idusuario) VALUES
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
  INSERT INTO treino (tipo, horario, descricao, usuario_idusuario) VALUES
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
INSERT INTO forum (titulo, descricao, usuario_idusuario) VALUES
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
  INSERT INTO forum (titulo, descricao, usuario_idusuario) VALUES
  ('Dúvida Treino Peitoral', 'Como evoluir no supino?', 1),
  ('Nutrição Pós-Treino',    'O que comer após o treino?', 2),
  ('Equipamentos',           'Qual melhor barra?', 3);


-- 7.2. resposta_forum (continuação dos 20 inserts)
INSERT INTO resposta_forum (mensagem, usuario_idusuario, forum_idtopico) VALUES
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
INSERT INTO resposta_forum (mensagem, usuario_idusuario, forum_idtopico) VALUES
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
(`tipo`, `bandeira_cartao`, `ultimos_digitos`, `codigo_pix`, `linha_digitavel_boleto`, `pagamento_idpagamento`)
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
(`tipo`, `bandeira_cartao`, `ultimos_digitos`, `codigo_pix`, `linha_digitavel_boleto`, `pagamento_idpagamento`)
VALUES
  ('cartao', 'Visa', '1234', NULL, NULL, 1),
  ('pix', NULL, NULL, 'pix-codigo-xyz987', NULL, 2),
  ('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000005000', 3);
  



-- 8. Pedido, item_pedido
INSERT INTO `gym_genesis`.`pedido` 
(`usuario_idusuario`, `data_pedido`, `status`, `pagamento_idpagamento`)
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
(`usuario_idusuario`, `data_pedido`, `status`, `pagamento_idpagamento`)
VALUES
  (1, '2025-04-15 14:00:00', 'processando', 1),
  (2, '2025-04-16 10:30:00', 'enviado', 2),
  (3, '2025-04-17 18:45:00', 'concluído', 3);

INSERT INTO `gym_genesis`.`item_pedido` 
(`pedido_idpedido`, `produto_idproduto`, `quantidade`, `preco_unitario`)
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
(`pedido_idpedido`, `produto_idproduto`, `quantidade`, `preco_unitario`)
VALUES
  (1, 1, 2, 50.00),  -- Produto 1, 2 unidades, preço unitário 50
  (2, 3, 1, 100.00), -- Produto 3, 1 unidade, preço unitário 100
  (3, 2, 4, 25.00);  -- Produto 2, 4 unidades, preço unitário 25

-- 9. Pagamento e pagamento_detalhe

-- 9.1. pagamento



INSERT INTO `gym_genesis`.`pagamento_assinatura` 
(`valor`, `data_pagamento`, `metodo`, `status`, `assinatura_idassinatura`)
VALUES
(99.90, NOW(), 'cartao', 'sucesso', 4),
(79.90, NOW(), 'pix', 'sucesso', 5),
(59.90, NOW(), 'boleto', 'falha', 6),
(89.90, NOW(), 'cartao', 'sucesso', 7),
(69.90, NOW(), 'pix', 'sucesso', 8),
(49.90, NOW(), 'boleto', 'falha', 9),
(109.90, NOW(), 'cartao', 'sucesso', 10),
(89.90, NOW(), 'pix', 'sucesso', 11),
(69.90, NOW(), 'boleto', 'falha', 12),
(119.90, NOW(), 'cartao', 'sucesso', 13),
(99.90, NOW(), 'pix', 'sucesso', 14),
(79.90, NOW(), 'boleto', 'falha', 15),
(129.90, NOW(), 'cartao', 'sucesso', 16),
(109.90, NOW(), 'pix', 'sucesso', 17),
(89.90, NOW(), 'boleto', 'falha', 18),
(139.90, NOW(), 'cartao', 'sucesso', 19),
(119.90, NOW(), 'pix', 'sucesso', 20);

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
('cartao', 'Mastercard', '5678', NULL, NULL, 4),
('pix', NULL, NULL, 'pix-codigo-abc124', NULL, 5),
('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000005990', 6),
('cartao', 'Visa', '4321', NULL, NULL, 7),
('pix', NULL, NULL, 'pix-codigo-abc125', NULL, 8),
('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000004990', 9),
('cartao', 'Elo', '8765', NULL, NULL, 10),
('pix', NULL, NULL, 'pix-codigo-abc126', NULL, 11),
('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000006990', 12),
('cartao', 'Mastercard', '3456', NULL, NULL, 13),
('pix', NULL, NULL, 'pix-codigo-abc127', NULL, 14),
('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000007990', 15),
('cartao', 'Visa', '6543', NULL, NULL, 16),
('pix', NULL, NULL, 'pix-codigo-abc128', NULL, 17),
('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000008990', 18),
('cartao', 'Elo', '7890', NULL, NULL, 19),
('pix', NULL, NULL, 'pix-codigo-abc129', NULL, 20);
INSERT INTO `gym_genesis`.`pagamento_detalhe_assinatura`
(`tipo`, `bandeira_cartao`, `ultimos_digitos`, `codigo_pix`, `linha_digitavel_boleto`, `pagamento_idpagamento`)
VALUES
('cartao', 'Visa', '1234', NULL, NULL, 1),
('pix', NULL, NULL, 'pix-codigo-abc123', NULL, 2),
('boleto', NULL, NULL, NULL, '34191.79001 01043.510047 91020.150008 6 89370000005990', 3);

-- 10. Avaliacao fisica e Aula agendada
-- 10.1. avaliacao_fisica (continuação dos 20 inserts)
INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_idusuario) VALUES
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
INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_idusuario) VALUES
  (70.500, 1.75, 23.02, 15.00, '2025-04-01', 1),
  (85.000, 1.80, 26.23, 20.00, '2025-04-02', 2),
  (60.300, 1.65, 22.04, 18.00, '2025-04-03', 3);

-- 10.2. aula_agendada (continuação dos 20 inserts)
INSERT INTO `gym_genesis`.`aula_agendada` 
(`data_aula`, `dia_semana`, `hora_inicio`, `hora_fim`, `usuario_idusuario`, `treino_idtreino`) 
VALUES 
('2025-05-01', 'Quinta', '09:00:00', '10:00:00', 4, 4),
('2025-05-02', 'Sexta', '17:00:00', '18:00:00', 5, 5),
('2025-05-03', 'Sábado', '07:30:00', '08:30:00', 6, 6),
('2025-05-04', 'Domingo', '19:00:00', '20:00:00', 7, 7),
('2025-05-05', 'Segunda', '08:30:00', '09:30:00', 8, 8),
('2025-05-06', 'Terça', '18:30:00', '19:30:00', 9, 9),
('2025-05-07', 'Quarta', '10:00:00', '11:00:00', 10, 10),
('2025-05-08', 'Quinta', '20:00:00', '21:00:00', 11, 11),
('2025-05-09', 'Sexta', '06:30:00', '07:30:00', 12, 12),
('2025-05-10', 'Sábado', '17:30:00', '18:30:00', 13, 13),
('2025-05-11', 'Domingo', '09:30:00', '10:30:00', 14, 14),
('2025-05-12', 'Segunda', '19:30:00', '20:30:00', 15, 15),
('2025-05-13', 'Terça', '08:00:00', '09:00:00', 16, 16),
('2025-05-14', 'Quarta', '18:00:00', '19:00:00', 17, 17),
('2025-05-15', 'Quinta', '07:00:00', '08:00:00', 18, 18),
('2025-05-16', 'Sexta', '20:30:00', '21:30:00', 19, 19),
('2025-05-17', 'Sábado', '10:30:00', '11:30:00', 20, 20);
-- 10.2. aula_agendada
INSERT INTO `gym_genesis`.`aula_agendada` 
(`data_aula`, `dia_semana`, `hora_inicio`, `hora_fim`, `usuario_idusuario`, `treino_idtreino`) 
VALUES 
('2025-04-25', 'Sexta', '08:00:00', '09:00:00', 1, 1);

INSERT INTO `gym_genesis`.`aula_agendada` 
(`data_aula`, `dia_semana`, `hora_inicio`, `hora_fim`, `usuario_idusuario`, `treino_idtreino`) 
VALUES 
('2025-04-27', 'Domingo', '10:00:00', '11:30:00', 2, 2);

INSERT INTO `gym_genesis`.`aula_agendada` 
(`data_aula`, `dia_semana`, `hora_inicio`, `hora_fim`, `usuario_idusuario`, `treino_idtreino`) 
VALUES 
('2025-04-29', 'Terça', '17:00:00', '18:00:00', 3, 3);





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

  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (3, 60.30);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (4, 72.00);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (5, 68.50);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (6, 90.20);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (7, 65.80);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (8, 74.30);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (9, 82.70);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (10, 59.90);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (11, 77.40);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (12, 63.20);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (13, 88.60);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (14, 70.80);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (15, 79.90);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (16, 61.50);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (17, 85.30);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (18, 73.70);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (19, 67.90);
  INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (20, 80.50);




-- 12. Recuperação de senha
INSERT INTO `gym_genesis`.`recuperacao_senha` (`codigo`, `usuario_idusuario`, `tempo_expiracao`)
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




INSERT INTO `gym_genesis`.`recuperacao_senha` (`codigo`, `usuario_idusuario`, `tempo_expiracao`)
VALUES ('A1B2C3', 1, DATE_ADD(NOW(), INTERVAL 1 HOUR));

INSERT INTO `gym_genesis`.`recuperacao_senha` (`codigo`, `usuario_idusuario`, `tempo_expiracao`)
VALUES ('D4E5F6', 2, DATE_ADD(NOW(), INTERVAL 1 HOUR));

INSERT INTO `gym_genesis`.`recuperacao_senha` (`codigo`, `usuario_idusuario`, `tempo_expiracao`)
VALUES ('G7H8I9', 3, DATE_ADD(NOW(), INTERVAL 1 HOUR));




-- 13. Professor e Aluno



INSERT INTO professor_aluno (idprofessor, idaluno) VALUES
  (41, 1),  
  (41, 2),  
  (41, 3),  
  (41, 4),  
  (42, 5),  
  (42, 6),  
  (42, 7),  
  (42, 8),  
  (43, 9),  
  (43, 10),  
  (43, 11),  
  (43, 12),  
  (44, 13),  
  (44, 14),  
  (44, 15),  
  (44, 16),  
  (45, 17),  
  (45, 18),  
  (45, 19),  
  (45, 20),  
  (46, 21),  
  (46, 22),  
  (46, 23),  
  (46, 24),  
  (47, 25),  
  (47, 26),  
  (47, 27),  
  (47, 28),  
  (48, 29),  
  (48, 30),  
  (48, 31),  
  (48, 32),  
  (49, 33),  
  (49, 34),  
  (49, 35),  
  (49, 36),  
  (50, 37),  
  (50, 38),  
  (50, 39),  
  (50, 40),  
  (51, 1),  
  (51, 5),  
  (51, 9),  
  (51, 13),  
  (52, 2),  
  (52, 6),  
  (52, 10),  
  (52, 14),  
  (53, 3),  
  (53, 7),  
  (53, 11),  
  (53, 15),  
  (54, 4),  
  (54, 8),  
  (54, 12),  
  (54, 16),  
  (55, 17),  
  (55, 21),  
  (55, 25),  
  (55, 29),  
  (56, 18),  
  (56, 22),  
  (56, 26),  
  (56, 30),  
  (57, 19),  
  (57, 23),  
  (57, 27),  
  (57, 31),  
  (58, 20),  
  (58, 24),  
  (58, 28),  
  (58, 32),  
  (59, 33),  
  (59, 37),  
  (60, 34),  
  (60, 38);

INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (1, 79.50);
INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (1, 77.80);
INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES (2, 85.00);

INSERT INTO endereco (usuario_id, funcionario_id, cep, rua, numero, complemento, bairro, cidade, estado)
VALUES (24, NULL, '12345-678', 'Rua das Flores', '100', 'Apto 202', 'Jardim Primavera', 'São Paulo', 'SP');
INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_idusuario)
VALUES (78.000, 198.00, 19.90, 32.00, '2025-08-25', 24);

INSERT INTO `gym_genesis`.`assinatura` 
(`data_inicio`, `data_fim`, `usuario_idusuario`, `plano_idplano`)
VALUES 
('2025-08-25', '2025-09-24', 24, 1);

INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_idusuario) VALUES
  (70.400, 1.75, 22.98, 15.2, '2025-04-11', 24),
  (72.800, 1.76, 23.51, 16.0, '2025-04-18', 24),
  (74.600, 1.77, 23.79, 16.8, '2025-04-25', 24),
  (75.300, 1.78, 23.76, 17.3, '2025-05-02', 24),
  (76.100, 1.78, 24.01, 17.9, '2025-05-09', 24),
  (77.400, 1.78, 24.43, 18.5, '2025-05-16', 24),
  (78.900, 1.78, 24.89, 19.1, '2025-05-23', 24),
  (80.200, 1.78, 25.30, 19.6, '2025-05-30', 24),
  (81.500, 1.78, 25.72, 20.2, '2025-06-06', 24),
  (82.800, 1.78, 26.14, 20.7, '2025-06-13', 24);

INSERT INTO gym_genesis.historico_peso (idusuario, peso) VALUES
  (24, 70.40),
  (24, 72.80),
  (24, 74.60),
  (24, 75.30),
  (24, 76.10),
  (24, 77.40),
  (24, 78.90),
  (24, 80.20),
  (24, 81.50),
  (24, 82.80);

INSERT INTO meta_usuario (usuario_id, descricao, data_inicio, data_limite, status) VALUES
  (24, 'Ganhar 3kg de massa muscular', '2025-04-01', '2025-07-01', 'ativa'),
  (24, 'Reduzir percentual de gordura para 15%', '2025-04-01', '2025-08-01', 'ativa'),
  (24, 'Fazer 10 pull-ups seguidos', '2025-04-01', '2025-09-01', 'ativa'),
  (24, 'Participar de uma corrida de 10km', '2025-04-01', '2025-10-01', 'ativa'),
  (24, 'Melhorar flexibilidade', '2025-04-01', '2025-07-15', 'ativa'),
  (24, 'Manter dieta por 60 dias', '2025-04-01', '2025-06-01', 'ativa'),
  (24, 'Aumentar carga no agachamento', '2025-04-01', '2025-07-01', 'ativa'),
  (24, 'Reduzir IMC para 22', '2025-04-01', '2025-08-01', 'ativa'),
  (24, 'Fazer 5km de bicicleta em 15min', '2025-04-01', '2025-09-01', 'ativa'),
  (24, 'Treinar 5x por semana', '2025-04-01', '2025-07-01', 'ativa');

  INSERT INTO treino (tipo, horario, descricao, usuario_idusuario) VALUES
  ('Hipertrofia', '09:00:00', 'Treino de membros inferiores', 24),
  ('Funcional', '17:00:00', 'Circuito funcional', 24),
  ('Cardio', '07:30:00', 'Bicicleta ergométrica', 24),
  ('Força', '19:00:00', 'Treino de costas', 24),
  ('Resistência', '08:30:00', 'Treino de resistência muscular', 24),
  ('Cardio', '18:30:00', 'Corrida intervalada', 24),
  ('Funcional', '10:00:00', 'Treino funcional avançado', 24),
  ('Hipertrofia', '20:00:00', 'Treino de braços', 24),
  ('Força', '06:30:00', 'Treino de pernas', 24),
  ('Cardio', '17:30:00', 'Elíptico', 24);

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

INSERT INTO `gym_genesis`.`aula_agendada` (`data_aula`, `dia_semana`, `hora_inicio`, `hora_fim`, `usuario_idusuario`, `treino_idtreino`) VALUES 
('2025-05-18', 'Domingo', '08:00:00', '09:00:00', 24, 3),
('2025-05-19', 'Segunda', '17:30:00', '18:30:00', 24, 7),
('2025-05-20', 'Terça', '07:00:00', '08:00:00', 24, 12),
('2025-05-21', 'Quarta', '19:00:00', '20:00:00', 24, 5),
('2025-05-22', 'Quinta', '09:30:00', '10:30:00', 24, 18),
('2025-05-23', 'Sexta', '06:00:00', '07:00:00', 24, 9),
('2025-05-24', 'Sábado', '16:00:00', '17:00:00', 24, 14),
('2025-05-25', 'Domingo', '10:00:00', '11:00:00', 24, 2),
('2025-05-26', 'Segunda', '18:30:00', '19:30:00', 24, 16),
('2025-05-27', 'Terça', '07:30:00', '08:30:00', 24, 20);