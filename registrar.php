<?php
include_once './config/config.php';
include_once './classes/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($db);
    $nome = $_POST['name'];
    $sexo = $_POST['sexo'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $usuario->registrar($nome, $sexo, $fone, $email, $senha);
    header('Localition:index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Cadastro Usuário</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <br>
        <label>Masculino</label>
        <input type="radio" name="sexo" value="M" required>
        <label>Feminino</label>
        <input type="radio" name="sexo" value="F" required>
        <br>
        <input type="text" name="fone" placeholder="Fone" required>
        <br>
        <input type="text" name="email" placeholder="E-mail" required>
        <br>
        <input type="Password" name="senha" placeholder="Senha" required>
        <br>
        <input type="submit" valur="Salvar">
    </form>
</body>

</html>