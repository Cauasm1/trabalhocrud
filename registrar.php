<?php
include_once './config/config.php';
include_once './classes/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($db);
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $usuario->registrar($nome, $sexo, $fone, $email, $senha);
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <div class="banner">
        <video autoplay muted loop>
            <source src="https://cdn.pixabay.com/video/2024/02/23/201735-916310640_large.mp4" type="video/mp4">
        </video>

        <div class="container">


            <h1>Cadastro Usuário</h1>
            <form method="POST">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" placeholder="Nome" required>
                <br><br>
                <label>Sexo:</label>
                <label for="masculino">
                    <input type="radio" id="masculino" name="sexo" value="M" required>Masculino
                </label>
                <label for="feminino">
                    <input type="radio" id="feminino" name="sexo" value="F" required>Feminino
                </label>
                <br><br>
                <label for="fone">Fone:</label>
                <input type="text" name="fone" placeholder="Fone" required>
                <br><br>
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="E-mail" required>
                <br><br>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" placeholder="Senha" required>
                <br><br>
                <input type="submit" value="Salvar">
            </form>

        </div>
    </div>

</body>

</html>