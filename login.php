<?php
include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Pinhal - Login</title>
    <link rel="stylesheet" href="style_login.css">
</head>

<body>
    <div id="pagina_login">
        <header>
            <h1>
                Turismo Pinhalense
            </h1>
        </header>
        <main>
            <h1>Login do Sistema</h1>
            <?php
            if (@$_POST['btnEnviar']) {
                $form_usuario = @$_POST["txtUsuario"];
                $form_senha   = @$_POST["txtSenha"];
                $sql = "SELECT * FROM tb_login WHERE usuario = '$form_usuario' AND senha = '$form_senha';";
                $consulta = mysqli_query($conexao, $sql);
                if (mysqli_fetch_row($consulta)) {
                    session_start();
                    $_SESSION['usuario'] = $form_usuario;
                    $_SESSION['senha'] = $form_senha;
                    header('Location: admin.php');
                } else {
                    echo "<p>Usuário ou Senha incorreto! <br> Caso não seja um dos nossos administradores, volte para a pagina principal por gentileza</p>";
                }
            }
            ?>
            <div id="login">
                <form action="login.php" method="post" enctype="multipart/form-data">
                    <label for="txtUsuario">Usuario:</label>
                    <input type="text" name="txtUsuario" id="txtUsuario" autocomplete="off" autofill="off">
                    <br>
                    <label for="txtSenha">Senha:</label>
                    <input type="password" name="txtSenha" id="txtSenha" autocapitalize="new-password" autofill="off">
                    <br>
                    <input type="submit" value="Enviar" name="btnEnviar" id="btnEnviar">
                    <input type="reset" value="Limpar" name="btnLimpar" id="btnLimpar">
                </form>
            </div>
        </main>
        <footer>
            <p>Todos os direitos reservador. 2025</p>
            <a href="sair.php">← Voltar ao menu principal</a>
        </footer>
    </div>
</body>

</html>