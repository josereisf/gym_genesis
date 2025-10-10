<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'http://localhost:83/public/php/troca.php?tipo=1',
                method: 'GET',
                complete: function() {
                    // Defina a página de redirecionamento
                    var paginaAnterior = document.referrer || 'dashboard_usuario.php'; 
                    // Redireciona para a página do usuário
                    window.location.href = paginaAnterior;}});
        });
    </script>
</body>
</html>