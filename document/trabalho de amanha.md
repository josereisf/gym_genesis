

# **Ficha Técnica do Projeto – Gym Genesis**

**Nome do Projeto:** Gym Genesis
**Tipo de Projeto:** Plataforma web para gestão de academia e atividades relacionadas
**Status Atual:** Em desenvolvimento, funcionalidades básicas de acadêmico já implementadas; módulo comercial e social em planejamento.

---

## **Tecnologia e Stack**

* **Backend:** PHP puro
* **Banco de Dados:** MySQL / MariaDB (uso de mysqli, sem PDO/ORM)
* **Frontend:** HTML + Tailwind CSS
* **Autenticação:** Sistema de login funcional
* **Gerenciamento de dados:** CRUD completo (Cadastrar, Editar, Deletar, Listar) para todas as tabelas existentes

---

## **Módulos e Funcionalidades**

### **1. Acadêmico (Prioritário)**

* Gerenciamento de alunos e perfis de usuário
* Cadastro de perfis com: nome, CPF, data de nascimento, telefone e foto
* Agenda de aulas: agendamento, listagem e histórico de aulas
* Cadastro e gerenciamento de cargos de instrutores e personal trainers

### **2. Comercial (Em desenvolvimento)**

* Gestão de pagamentos
* Integração de métodos de pagamento (PIX, dinheiro, troco)
* Histórico financeiro

### **3. Social / Gamificação (Planejado)**

* Sistema de interação entre usuários
* Possível feed de atividades ou conquistas

---

## **Estrutura do Banco de Dados**

* **Tabelas principais:**

  * `usuario`
  * `perfil_usuario`
  * `cargo`
  * `aula_agendada`
  * `treino`
* **Relacionamentos:**

  * Usuário ↔ Perfil de usuário (1:1)
  * Aula agendada ↔ Usuário e Treino (N:1)
* **Chaves estrangeiras já implementadas** para garantir integridade

---

## **Estilo de Desenvolvimento**

* Código PHP puro, com mysqli para consultas e prepared statements
* HTML e Tailwind para frontend simples, rápido e responsivo
* Desenvolvimento incremental, adicionando funcionalidades conforme prioridade
* Foco inicial no módulo acadêmico antes de migrar para comercial e social

---

## **Prioridades**

1. Finalizar o módulo acadêmico (principal)
2. Avançar para funcionalidades comerciais
3. Implementar recursos sociais e interativos

---

## **Observações**

* Sistema modular, facilitando futuras expansões
* Interface limpa, voltada para funcionalidade e simplicidade
* Banco de dados já estruturado para suportar todas as operações previstas
* Desenvolvedor aberto a ajustes e melhorias contínuas durante o desenvolvimento

---
