# 💪 Dynamic Gym Landing Page

Uma **página única de academia** com múltiplos layouts que variam automaticamente conforme o usuário visita, criando uma experiência visual única, memorável e inovadora.

---

## 🎯 Objetivo

Impressionar e engajar os visitantes, transmitindo a **versatilidade e o alto padrão** da academia por meio de diferentes estilos visuais e mensagens inspiradoras, sem perder a identidade da marca.

---

## 🧩 Estrutura do Projeto

### ✅ Elementos Fixos (presentes em todos os layouts):

- **Header:** Logo + Botão de ação (CTA)
- **Hero Section:** Título impactante + Subtítulo + Chamada para ação
- **Cards de Benefícios:** Destaques da academia (musculação, funcional, personal)
- **Depoimentos ou Provas sociais**
- **Footer:** Contato, redes sociais e marca
- **Call to Action constante**

---

### 🎨 Elementos Variáveis (mudam a cada visita):

- Cores principais (ex: Preto & Dourado, Vermelho Escuro, Azul Royal etc.)
- Frases de impacto / slogans
- Estilos visuais dos blocos (gradientes, imagens de fundo, animações)
- Ordem de seções (em alguns casos)
- Emoções transmitidas (força, foco, equilíbrio, luxo, disciplina)

---

## 🔄 Como Funciona a Alternância de Layouts

A cada visita do usuário, é armazenado um número no `localStorage` (`visit`), que determina qual layout será mostrado:

```js
const visit = Number(localStorage.getItem('visit') || 0);
const layoutIndex = visit % 5;
````

Isso gera um ciclo entre 5 layouts diferentes com base no número de visitas.

---

## 📁 Estrutura de Arquivos

```
/project-root
│
├── index.html          # Página principal com lógica JS embutida
├── styles.css          # (Opcional, se for usar CSS separado)
├── README.md           # Este arquivo
```

---

## 🧠 Inspiração e Estratégia

Esse projeto usa conceitos de:

* Psicologia das cores
* Gatilhos de engajamento visual
* Micro interações
* Identidade de marca modular

É uma forma de demonstrar que a academia é **inovadora, adaptável e impactante**, elevando a percepção de valor.

---

## 🚀 Futuras melhorias (ideias)

* Integração com sistema de login para layouts personalizados por usuário
* A/B Testing automatizado
* Layout por hora do dia ou clima
* Tema escuro/claro baseado em preferências
* Integração com banco de dados para depoimentos dinâmicos

---

## 🛠️ Tecnologias utilizadas

* HTML5
* CSS3
* JavaScript (vanilla)
* `localStorage` (para persistência de layout)

---

## 📸 Preview

> *(Insira aqui prints ou link da página se hospedada)*

---

Feito com 💪 por Meu mano chatgpt

