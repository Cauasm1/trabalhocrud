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

        <form method="GET">

            <input type="text" name="search" placeholder="Pesquisar por nome ou email" value="<?php echo htmlspecialchars($search); ?>">

            <label>
                <input type="radio" name="order_by" value="" <?php if ($order_by == '') echo 'checked'; ?>> Normal
            </label>

            <label>
                <input type="radio" name="order_by" value="nome" <?php
                                                                    if ($order_by == 'nome') echo 'checked'; ?>> Ordem Alfabética
            </label>

            <label>
                <input type="radio" name="order_by" value="sexo" <?php
                                                                    if ($order_by == 'sexo') echo 'checked'; ?>> Sexo
            </label>

            <button type="submit">Pesquisar</button>

        </form>

        <br>

        <a id="primeiro" class="button" role="button" href="registrar.php">Adicionar Usuário</a>
        <a class="button" role="button" href="logout.php">Logout</a>
        <br>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Fone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo ($row['sexo'] === 'M') ? 'Masculino' : 'Feminino'; ?></td>
                    <td><?php echo $row['fone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                        <br>
                        <a href="deletar.php?id=<?php echo $row['id']; ?>">Deletar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <br><br>
        <a class="button" role="button" href="cadastro_noticia.php">Cadastro de Notícias</a>

    </div>


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