<?php
// Cabeçalho e menu da página html.
require_once 'template/headerForm.php';
?>

<div class="container">
    <div id="letras">
        <p>
        <h1>
            <?php
            echo TL_QUESTIONARIO;
            ?>
        </h1>
        </p>
    </div>
  <div class="caixa_azul"> 
    <?php
      echo ("<p> Você atingiu ".$_SESSION['resultado']." pontos</p>");
      
      if ($_SESSION['resultado']<= 28){
          echo ("<p> Você precisa tornar sua alimentação e seus hábitos de vida"
                  . " mais saudáveis! Dê mais atenção à alimentação e atividade "
                  . "física.</p>");
      }elseif ($_SESSION['resultado']>= 29 && $_SESSION['resultado']<= 42) {
          echo ("<p> Fique atento com sua alimentação e outros hábitos como"
                  . " atividade física e consumo de líquidos.</p>");
       }elseif ($_SESSION['resultado']>43) {
            echo ("<p> Parabéns! Você está no caminho para o modo "
                    . "de vida saudável.</p>");
        }
        unset($_SESSION['erro']);
        
    ?>     
     
  </div>
    
</div>

    
<?php
    // Rodapé da página html.
    require_once 'template/footer.php';
?>