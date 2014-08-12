<?php
    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabeçalho e menu da página html.
    require_once 'template/headerForm.php';
    require_once ('database/dao.class.php');
?>
    <div class="container">
    <div id="letras">
        <p>
        <h1>
            <?php
            echo TL_PESQUISAS;
            ?>
        </h1>
        </p>
    </div>
</div>
        <?php       
            $dao = new dao_class();
            
            $pesquisas = $dao->selecionarPesquisas();
            
            echo "<table>";
            echo "<th>Código</th>";
            echo "<th>Nome</th>";
            echo "<th>Adicionar Anamnese</th>";
            foreach ($pesquisas as $pesquisa) {                 
                echo "<tr>";
                echo "<td>".$pesquisa['cd_pesquisa']."</td>";
                echo "<td>".$pesquisa['nm_pesquisa']."</td>";
                echo "<td>";
                echo "<a href='formAnamnese.php'>link para a anamnese</a>";
                echo "</td>";
                echo "</tr>";
            }
             echo "</table>";
        ?> 

<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
