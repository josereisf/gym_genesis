<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        #mensagem {
            margin-top: 15px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Recuperação de Senha</h1>
    <form id="formRecuperar">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required placeholder="Digite seu e-mail">
        <input type="submit" value="Recuperar Senha">
    </form>
    <div id="mensagem"></div>

    <script>
        $(document).ready(function() {
            $('#formRecuperar').on('submit', function(e) {
                e.preventDefault();
                let email = $('#email').val();
                $('#mensagem').text('Enviando código, aguarde...');

                $.ajax({
                    url: './php/recuperacao_senha.php', // seu arquivo PHP
                    method: 'POST',
                    data: {
                        email: email
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'sucesso') {
                            $('#mensagem').css('color', 'green').text(response.mensagem);

                            // Redirecionar após 2 segundos para a página de trocar senha
                            setTimeout(function() {
                                window.location.href = 'trocar_senha.php?email=' + encodeURIComponent(email);
                            }, 2000);
                        } else {
                            $('#mensagem').css('color', 'red').text(response.mensagem);
                        }
                    },
                    error: function() {
                        $('#mensagem').css('color', 'red').text('Erro ao processar a solicitação.');
                    }
                });
            });
        });
    </script>
</body>

</html>