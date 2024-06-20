<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';
$usuario = new Usuario($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['$email'];
        $senha = $_POST['$senha'];
        if ($dados_Usuario = $usuario->login(
            $email,
            $senha
        )) {
            $_SESSION['usuario_id'] =
                $dados_Usuario['id'];
            header('Location:portal.php');
            exit();
        } else {
            $mensagem_erra = "Credeciais inválidas!";
        }
    }
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
    <div class="container">
        <form method="POST">
            <input type="email" name="email" placeholder="Insira o e-mail" required>
            <input type="password" name="senha" placeholder="Insira a senha" required>
            <input type="submit" value="Entrar">
            <p>Não tem conta?<a href="./registar.php">Aqui</a></p>
        </form>
        <div class="mensagem">
            <?php
            if (isset($mensagem_erra)) {
                echo '<p>' . $mensagem_erra . '</p>';
            }
            ?>
        </div>
    </div>
</body>

</html>