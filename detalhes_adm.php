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
    <link rel="stylesheet" href="style_detalhes_adm.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>

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

        <div id="qrcode"></div>

    <footer>
        <p>Todos os direitos reservados. 2025</p>
        <a href="listar.php">← Voltar ao menu de listagem</a>
    </footer>
        <script>
        
        // Monta a URL atual com o ID
        var url = "https://qrpinhal.alwaysdata.net/detalhes.php?id=<?php echo $id; ?>";

        // Desenha o QR
        new QRCode(document.getElementById("qrcode"), {
            text: url,
            width: 180,
            height: 180
        });
    </script>
</body>

</html>