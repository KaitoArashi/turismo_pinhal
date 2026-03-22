<?php

include_once 'conexao.php';
session_start();
if (!$_SESSION['usuario']) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Pinhal - Administrador</title>
    <link rel="stylesheet" href="style_admin.css">
</head>

<body>
    <div id="pagina_admin">
        <header>
            <h2>Seja bem vindo <?php echo $_SESSION['usuario']; ?></h2>
        </header>
        <div id="container">
            <main>
                <a href="adicionar.php">➕ Adicionar Ponto Turistico</a>
                <a href="apagar.php">➖ Apagar Ponto Turistico</a>
                <a href="listar.php">📚 Listar Ponto Turistico</a>
                <a href="alterar.php">🔧 Alterar Ponto Turistico</a>
            </main>
        </div>
        <footer>
            <p>Todos os direitos reservador. 2025</p>
            <p id="adm_conectado">Conectado com Administrador: <?php echo $_SESSION['usuario']; ?></p>
            <a href="sair.php">❌ Desconectar-se</a>
        </footer>
    </div>
</body>

</html>