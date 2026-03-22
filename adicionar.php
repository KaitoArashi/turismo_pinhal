<?php
include_once 'conexao.php';
session_start();
if (!$_SESSION['usuario']) {
    header('Location: login.php');
    exit();
}

$sql = 'select * from tb_categoria';
$resposta = mysqli_execute_query($conexao, $sql);
$categorias = "<option value=''>Selecione</option>";
if (mysqli_num_rows($resposta) > 0) {
    while ($rows = mysqli_fetch_assoc($resposta)) {
        $categorias .= "<option value='{$rows['id_categoria']}'>{$rows['nome']}</option>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Pinhal - Adicionar Turismo</title>
    <link rel="stylesheet" href="style_adicionar.css">
</head>

<body>
    <div id="pagina_adicionar">
        <header>
            <h2>
                Adicionar Ponto Turistico
            </h2>
        </header>
        <div id="resposta">
            <?php
            if (@$_POST['btnCadastrar']) {
                $form_titulo = $_POST['txtTitulo'];
                $form_endereco = $_POST['txtEndereco'];
                $form_imagem = $_FILES['inputImagem'];
                $form_categoria = $_POST['slCategoria'];
                $form_informacoes = $_POST['txtInformacoes'];
                $form_telefone = $_POST['txtTelefone'];

                $nome_imagem = $form_imagem['name'];

                $res = move_uploaded_file($form_imagem['tmp_name'], 'img/dados_imagem/' . $nome_imagem);

                $sql = "INSERT INTO tb_turismo (titulo, endereco, imagem, informacoes, telefone, id_categoria) VALUES ('$form_titulo','$form_endereco','$nome_imagem','$form_informacoes','$form_telefone',$form_categoria)";
                try {
                    $resposta = mysqli_execute_query($conexao, $sql);
                    echo "Noticia adicionado com sucesso !!!";
                } catch (Exception $e) {
                    echo "Algo de errado nao esta certo :/ <br> $e";
                }
            }
            ?>
        </div>
        <div id="adicionar">
            <main>
                <div id="login">
                    <form action="adicionar.php" method="post" enctype="multipart/form-data">
                        <label for="txtTitulo">Titulo: </label>
                        <input type="text" name="txtTitulo" id="txtTitulo">
                        <br>
                        <label for="txtInformacoes">Informações: </label>
                        <input type="text" name="txtInformacoes" id="txtInformacoes">
                        <br>
                        <label for="txtEndereco">Endereço: </label>
                        <input type="text" name="txtEndereco" id="txtEndereco">
                        <br>
                        <label for="txtTelefone">Telefone: </label>
                        <input type="text" name="txtTelefone" id="txtTelefone" onkeyup="formatarTelefone(this)" maxlength="15" placeholder="()_____-____">
                        <br>
                        <label for="inputImagem">Imagem: </label>
                        <input type="file" name="inputImagem" id="inputImagem">
                        <br>
                        <label for="slCategoria">Categoria: </label>
                        <select id="slCategoria" name="slCategoria" >
                            <?= $categorias ?>
                        </select>
                        <br>
                        <input type="submit" value="Cadastrar" name="btnCadastrar" id="btnCadastrar">
                        <input type="reset" value="Limpar" name="btnLimpar" id="btnLimpar">
                    </form>
                </div>
            </main>

            <script>
                function formatarTelefone(input) {
                    // Remove todos os caracteres não numéricos
                    var telefone = input.value.replace(/\D/g, '');

                    // Se for DDD + 9 dígitos (celular)
                    if (telefone.length === 11) {
                        telefone = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                    }
                    // Se for DDD + 8 dígitos (fixo)
                    else if (telefone.length === 10) {
                        telefone = telefone.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                    }

                    // Atualiza o valor do campo de entrada com o telefone formatado
                    input.value = telefone;
                }
            </script>
        </div>
        <footer>
            <p>Conectado com Administrador: <?php echo $_SESSION['usuario']; ?></p>
            <a href="admin.php">← Voltar a Area Administrativa</a>
        </footer>
    </div>
</body>

</html>