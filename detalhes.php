<?php
include 'conexao.php';

// Pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Busca os detalhes do artigo
$sql = "SELECT titulo, endereco, imagem, informacoes, telefone FROM tb_turismo WHERE id_turismo = $id";
$consulta = mysqli_execute_query($conexao, $sql);
$dados = mysqli_fetch_assoc($consulta);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>QR Pinhal - <?= htmlspecialchars($dados['titulo']) ?></title>
    <link rel="stylesheet" href="style_detalhes.css">

<body>
    <header>
        <img src="img/logo_qr_pinhal.png" alt="logo_qr_pinhal">
        <h1>
            QR Pinhal
        </h1>

    </header>
    <?php if ($dados): ?>
        <?php
        echo '
<article>
<nav>
    <h1>' . htmlspecialchars($dados["titulo"]) . '</h1>
</nav>
    <div id="img_principal">
        <img src="img/dados_imagem/' . htmlspecialchars($dados['imagem']) . '" alt="Imagem do artigo">
         <p>' . nl2br(htmlspecialchars($dados["informacoes"])) . '</p>
    </div>
    <div id="local_contato">
    <h4>-' . nl2br(htmlspecialchars($dados["endereco"])) . '</h4>
<h4>' .
            (empty($dados["telefone"])
                ? "- Não possui telefone"
                : nl2br(htmlspecialchars($dados["telefone"])))
            . '</h4>

    </div>
</article>
';

        ?>
    <?php else: ?>
        <h2>Artigo não encontrado.</h2>
    <?php endif; ?>

    <footer>
        <p>Todos os direitos reservados. 2025</p>
        <a href="index.php">← Voltar ao menu principal</a>
    </footer>
</body>

</html>