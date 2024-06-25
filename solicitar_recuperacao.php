<?php
include_once './config/config.php';
include_once './classes/Usuario.php';
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $usuario = new Usuario($db);
    $codigo = $usuario->gerarCodigoVerificacao($email);
    if ($codigo) {
        $mensagem = "Seu código de verificação é: $codigo. Por favor,
anote o código e <a href='redefinir_senha.php'>clique aqui</a> para
redefinir sua senha.";
    } else {
        $mensagem = 'E-mail não encontrado.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Recuperar Senha</title>
</head>

<body>

    <div class="banner">
        <video autoplay muted loop>
            <source src="https://cdn.pixabay.com/video/2024/02/23/201735-916310640_large.mp4" type="video/mp4">
        </video>

        <div class="container">

            <h1>Recuperar Senha</h1>
            <form method="POST">
                <label for="email">Email:</label>
                <input type="email" name="email" required><br><br>
                <input type="submit" value="Enviar">
            </form>
            <p><?php echo $mensagem; ?></p>
            <a href="login.php">Voltar</a>

        </div>
    </div>

</body>

</html>