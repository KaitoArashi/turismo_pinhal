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
    <title>QR Pinhal - Apagar Turismo</title>
    <link rel="stylesheet" href="style_apagar.css">
</head>

<body>
    <header>
        <h1>Apagar Ponto Turistico</h1>
    </header>
    <main>
        <?php
        if (@$_GET['apagar']) {
            $sql = "DELETE FROM tb_turismo WHERE id_turismo = $_GET[apagar];";
            $resultador = mysqli_execute_query($conexao, $sql);
            echo
            "<p>Registro apagado com sucesso !!!<p>";
        }

        $sql = "SELECT tb_turismo.id_turismo, tb_turismo.titulo, tb_turismo.endereco, tb_turismo.imagem, tb_turismo.id_categoria, tb_turismo.informacoes, tb_turismo.telefone, tb_categoria.nome 
                        FROM tb_turismo,tb_categoria 
                        WHERE tb_turismo.id_categoria=tb_categoria.id_categoria
                        ORDER BY id_turismo DESC;";
        $consulta = mysqli_execute_query($conexao, $sql);
        if (mysqli_num_rows($consulta) == 0) {
            echo "<h1>❌ Não existe nenhum artigo cadastrado.</h1>";
        } else {
            while ($dados = mysqli_fetch_array($consulta)) {
                echo "
        <article>
            <h5>$dados[id_turismo]</h5>
            <h2>$dados[titulo]</h2>
            <h4>$dados[informacoes]</h4>
            <h3>$dados[nome]</h3>
            <img src='img/dados_imagem/$dados[3]' style='width:15%;border-radius:0px 0px 8px 0px'>
            <br>
            <a href='apagar.php?apagar=$dados[0]'>Apagar</a>
        </article>
        ";
            }
        }
        ?>
    </main>
    <footer>
        <p>Conectado com Administrador: <?php echo $_SESSION['usuario']; ?></p>
        <a href="admin.php">← Voltar a Area Administrativa</a>
    </footer>
</body>

</html>