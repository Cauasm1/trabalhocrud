<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';
include_once './classes/Noticias.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $usuario->deletar($id);
    header('Location: portal.php');
    exit();
}

if (isset($_GET['deletar'])) {
    $idnot = $_GET['deletar'];
    $noticias->deletar($idnot);
    header('Location: index.php');
    exit();
}

$usuario = new Usuario($db);

$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];

$dados = $usuario->ler();

$search = isset($_GET['search']) ? $_GET['search'] : '';
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : '';

$dados = $usuario->ler($search, $order_by);

$noticias = new Noticias($db);

$dadosnot = $noticias->lerPorIdusu($_SESSION['usuario_id']);

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

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



    <div class="cadastro-container">

        <h1><?php echo saudacao() . ", " . $nome_usuario; ?>!</h1>

        <br>

        <a class="button" role="button" href="editar.php?id=<?php echo $_SESSION['usuario_id']; ?>">Editar Usuario</a>
        <br>
        <a class="button" role="button" href="index.php">Logout</a>

    </div>

    <div class="cadastrodenoticias-container">

        <h1>Cadastro de Notícias:</h1>

        <form method="POST">
            <label for="noticia">Escreva uma notícia:</label>
            <br><br>

            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo">
            <br><br>
            <textarea id="noticia" name="noticia" rows="5" cols="33" placeholder="Escreva uma notícia"></textarea>
            <br><br>
            <input type="submit" value="Salvar">
        </form>

    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['titulo']) && isset($_POST['noticia'])) {
            $noticias = new Noticias($db);
            $idusu = $_SESSION['usuario_id'];
            $data = date("Y-m-d");
            $titulo = $_POST['titulo'];
            $noticia = $_POST['noticia'];
            $noticias->registrar($idusu, $data, $titulo, $noticia);
            header('Location: portal.php');
            exit();
        }
    }
    ?>


    <?php while ($row = $dadosnot->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <div class="not-container">
                <br><br>
                <label>Titulo:</label>
                <td><?php echo $row['titulo']; ?></td>
                <br><br>
                <label>Data:</label>
                <td><?php echo $row['data']; ?></td>
                <br><br>
                <label>Noticia:</label>
                <br><br>
                <td><?php echo $row['noticia']; ?></td>
                <br><br>
                <a href="deletar_noticia.php?idnot=<?php echo $row['idnot'] ?>">Deletar</a>
                <a href="editar_noticia.php?idnot=<?php echo $row['idnot'] ?>">Editar</a>
            </div>
        </tr>
    <?php endwhile; ?>

</body>

</html>