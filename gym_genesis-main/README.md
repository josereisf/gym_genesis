### ✅ Tabelas principais e suas finalidades

| Tabela               | Finalidade                                                  |
|----------------------|-------------------------------------------------------------|
| **usuario**          | Guarda dados dos usuários (clientes)                        |
| **funcionario**      | Dados dos funcionários da academia                          |
| **endereco**         | Endereços vinculados a usuários ou funcionários             |
| **cargo**            | Cargos dos funcionários (ex: treinador, recepcionista)      |
| **assinatura**       | Registra planos/assinaturas dos usuários                    |
| **avaliacao_fisica** | Dados físicos e avaliações de saúde                         |
| **horario**          | Faixas de horário para aulas ou atendimentos                |
| **aula_agendada**    | Marcações de aulas com horário e usuário                    |
| **treino**           | Treinos atribuídos aos usuários                             |
| **exercicio**        | Exercícios cadastrados com grupo muscular, vídeo, etc       |
| **historico_treino** | Histórico de execuções de treinos                           |
| **dieta**            | Dietas associadas a usuários                                |
| **refeicao**         | Refeições dentro de uma dieta                               |
| **alimento**         | Cadastro nutricional dos alimentos                          |
| **dieta_alimento**   | Relação entre alimentos e refeições em dietas               |
| **categoria_produto**| Classificações para produtos vendidos                       |
| **produto**          | Produtos da loja (ainda incompleto no script)              |
| **pedido**           | Pedidos feitos pelos usuários na loja                       |
| **cupom_desconto**   | Cupons aplicáveis em compras                                |
| **forum**            | Tópicos de fórum para interação entre usuários              |


# 🧭 Fluxo do Banco de Dados - Sistema Academia

O banco de dados está organizado para cobrir as principais funcionalidades de uma academia moderna, envolvendo **cadastro de usuários e funcionários, treinos, dietas, loja, agendamentos e fórum de interação**.

---

## 🧑‍💼 Cadastro de Usuários e Funcionários

- A tabela `usuario` armazena os dados dos **clientes da academia**.
- A tabela `funcionario` armazena os **colaboradores**, que são ligados a um `cargo` (ex: treinador, nutricionista) através da tabela `cargo`.
- A tabela `endereco` pode ser relacionada tanto a um `usuario` quanto a um `funcionario` para armazenar os dados de localização de ambos.

---

## 📝 Assinaturas e Avaliações

- A tabela `assinatura` está ligada a `usuario`, indicando o **plano ativo do cliente**.
- A tabela `avaliacao_fisica` armazena os **dados físicos e de saúde** de cada cliente, referenciando também a tabela `usuario`.

---

## 🕒 Aulas e Agendamentos

- `horario` define as faixas de tempo disponíveis.
- `aula_agendada` conecta um `usuario` a um `horario`, possivelmente também com um `funcionario` (ex: instrutor) para indicar o **agendamento de uma aula ou atendimento personalizado**.

---

## 🏋️ Treinos e Exercícios

- A tabela `treino` é ligada a um `usuario` e representa um conjunto de atividades físicas.
- Cada treino pode conter vários `exercicio` cadastrados, e a **execução real** do treino pelo usuário é registrada na tabela `historico_treino`.

---

## 🥗 Dietas e Nutrição

- Cada `usuario` pode ter uma `dieta`, que por sua vez contém várias `refeicao`.
- As refeições contêm itens da tabela `alimento` através da tabela intermediária `dieta_alimento`, permitindo associar múltiplos alimentos a cada refeição com quantidades específicas.

---

## 🛒 Loja e Vendas

- Produtos são cadastrados em `produto`, e classificados por `categoria_produto`.
- `pedido` registra compras feitas por `usuario`, podendo aplicar um `cupom_desconto`.
- Esses dados serão importantes para **controle de estoque e vendas**.

---

## 💬 Fórum

- A tabela `forum` permite que usuários criem tópicos de discussão, incentivando a **interação entre os membros da academia**.

---

## 🔗 Relações Resumidas

| Origem               | Destino                | Relação/Explicação                                         |
|----------------------|------------------------|-------------------------------------------------------------|
| `usuario`            | `endereco`             | Um usuário tem um endereço                                 |
| `usuario`            | `assinatura`           | Um usuário possui uma assinatura                           |
| `usuario`            | `avaliacao_fisica`     | Um usuário tem uma ou mais avaliações                      |
| `usuario`            | `treino`               | Treinos são atribuídos a usuários                          |
| `usuario`            | `dieta`                | Cada usuário pode ter uma dieta                            |
| `usuario`            | `pedido`               | Pedidos de produtos são feitos por usuários                |
| `usuario`            | `aula_agendada`        | Agendamento de aulas por usuários                          |
| `funcionario`        | `cargo`                | Cada funcionário ocupa um cargo                            |
| `refeicao`           | `dieta`                | Várias refeições pertencem a uma dieta                     |
| `dieta_alimento`     | `refeicao` + `alimento`| Associa alimentos a refeições com porções                  |
| `pedido`             | `produto`              | Cada pedido contém produtos                                |
| `pedido`             | `cupom_desconto`       | Pode haver cupons aplicados ao pedido                      |

---
