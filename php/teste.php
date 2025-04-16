<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Interativo com Foto e Informações</title>
<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        margin: 0;
        background-color: #f0f0f0;
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 20px;
    }

    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        width: 100%;
        max-width: 1200px;
        padding: 20px;
    }

    .card {
        width: 100%;
        height: 300px;
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease;
    }

    .card-info {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 20px;
        box-sizing: border-box;
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .card-info h2 {
        margin: 0;
        color: #333;
        font-size: 1.5rem;
    }

    .card-info p {
        margin: 10px 0;
        color: #666;
        font-size: 1rem;
    }

    .card-info .price {
        font-weight: bold;
        color: #000;
        font-size: 1.2rem;
    }

    .card:hover .card-image img {
        opacity: 0.3;
    }

    .card:hover .card-info {
        opacity: 1;
    }

    /* Estilos do botão */
    .button-link {
        text-decoration: none;
    }

    button {
        color: rgb(253, 119, 119);
        position: relative;
        overflow: hidden;
        outline: none;
        cursor: pointer;
        border-radius: 50px;
        background-color: hsl(118, 94%, 32%);
        border: solid 4px hsl(0, 0%, 100%);
        font-family: inherit;
        margin-top: 10px;
    }

    .default-btn,
    .hover-btn {
        background-color: hsl(118, 94%, 32%);
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 500;
        text-transform: uppercase;
        transition: all 0.6s ease;
    }

    .hover-btn {
        position: absolute;
        inset: 0;
        background-color: hsl(0, 0%, 0%);
        transform: translate(0%, 100%);
    }

    .default-btn span {
        color: hsl(0, 0%, 100%);
    }

    .hover-btn span {
        color: hsl(0, 0%, 100%);
    }

    button:hover .default-btn {
        transform: translate(0%, -100%);
    }

    button:hover .hover-btn {
        transform: translate(0%, 0%);
    }

    .css-i6dzq1 {
        color: black;
    }

</style>
</head>
<body>
    <h1>Listagem de Produtos</h1>
    <div class="card-container">
        <?php
        // Inclua o arquivo com a função listarProdutos()
        require_once 'funcao.php'; // Substitua pelo nome do arquivo onde está a função

        // Chame a função para listar os produtos
        listarProdutos();
        ?>
    </div>
</body>
</html>
