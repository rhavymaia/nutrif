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
        
        /**
         * Valores referentes ao imc
         */
        $qtd_magreza= 0;
        $qtd_eutrofia=0;
        $qtd_sobrepeso=0;
        $qtd_obesidade=0;
        $qtd_obesidade_morbida=0;
        
        $qtd_percentil_magreza_acentuada = 0;
        $qtd_percentil_magreza = 0;
        $qtd_percentil_eutrofia = 0;
        $qtd_percentil_sobrepeso = 0;
        $qtd_percentil_obesidade = 0;
        $qtd_percentil_obesidade_grave = 0;
        
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
               
            
            foreach ($entrevistados as $entrevistado) {

            $dados = consultarEntrevistado($entrevistado['nr_matricula']);
            $percentilEntrevistado = calcularPercentil($dados);

            if (!ehVazio($percentilEntrevistado['percentilMediano']) 
                    || !ehVazio($percentilEntrevistado['percentilInferior']) 
                    || !ehVazio($percentilEntrevistado['percentilSuperior'])) {

                if (!ehVazio($percentilEntrevistado['percentilMediano'])) {
                    
                    if ($percentilEntrevistado['percentilMediano'] < 0.1)
                        $qtd_percentil_magreza_acentuada++;
                    else
                    if (!ehVazio($percentilEntrevistado['percentilMediano'] >= 0.1 && 
                            ($percentilEntrevistado['percentilMediano'] < 3)))
                        $qtd_percentil_magreza++;
                    else
                    if (($percentilEntrevistado['percentilMediano'] >= 3 && 
                            ($percentilEntrevistado['percentilMediano'] <= 85)))
                        $qtd_percentil_eutrofia++;
                    else
                    if (($percentilEntrevistado['percentilMediano'] >= 85 && 
                            ($percentilEntrevistado['percentilMediano'] <= 97)))
                        $qtd_percentil_sobrepeso++;
                    else
                    if (($percentilEntrevistado['percentilMediano'] > 97) && 
                            ($percentilEntrevistado['percentilMediano'] <= 99.9))
                        $qtd_percentil_obesidade++;
                    else
                    if ($percentilEntrevistado['percentilMediano'] > 99.9)
                        $qtd_percentil_obesidade_grave++;               
                    
                } else if(!ehVazio($percentilEntrevistado['percentilInferior']) 
                        && !ehVazio($percentilEntrevistado['percentilSuperior'])) {
                    
                    if ($percentilEntrevistado['percentilInferior'] < 0.1)
                        $qtd_percentil_magreza_acentuada++;
                    else
                    if (($percentilEntrevistado['percentilInferior'] >= 0.1 && 
                            ($percentilEntrevistado['percentilSuperior'] < 3)))
                        $qtd_percentil_magreza++;
                    else
                    if (($percentilEntrevistado['percentilInferior'] >= 3 && 
                            ($percentilEntrevistado['percentilSuperior'] <= 85)))
                        $qtd_percentil_eutrofia++;
                    else
                    if (($percentilEntrevistado['percentilInferior'] >= 85 && 
                            ($percentilEntrevistado['percentilSuperior'] <= 97)))
                        $qtd_percentil_sobrepeso++;
                    else
                    if (($percentilEntrevistado['percentilInferior'] > 97) && 
                            ($percentilEntrevistado['percentilSuperior'] <= 99.9))
                        $qtd_percentil_obesidade++;
                    else
                    if ($percentilEntrevistado['percentilSuperior'] > 99.9)
                        $qtd_percentil_obesidade_grave++; 
                    
                    
                  } else if (!ehVazio($percentilEntrevistado['percentilInferior']) 
                        && ehVazio($percentilEntrevistado['percentilSuperior'])){
                      
                    if ($percentilEntrevistado['percentilInferior'] < 0.1)
                        $qtd_percentil_magreza_acentuada++;
                    else
                    if (!ehVazio($percentilEntrevistado['percentilInferior'] >= 0.1 && 
                            ($percentilEntrevistado['percentilInferior'] < 3)))
                        $qtd_percentil_magreza++;
                    else
                    if (($percentilEntrevistado['percentilInferior'] >= 3 && 
                            ($percentilEntrevistado['percentilInferior'] <= 85)))
                        $qtd_percentil_eutrofia++;
                    else
                    if (($percentilEntrevistado['percentilInferior'] >= 85 && 
                            ($percentilEntrevistado['percentilInferior'] <= 97)))
                        $qtd_percentil_sobrepeso++;
                    else
                    if (($percentilEntrevistado['percentilInferior'] > 97) && 
                            ($percentilEntrevistado['percentilInferior'] <= 99.9))
                        $qtd_percentil_obesidade++;
                    else
                    if ($percentilEntrevistado['percentilInferior'] > 99.9)
                        $qtd_percentil_obesidade_grave++; 
                      
                  } else if (!ehVazio($percentilEntrevistado['percentilSuperior']) 
                        && ehVazio($percentilEntrevistado['percentilInferior'])){
                      
                    if ($percentilEntrevistado['percentilSuperior'] < 0.1)
                        $qtd_percentil_magreza_acentuada++;
                    else
                    if (($percentilEntrevistado['percentilSuperior'] >= 0.1 && 
                            ($percentilEntrevistado['percentilSuperior'] < 3)))
                        $qtd_percentil_magreza++;
                    else
                    if (($percentilEntrevistado['percentilSuperior'] >= 3 && 
                            ($percentilEntrevistado['percentilSuperior'] <= 85)))
                        $qtd_percentil_eutrofia++;
                    else
                    if (($percentilEntrevistado['percentilSuperior'] >= 85 && 
                            ($percentilEntrevistado['percentilSuperior'] <= 97)))
                        $qtd_percentil_sobrepeso++;
                    else
                    if (($percentilEntrevistado['percentilSuperior'] > 97) && 
                            ($percentilEntrevistado['percentilSuperior'] <= 99.9))
                        $qtd_percentil_obesidade++;
                    else
                    if ($percentilEntrevistado['percentilSuperior'] > 99.9)
                        $qtd_percentil_obesidade_grave++; 
                        
                  } 
            }else {
                if ($percentilEntrevistado['perfilIMC'] == PERFIL_MAGREZA) {
                    $qtd_magreza++;
                } else if ($percentilEntrevistado['perfilIMC'] == PERFIL_EUTROFICO) {
                    $qtd_eutrofia++;
                } else if ($percentilEntrevistado['perfilIMC'] == PERFIL_SOBREPESO) {
                    $qtd_sobrepeso++;
                } else if ($percentilEntrevistado['perfilIMC'] == PERFIL_OBESO) {
                    $qtd_obesidade++;
                } else if ($percentilEntrevistado['perfilIMC'] == PERFIL_OBESO_MORBIDO) {
                    $qtd_obesidade_morbida++;
                }
            }
        }
        
            echo "<table>";
            echo "<tr>";
            echo "<th>Magreza</th>";
            echo "<th>Eutrofia</th>";
            echo "<th>Sobrepeso</th>";
            echo "<th>Obesidade</th>";
            echo "<th>Obesidade mórbida</th>";
            echo "</tr>";
            
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
            
            echo "<table>";
            echo "<tr>";
            echo "<th>Magreza</th>";
            echo "<th>Magreza acentuada</th>";
            echo "<th>Eutrofia</th>";
            echo "<th>Sobrepeso</th>";
            echo "<th>Obesidade</th>";
            echo "<th>Obesidade acentuada</th>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td>";
            echo $qtd_percentil_magreza;
            echo "</td>";
            echo "<td>";
            echo $qtd_percentil_magreza_acentuada;
            echo "</td>";
            echo "<td>";
            echo $qtd_percentil_eutrofia; 
            echo "</td>";
            echo "<td>";
            echo $qtd_percentil_sobrepeso;
            echo "</td>";
            echo "<td>";
            echo $qtd_percentil_obesidade;
            echo "</td>";
            echo "<td>";
            echo $qtd_percentil_obesidade_grave;            
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