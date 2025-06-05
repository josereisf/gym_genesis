<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        font-family: 'Poppins', sans-serif;
    }

    form {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    input[type="file"] {
        display: block;
        margin-bottom: 20px;
        padding: 10px;
        border: 2px dashed #ccc;
        border-radius: 8px;
        width: 100%;
        cursor: pointer;
        transition: border-color 0.3s ease-in-out;
    }

    input[type="file"]:hover {
        border-color: #2a5298;
    }

    input[type="submit"] {
        background: #2a5298;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    input[type="submit"]:hover {
        background: #1e3c72;
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }
</style>

</head>
<body>
    <form action="teste_uploadImagem.php" method="post" enctype="multipart/form-data">

    <input type="file" name="arquivo"><br>
    <input type="submit" value="Salvar">

    </form>
</body>
</html>