<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
include_once './config/config.php';
include_once './classes/Noticias.php';

$noticias = new Noticias($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idnot = $_POST['idnot'];
    $idusu = $_POST['idusu'];
    $titulo = $_POST['titulo'];
    $noticia = $_POST['noticia'];
    $noticias->atualizar($idnot, $idusu, $titulo, $noticia);
    header('Location: portal.php');
    exit();
}

if (isset($_GET['idnot'])) {
    $idnot = $_GET['idnot'];
    $row = $noticias->lerPorId($idnot);
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

    <div class="container">

        <h1>Editar Notícia</h1>
        <form method="POST">
            <input type="hidden" name="idnot" value="<?php echo $row['idnot'] ?>" required>
            <input type="hidden" name="idusu" value="<?php echo $row['idusu'] ?>" required>
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" value="<?php echo $row['titulo'] ?>" required>
            <br><br>
            <label for="noticia">Noticia:</label>
            <br><br>
            <textarea type="text" name="noticia" value="<?php echo $row['noticia'] ?>" required rows="5" cols="33" placeholder="Escreva uma notícia"></textarea>
            <br><br>
            <input type="submit" value="Atualizar">
        </form>

    </div>

</body>

</html>