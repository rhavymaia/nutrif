<?php
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/constantes.php');
?>

<div class="container">
    <div id="letras">
        <p>
        <h1>
            <?php
            echo TL_RELATORIO;
            ?>
        </h1>
        </p>
    </div>
</div>

<div class="container">
    <div id="relatorio">
        
     <form action="trataRelatorio.php" method="POST">
        <?php
            
            $dao = new dao_class();

            $rowTodosEntrevistados = $dao->selectEntrevistados();
            
            /*
             *  Está aparecendo esse erro Rhavy: Fatal error: Call to undefined method dao_class::selectEntrevistados() in C:\wamp\www\NutrIF\relatorio.php on line 51
             * 
             */
            foreach ($rowTodosEntrevistados as $entrevistado) {
                 
                echo "Matricula: ".$entrevistado['nr_matricula'];
            }
        ?>

    </form>
    </div>
</div>
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>