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
            echo "<table>";
            echo "<tr>";
            echo "<th>Matrícula</th>";
            echo "<th>Código</th>";
            echo "<th>Nascimento</th>";
            echo "<th>Peso</th>";
            echo "</tr>"; 
            
            foreach ($entrevistados as $entrevistado) { 
                
                echo "<tr>";
                echo "<td>";
                echo $entrevistado['nr_matricula'];
                echo "</td>";
                echo "<td>";
                echo $entrevistado['cd_entrevistado'];
                echo "</td>";
                echo "<td>";
                echo $entrevistado['dt_nascimento']; 
                echo "</td>";
                echo "<td>";
                echo $entrevistado['nr_peso']."<br>"; 
                echo "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
        ?>

    </form>
    </div>
</div>
    
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>