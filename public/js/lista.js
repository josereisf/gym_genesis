const http = new XMLHttpRequest();
http.open("GET", "../api/listar.php?action=listarPlanos", true);
http.send();

http.onload = () => {
  const dados = JSON.parse(http.responseText);
  const theadRow = document.querySelector("table thead tr");
  const tbody = document.querySelector("table tbody");

  tbody.innerHTML = "";
  theadRow.innerHTML = "";

  if (dados.length > 0) {
    // Gerar cabeçalhos automaticamente com base nas chaves do primeiro objeto
    Object.keys(dados[0]).forEach((chave) => {
      const th = document.createElement("th");
      th.textContent = chave.charAt(0).toUpperCase() + chave.slice(1);
      theadRow.appendChild(th);
    });

    // Preencher corpo da tabela
    dados.forEach((linha) => {
      const tr = document.createElement("tr");
      Object.values(linha).forEach((valor) => {
        const td = document.createElement("td");
        td.textContent = valor ?? "N/A";
        tr.appendChild(td);
      });
      tbody.appendChild(tr);
    });
  } else {
    const tr = document.createElement("tr");
    const td = document.createElement("td");
    td.textContent = "Nenhum dado encontrado.";
    td.colSpan = 99;
    td.style.textAlign = "center";
    tr.appendChild(td);
    tbody.appendChild(tr);
  }
};
