<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

$usuario = new Usuario($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if ($dados_usuario = $usuario->login($email, $senha)) {
            $_SESSION['usuario_id'] =
                $dados_usuario['id'];
            header('Location: portal.php');
            exit();
        } else {
            $mensagem_erro = "Credenciais inválidas!";
        }
    }
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

    <div class="container">

        <div class="box">
            <h1>AUTENTICAÇÃO</h1>
        </div>

        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Insira o e-mail" required>
            <br><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" placeholder="Insira a senha" required>
            <br><br>
            <input type="submit" name="login" value="Login">
        </form>

        <p>Esqueceu sua senha?
            <br>
            <a href="./solicitar_recuperacao.php">Recupere aqui!</a>
        </p>

        <p>Não tem uma conta?
            <br>
            <a href="./registrar.php">Registra-se aqui!</a>
        </p>

        <div class="mensagem">
            <?php if (isset($mensagem_erro)) echo '<p>' . $mensagem_erro . '</p>'; ?>
        </div>

    </div>

</body>

</html>