<?php
require_once "../php/verificarLogado.php";
require_once "../php/verificarPermissaoAdm.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Agendar Aula</title>
</head>

<body>
    <form action="" method="post">
        <label for="data_aula">Data Aula</label><br>
        <input type="date" name="data_aula" id=""><br>
        <label for="dia_semana">Dia da Semana</label><br>
        <select name="dia_semana" id="">
            <option selected>Selecione um Dia</option>
            <option value="">Segunda</option>
            <option value="">Terça</option>
            <option value="">Quarta</option>
            <option value="">Quinta</option>
            <option value="">Sexta</option>
            <option value="">Sábado</option>
            <option value="">Domingo</option>
        </select><br>
        <label for="hora_inicio">Horario inicial</label><br>

        <input type="time" name="hora_inicio" id=""><br>
        <label for="hora_fim">Horario final</label><br>

        <input type="time" name="hora_fim" id=""><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>

</html>