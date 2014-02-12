<?php
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/constantes.php');
    require_once 'template/headerForm.php';
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
             *  Está aparecendo esse erro Rhavy: Fatal error: Call to undefined method dao_class::selectEntrevistados() in C:\wamp\www\NutrIF\relatorio.php on line 51
             * 
             */
            foreach ($entrevistados as $entrevistado) {
                echo '<div class="caixa_azul">';               
                echo "Matricula: ".$entrevistado['nr_matricula'];
               // echo '</div>';
               // echo '<div class="caixa_azul">';  
                echo " | Código: ".$entrevistado['cd_entrevistado'];
               // echo '</div>';
               // echo '<div class="caixa_azul">';  
                echo " | Nascimento: ".$entrevistado['dt_nascimento'];
                //echo '</div>';
                //echo '<div class="caixa_azul">';  
                echo " | Peso: ".$entrevistado['nr_peso']."<br>"; 
                echo '</div>';
            }
        ?>

    </form>
    </div>
</div>
    
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>