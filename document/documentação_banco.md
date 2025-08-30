## Documentação do Banco de Dados - Gym Genesis

### Visão Geral

Este banco de dados foi projetado para atender a uma plataforma completa de academia, incluindo funcionalidades como gerenciamento de usuários, planos de treino, avaliações físicas, controle de pagamentos, fórum interativo, agendamento de aulas, loja virtual e plano alimentar.

---

### Tabelas Principais

#### 1. **usuario**

Armazena os dados dos usuários do sistema (alunos, administradores, etc).

- `idusuario` (PK)
- `nome`, `email`, `senha`, `cpf`, `data_nascimento`, `telefone`
- `numero_matricula`, `foto_perfil`, `tipo_usuario`

#### 2. **funcionario**

Informações dos funcionários da academia.

- `idfuncionario` (PK)
- `nome`, `email`, `telefone`, `data_nascimento`, `sexo`, `foto_perfil`
- FK: `cargo_idcargo`

#### 3. **endereco**

Endereço completo de usuários e funcionários.

- `idendereco` (PK)
- `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`
- FK: `usuario_idusuario`

#### 4. **plano**

Planos de assinatura disponíveis.

- `idplano` (PK)
- `nome`, `duracao`, `descricao`

#### 5. **assinatura**

Assinaturas ativas dos usuários.

- `idassinatura` (PK)
- `data_inicio`, `data_fim`
- FK: `usuario_idusuario`, `plano_id`

#### 6. **pagamento**

Pagamentos realizados.

- `idpagamento` (PK)
- `valor`, `data_pagamento`, `metodo`, `status`

#### 7. **pagamento_detalhe** / **pagamento_detalhe_assinatura**

Detalhes do pagamento (cartão/boleto).

- `idpagamento_detalhe` / `idpagamento_assinatura` (PK)
- `tipo`, `ultimos_digitos`, `codigo_apx`, `linha_digitavel_boleto`

#### 8. **avaliacao_fisica**

Medições e avaliações corporais do aluno.

- `idavaliacao` (PK)
- `peso`, `altura`, `imc`, `gordura_corporal`, `data`
- FK: `usuario_idusuario`

#### 9. **treino**

Planos de treino cadastrados.

- `idtreino` (PK)
- `data_aula`, `dia_semana`, `horario`, `descricao`
- FK: `usuario_idusuario`

#### 10. **exercicio**

Lista de exercícios disponíveis.

- `idexercicio` (PK)
- `nome`, `descricao`, `video_url`

#### 11. **treino_exercicio**

Relaciona treinos com os exercícios.

- `idtreino_exercicio` (PK)
- `series`, `repeticoes`, `carga`, `intervalo`
- FK: `treino_id`, `exercicio_idexercicio`

#### 12. **aula_agendada**

Aulas marcadas por usuários.

- `idaula` (PK)
- `data`, `dia_semana`, `hora_inicio`, `hora_fim`
- FK: `usuario_idusuario`, `treino_id`

#### 13. **historico_treino**

Histórico de execução dos treinos.

- `idhistorico` (PK)
- `data_execucao`, `descricao`
- FK: `usuario_idusuario`, `treino_id`

#### 14. **produto** / **categoria_produto**

Catálogo de produtos da loja virtual.

- `idproduto` (PK), `nome`, `descricao`, `valor`, `estoque`, `imagem`
- `idcategoria` (PK), `descricao`

#### 15. **pedido** / **item_pedido**

Pedidos feitos na loja virtual.

- `idpedido` (PK), `status_pedido`, `data_pedido`
- `iditem_pedido` (PK), `quantidade`, `valor_unitario`
- FK: `usuario_idusuario`, `produto_idproduto`, `pedido_idpedido`

#### 16. **recomendacao_alimentar** / **dieta_alimento** / **alimento**

Sistema de plano alimentar.

- `iddieta` (PK), `descricao`, `data_inicio`, `data_fim`
- `idalimento` (PK), `nome`, `calorias`, `carboidratos`, `proteinas`, `gorduras`, `porcao`, `foto_perfil`
- Tabela associativa: `dieta_alimento`

#### 17. **forum** / **resposta_forum**

Módulo de fórum comunitário.

- `idtopico` (PK), `titulo`, `descricao`, `data_criacao`
- `idresposta` (PK), `mensagem`, `data_resposta`
- FK: `usuario_idusuario`, `forum_id`

#### 18. **meta_usuario**

Metas personalizadas por aluno.

- `idmeta` (PK), `descricao`, `tipo`, `data_inicio`, `data_limite`, `status`
- FK: `usuario_idusuario`

#### 19. **cupom_desconto**

Cupons ativos para descontos.

- `idcupom` (PK), `codigo`, `valor`, `data_validade`, `ativo`, `tipo`, `descricao`

#### 20. **recuperacao_senha**

Sistema de redefinição de senha.

- `idrecuperacao`, `codigo_verificacao`, `tempo_expiracao`
- FK: `usuario_idusuario`

---

### Relacionamentos

- Os relacionamentos são feitos por chaves estrangeiras, garantindo integridade referencial.
- Há tabelas associativas como `treino_exercicio`, `item_pedido`, `dieta_alimento`.
