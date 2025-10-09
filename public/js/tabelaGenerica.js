$(document).ready(function () {
    let tabela = $('#tabela').data(<?= $tabela ?>);
    let id = $('#dados').data('id');

    console.log("Tabela:", tabela);
    console.log("ID:", id);

    listarTabela(tabela, id);
});

function listarTabela(tabela, id) {
    $.ajax({
        url: 'http://localhost:83/public/api/index.php?entidade=' + tabela + '&acao=listar',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ id: id }),
        success: function (data) {
            if (data.sucesso) {
                const dados = data.dados;
                console.table(dados);
                
                const tbody = $('#tabela-dados tbody');
                const thead = $('#tabela-dados thead');
                tbody.empty(); // Limpa as linhas antigas
                thead.empty(); // Limpa o cabeçalho antigo

                // Se não houver dados, exibe mensagem
                if (dados.length === 0) {
                    tbody.append('<tr><td colspan="100%">Nenhum dado encontrado</td></tr>');
                    return;
                }

                // Criar dinamicamente o cabeçalho da tabela
                let headerRow = $('<tr></tr>');
                Object.keys(dados[0]).forEach(key => {
                    headerRow.append('<th>' + key.charAt(0).toUpperCase() + key.slice(1) + '</th>');
                });
                thead.append(headerRow);

                // Preencher as linhas da tabela com os dados
                dados.forEach(item => {
                    let linha = $('<tr></tr>');
                    Object.keys(item).forEach(key => {
                        linha.append('<td>' + (item[key] !== null ? item[key] : 'N/A') + '</td>');
                    });
                    tbody.append(linha);
                });
            } else {
                console.log('Erro: Dados não encontrados');
            }
        },
        error: function (error) {
            console.error('Erro ao buscar dados:', error);
        }
    });
}
