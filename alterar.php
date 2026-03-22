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
    <title>QR Pinhal - Alterar Turismo</title>
    <link rel="stylesheet" href="style_alterar.css">
</head>

<body>
    <header>
        <h2>
            Alterar Ponto Turistico
        </h2>
    </header>

    <main>
        <?php
        if (@$_POST['btnAlterar']) {
            if (isset($_FILES['inputImagem']) && $_FILES['inputImagem']['name'] != '') {

                $form_imagem = $_FILES['inputImagem'];

                $nome_imagem = $form_imagem['name'];

                $res = move_uploaded_file($form_imagem['tmp_name'], 'img/dados_imagem/' . $nome_imagem);

                $sql = "UPDATE tb_turismo SET titulo = '$_POST[txtTitulo]',endereco = '$_POST[txtEndereco]',informacoes = '$_POST[txtInformacoes]',telefone = '$_POST[txtTelefone]',imagem='$nome_imagem' WHERE id_turismo = $_POST[txtID];";
            } else {
                $sql = "UPDATE tb_turismo SET titulo = '$_POST[txtTitulo]',endereco = '$_POST[txtEndereco]',informacoes = '$_POST[txtInformacoes]',telefone = '$_POST[txtTelefone]' WHERE id_turismo = $_POST[txtID];";
            }
            $resultado = mysqli_execute_query($conexao, $sql);
            echo "<p>Registro alterado com sucesso !!!</p>";
        }
        if (@$_GET['alterar']) {
            $sql = "SELECT * FROM tb_turismo WHERE id_turismo = $_GET[alterar];";
            $resultado = mysqli_execute_query($conexao, $sql);
            $dados = mysqli_fetch_array($resultado);
            echo '
        <form action="alterar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="txtID" value="' . $dados[0] . '">
        <label for="txtTitulo">Titulo: </label>
        <input type="text" name="txtTitulo" id="txtTitulo" value="' . $dados[1] . '">
        <br>
        <label for="txtInformacoes">Informações: </label>
        <input type="text" name="txtInformacoes" id="txtInformacoes" value="' . $dados[4] . '">
        <br>
        <label for="txtEndereco">Endereço: </label>
        <input type="text" name="txtEndereco" id="txtEndereco" value="' . $dados[2] . '">
        <br>
        <label for="txtTelefone">Telefone: </label>
        <input type="text" name="txtTelefone" id="txtTelefone" value="' . $dados[5] . '">
        <br>
        <label for="inputImagem">Imagem</label>
        <input type="file" name="inputImagem" id="inputImagem">
        <br>
        <input type="submit" value="Alterar" name="btnAlterar" id=btnalterar>
        <input type="submit" value="Cancelar" name="btnCancelar" id=btncancelar onclick="window.location.href=\'alterar.php?alterar=' . $dados[0] . '\';">

        </form>
        ';
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
            <a href='alterar.php?alterar=$dados[0]'>Alterar</a>
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