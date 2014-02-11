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

            $entrevistados = $dao->selectEntrevistados();
            
            /*
             *  Est� aparecendo esse erro Rhavy: Fatal error: Call to undefined method dao_class::selectEntrevistados() in C:\wamp\www\NutrIF\relatorio.php on line 51
             * 
             */
            foreach ($entrevistados as $entrevistado) {                
                echo "Matricula: ".$entrevistado['nr_matricula'];
                echo "C�digo: ".$entrevistado['cd_entrevistado'];
                echo "Nascimento: ".$entrevistado['dt_nascimento'];
                echo "Nascimento: ".$entrevistado['nr_peso']."<br>";                
            }
        ?>

    </form>
    </div>
</div>
<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>