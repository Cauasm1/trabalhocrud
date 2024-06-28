<?php
session_start();
include_once './config/config.php';
include_once './classes/Noticias.php';

$noticias = new Noticias($db);

if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $usuario->deletar($id);
    header('Location: index.php');
    exit();
}

$dados = $noticias->ler();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <header>

        <h1>Portal de Notícias</h1>

        <naigation>
            <a id="primeiro" class="login" role="button" href="login.php">Login</a>
        </naigation>

    </header>

    <div class="container">

        <table>
            <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['data']; ?></td>
                    <td><?php echo $row['titulo']; ?></td>
                    <td><?php echo $row['noticia']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

    </div>

    <footer>
        Direitos autorais por Cauã
    </footer>

</body>

</html>