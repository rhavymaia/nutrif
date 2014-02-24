<?php
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/constantes.php');
    require_once ('funcoesPercentil.php');
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
        
        <?php
        
        $qtd_magreza= 0;
        $qtd_eutrofia=0;
        $qtd_sobrepeso=0;
        $qtd_obesidade=0;
        $qtd_obesidade_morbida=0;
        
        $dao = new dao_class();

            $entrevistados = $dao->selectEntrevistados();
            
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
          
            echo "<table>";
            echo "<tr>";
            echo "<th>Magreza</th>";
            echo "<th>Eutrofia</th>";
            echo "<th>Sobrepeso</th>";
            echo "<th>Obesidade</th>";
            echo "<th>Obesidade Mórbida</th>";
            echo "</tr>";
           
          foreach ($entrevistados as $entrevistado) { 
                
              $dados = consultarEntrevistado($entrevistado['nr_matricula']);
              $percentilEntrevistado = calcularPercentil($dados);
              
              if (isset($percentilEntrevistado[0]) || 
                      isset($percentilEntrevistado[1]) 
                      || isset($percentilEntrevistado[2])) {
                           
                    if ($percentilEntrevistado[0]) {
                       echo "oi";
                    } else if (($percentilEntrevistado[1]) || 
                            ($percentilEntrevistado[2])) {

                        if ($percentilEntrevistado[2])
                            echo "oi";
                        if ($percentilEntrevistado[1])
                            echo "oi";
                            }          
          }else{
               if ($percentilEntrevistado[3]== PERFIL_MAGREZA) {
                    $qtd_magreza++;
            } else if ($percentilEntrevistado[3]== PERFIL_EUTROFICO) {
                
                $qtd_eutrofia++;
            } else if ($percentilEntrevistado[3]== PERFIL_SOBREPESO) {
               
                $qtd_sobrepeso++;
            } else if ($percentilEntrevistado[3]== PERFIL_OBESO) {
               
                $qtd_obesidade++;
            } else if ($percentilEntrevistado[3]== PERFIL_OBESO_MORBIDO) {
                
                $qtd_obesidade_morbida++;
            }
          }
          
        }
        echo "<tr>";
                echo "<td>";
                echo $qtd_magreza;
                echo "</td>";
                echo "<td>";
                echo $qtd_eutrofia;
                echo "</td>";
                echo "<td>";
                echo $qtd_sobrepeso; 
                echo "</td>";
                echo "<td>";
                echo $qtd_obesidade;
                echo "<td>";
                echo $qtd_obesidade_morbida;
                echo "</td>";
                echo "</tr>";
        
            
            echo "</table>";
?>

    </form>
    </div>
</div>
    
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>