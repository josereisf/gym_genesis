<?php
require_once '../php/funcao.php'; // Inclui o arquivo com as funções

// Verifica se o formulário foi enviado
if (isset($_GET['confirmar'])) {
    $categoria = $_GET['categoria']; // Pega a categoria selecionada
} else {
    $categoria = null; // Define a categoria como nula
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>

    <header>
        <div class="logo">Shopee Afiliado</div>
        <div class="header-content">
            <div class="search-container">
                <input type="text" id="searchInput" class="search-input" placeholder="Pesquisar..." />
                <button id="searchButton" class="search-button">
                    <i class="fa-solid fa-search"></i>
                </button>
            </div>

            <button class="cta-button">Registrar</button>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="#"><i class="fa-solid fa-home nav-icon"></i> Início</a></li>
            <li><a href="#"><i class="fa-solid fa-shop nav-icon"></i> Loja</a></li>
            <li><a href="#"><i class="fa-solid fa-concierge-bell nav-icon"></i> Serviços</a></li>
            <li><a href="#"><i class="fa-solid fa-info-circle nav-icon"></i> Sobre</a></li>
            <li><a href="#"><i class="fa-solid fa-envelope nav-icon"></i> Contato</a></li>
        </ul>
    </nav>

    <div class="hero">
        <div class="hero-content">
            <h1>Bem-vindo à Loja Shopee</h1>
            <p>Sua loja única para tudo que é incrível!</p>
        </div>
    </div>

    <div class="main-content">
        <div class="section">
            <h2>Produtos em Destaque</h2>
            <div class="product-grid">
                <?php
                require_once '../php/funcao.php';

                listarProdutos();
                ?>
            </div>
        </div>

        <div class="section">
            <h2>Especiais Promoção</h2>
            <div class="product-grid">
                <?php
                require_once '../php/funcao.php';

                listarProdutos2();
                ?>
            </div>
        </div>

        <!-- Imprimir coleção -->
        <div class="colecao">
            <span>Escolha uma categoria e veja produtos relacionados para facilitar sua compra!</span>
            <?php

            require_once '../php/funcao.php';

            listarCategorias(); // Exibe o seletor de categorias

            ?>

        </div>
        <?php
        // Exibe os produtos da categoria selecionada
        listarProdutosPorCategoria($categoria); // Exibe os produtos da categoria selecionada($categoria);
        ?>


        <div class="contact-section">
            <h2>Fale Conosco</h2>
            <p>Se você tiver alguma dúvida ou precisar de assistência, entre em contato conosco.</p>
            <form>
                <input type="text" placeholder="Seu Nome" required>
                <input type="email" placeholder="Seu E-mail" required>
                <textarea rows="5" placeholder="Sua Mensagem" required></textarea>
                <button type="submit">Enviar Mensagem</button>
            </form>
        </div>


        <!-- <div class="faq-section">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-item">
                <h3>What is your return policy?</h3>
                <p>We offer a 30-day return policy for all products. Please contact our support for more details.</p>
            </div>
            <div class="faq-item">
                <h3>Do you offer international shipping?</h3>
                <p>Yes, we ship worldwide. Shipping fees and delivery times vary by destination.</p>
            </div>
            <div class="faq-item">
                <h3>How can I track my order?</h3>
                <p>Once your order is shipped, you'll receive a tracking number via email. Use this number to track your
                    shipment.</p>
            </div>
        </div>
    </div> -->

        <footer>
            <div class="footer-content">
                <div class="footer-top">
                    <div class="footer-logo">
                        <h2>Shopee Afiliado</h2>
                    </div>
                    <div class="footer-links">
                        <div class="footer-link-section">
                            <h3>Links</h3>
                            <ul>
                                <li><a href="#">Início</a></li>
                                <li><a href="#">Loja</a></li>
                                <li><a href="#">Serviços</a></li>
                                <li><a href="#">Sobre</a></li>
                                <li><a href="#">Contato</a></li>
                            </ul>
                        </div>
                        <div class="footer-link-section">
                            <h3>Entre em Contato</h3>
                            <ul>
                                <li><a href="mailto:support@muhilanstore.com">support@muhilanstore.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <p>&copy; 2025 Shopee Afiliado. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>


        <script>
            const searchButton = document.getElementById('searchButton');
            const searchInput = document.getElementById('searchInput');

            searchButton.addEventListener('click', () => {
                searchInput.classList.toggle('open'); // Adiciona/remove a classe 'open'
                if (searchInput.classList.contains('open')) {
                    searchInput.focus(); // Foca no campo de pesquisa quando expandido
                }
            });

            function carregarProdutos() {
                const categoria = document.getElementById('categoriaSelect').value; // Pega a categoria selecionada
                const produtosContainer = document.getElementById('produtosContainer');

                if (categoria) {
                    // Faz uma requisição AJAX para buscar os produtos da categoria
                    fetch(`carregarProdutos.php?categoria=${categoria}`)
                        .then(response => response.text())
                        .then(data => {
                            produtosContainer.innerHTML = data; // Exibe os produtos no container
                        })
                        .catch(error => {
                            console.error('Erro ao carregar produtos:', error);
                            produtosContainer.innerHTML = "<p>Erro ao carregar produtos.</p>";
                        });
                } else {
                    produtosContainer.innerHTML = ""; // Limpa o container se nenhuma categoria for selecionada
                }
            }
        </script>
</body>

</html>
