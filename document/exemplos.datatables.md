

# 📄 Guia Completo de DataTables (Resumo para Estudo e Implementação)

## 📌 O que é DataTables?

**DataTables** é um plugin jQuery que transforma tabelas HTML comuns em tabelas interativas com recursos como:

* Paginação
* Busca
* Ordenação por coluna
* Exportação de dados
* Responsividade
* Filtros personalizados
* Edição inline

---

## 🧱 Estrutura Básica

### 🔗 Imports obrigatórios:

```html
<!-- CSS do DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- JS do DataTables -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
```

### 🧪 Tabela HTML base:

```html
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Cargo</th>
            <th>Local</th>
            <th>Idade</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>Arquiteto</td>
            <td>Edimburgo</td>
            <td>61</td>
        </tr>
        <!-- + linhas -->
    </tbody>
</table>
```

### 🚀 Inicialização:

```js
$(document).ready(function () {
    $('#example').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
        }
    });
});
```

---

## ✨ Recursos Avançados

---

### ✅ 1. Exportar para PDF, Excel, CSV, Print

#### 🔗 Imports:

```html
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
```

#### 🔧 Ativar:

```js
$('#example').DataTable({
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    language: { url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json" }
});
```

---

### ✅ 2. Responsividade (Mobile Friendly)

#### 🔗 Imports:

```html
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
```

#### 🔧 Ativar:

```js
$('#example').DataTable({
    responsive: true,
    language: { url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json" }
});
```

---

### ✅ 3. Filtros personalizados

#### 🔧 Filtro por coluna (input):

```html
<thead>
<tr>
    <th>Nome</th>
    <th>Cargo</th>
    <th>Local</th>
    <th>Idade</th>
</tr>
<tr>
    <th><input type="text" placeholder="Filtrar Nome"></th>
    <th><input type="text" placeholder="Filtrar Cargo"></th>
    <th><input type="text" placeholder="Filtrar Local"></th>
    <th><input type="text" placeholder="Filtrar Idade"></th>
</tr>
</thead>
```

```js
var table = $('#example').DataTable();
$('#example thead tr:eq(1) th').each(function (i) {
    $('input', this).on('keyup change', function () {
        table.column(i).search(this.value).draw();
    });
});
```

#### 🔧 Filtro por dropdown:

```html
<select id="filtroCargo">
    <option value="">Todos</option>
    <option value="Arquiteto">Arquiteto</option>
    <option value="Contador">Contador</option>
</select>
```

```js
$('#filtroCargo').on('change', function () {
    $('#example').DataTable().column(1).search(this.value).draw();
});
```

---

### ✅ 4. Edição Inline (manual - gratuita)

#### 🔧 Código:

```js
$('#example tbody').on('dblclick', 'td', function () {
    if ($(this).find('input').length > 0) return;

    const cell = $('#example').DataTable().cell(this);
    const original = cell.data();
    const input = $('<input type="text">').val(original);
    $(this).html(input);
    input.focus();

    input.on('blur keypress', function (e) {
        if (e.type === 'blur' || e.key === 'Enter') {
            const valor = $(this).val();
            cell.data(valor).draw();
        }
    });
});
```

#### 💡 (Opcional) Enviar para backend via AJAX:

```js
$.ajax({
    url: '/api/salvar',
    method: 'POST',
    data: {
        id: idLinha,
        campo: nomeCampo,
        valor: novoValor
    },
    success: function () {
        alert('Atualizado com sucesso!');
    }
});
```

---

## 🧠 Extras úteis

* **`columnDefs`**: para esconder colunas ou desabilitar ordenação

```js
columnDefs: [
    { targets: 1, visible: false }, // Esconde coluna 2
    { targets: 3, orderable: false } // Impede ordenação da coluna 4
]
```

* **Ordenar ao iniciar**

```js
order: [[3, 'desc']] // Ordena pela 4ª coluna (idade) decrescente
```

* **Paginação**

```js
paging: true
```

* **Busca**

```js
searching: true
```

* **Info abaixo da tabela**

```js
info: true
```

---

## 📌 Conclusão

O **DataTables** é uma ferramenta poderosa e flexível. Com os recursos acima, você pode criar tabelas modernas com:

* Exportação
* Filtros inteligentes
* Edição de dados diretamente na interface
* Suporte a mobile
* Integração com banco de dados via AJAX
