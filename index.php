<?php
include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Pinhal</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>

<body>
    <div id="pagina_principal">
        <header>
            <img src="img/logo_qr_pinhal.png" alt="logo_qr_pinhal">
            <h1>
                QR Pinhal
            </h1>

        </header>
        <div id="img_principal">
            <h1>Historia de Espirito Santo do Pinhal
            </h1>
            <img src="img/Portal-de-entrada-de-Espirito-Santo-do-Pinhal.jpeg" alt="Portal-de-entrada-de-Espirito-Santo-do-Pinhal.png">
            <p>Espírito Santo do Pinhal foi fundada em 1849, após disputas por terras com tiroteios e ameaças entre os envolvidos, por Romualdo de Sousa Brito, feitor natural de Mogi das Cruzes que, tendo trabalhado em Mogi Mirim, veio para a região da Fazenda do Pinhal em 1826.
                As terras dessa cidade pertenciam à referida Fazenda do Pinhal, antiga Sesmaria. Tratava-se de uma enorme fazenda dominada pela árvore araucária, nascentes e florestas exuberantes.
                Em 1902 o município participou da chamada Revolta de Ribeirãozinho, movimento conservador que ocorreu na cidade de Ribeirãozinho (hoje Taquaritinga), em São Paulo, e que tinha como objetivo fundamental a restauração da monarquia e a coroação de Dom Luiz de Orleans e Bragança.</p>
        </div>
        <nav>
            <h1>
                Categorias
            </h1>
        </nav>
        <div class="categorias">
            <?php
            $sql = "SELECT id_categoria, nome FROM tb_categoria ORDER BY nome";
            $consulta = mysqli_execute_query($conexao, $sql);
            $botoes_filtro = "<a href='index.php'>Todos</a>";
            while ($dados = mysqli_fetch_assoc($consulta)) {
                $botoes_filtro .= "<a class='filtrer 'href='?cat={$dados['id_categoria']}'>{$dados['nome']}</a>";
            }
            echo $botoes_filtro;
            ?>
        </div>
        <main>
            <div id="artigo">
                <?php
                // Determina a página atual
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $limit = 6;  // Limitar a 6 artigos por página
                $offset = ($page - 1) * $limit;

                // Verifica a categoria (se fornecida)
                $cat_filter = '';
                if (isset($_GET['cat'])) {
                    $cat_filter = "AND tb_turismo.id_categoria = " . (int)$_GET['cat'];
                }

                // Consulta SQL com LIMIT e OFFSET
                $sql = "SELECT tb_turismo.id_turismo, tb_turismo.titulo, tb_turismo.endereco, tb_turismo.imagem, 
                    tb_turismo.informacoes, tb_turismo.telefone, tb_categoria.nome 
                    FROM tb_turismo 
                    JOIN tb_categoria ON tb_turismo.id_categoria = tb_categoria.id_categoria
                    WHERE 1 {$cat_filter} 
                    ORDER BY tb_turismo.id_turismo DESC 
                    LIMIT $limit OFFSET $offset";

                $consulta = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($consulta) == 0) {
                    echo "<h1>❌ Não existe nenhum artigo registrado.</h1>";
                } else {
                    while ($dados = mysqli_fetch_assoc($consulta)) {
                        echo "
                    <article onclick=\"window.location='detalhes.php?id={$dados['id_turismo']}'\">                                       
                    <img src='img/dados_imagem/{$dados['imagem']}' style='width:65%;border-radius:20px'>
                    <br><br>
                        <h1>{$dados['titulo']}</h1>
                        <h5>{$dados['endereco']}</h5>
                        <h5>{$dados['nome']}</h5>
                        <br><br>
                    </article>
                    ";
                    }
                }
                ?>
            </div>
            <div id="paginacao">
                <?php
                // Calcular o total de páginas
                $sql_count = "SELECT COUNT(*) as total FROM tb_turismo WHERE 1 {$cat_filter}";
                $count_result = mysqli_query($conexao, $sql_count);
                $total_rows = mysqli_fetch_assoc($count_result)['total'];
                $total_pages = ceil($total_rows / $limit);

                // Exibir a navegação por abas
                $cat_param = isset($_GET['cat']) ? "&cat=" . intval($_GET['cat']) : "";

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?page=$i$cat_param' class='page-num'>$i</a> ";
                }
                ?>
            </div>
        </main>
        <footer>
            <p>Todos os direitos reservados. 2025</p>
            <a href="login.php">⚙️ Area Administrativa</a>
        </footer>
    </div>
</body>


</html>