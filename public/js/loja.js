$(document).on('click', '.adicionar', function() {
    adicionarCarrinho(this);
});


function adicionarCarrinho(botao) {
    let id = $(botao).val();
    console.log('ID do produto:', id);


    $.ajax({
        url: 'http://localhost:83/public/php/adicionar.php',
        method: 'GET',
        data: { id: id },
        success: function (response) {
            console.log('Item adicionado ao carrinho com sucesso', response);

        },
        error: function (xhr, status, error) {
            console.error('Erro ao adicionar item ao carrinho', error);
        }
    });
};