<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario = new Usuario($db);

$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];

$dados = $usuario->ler();

$search = isset($_GET['search']) ? $_GET['search'] : '';
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : '';

$dados = $usuario->ler($search, $order_by);

function saudacao()
{
    $hora = date('H');
    if ($hora >= 6 && $hora < 12) {
        return "Bom dia";
    } else if ($hora >= 12 && $hora < 18) {
        return "Boa tarde";
    } else {
        return "Boa noite";
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

    <header>
        <h1>Portal de Notícias</h1>
    </header>

    <div class="portal-container">

        <h1><?php echo saudacao() . ", " . $nome_usuario; ?>!</h1>

        <a id="primeiro" class="button" role="button" href="cadastro_usuario.php">Cadastro de Usuários</a>
        <br>
        <a class="button" role="button" href="cadastro_noticia.php">Cadastro de Notícias</a>

    </div>

    <footer>
        Direitos autorais por Cauã
    </footer>

</body>

</html>