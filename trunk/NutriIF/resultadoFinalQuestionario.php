<?php
// Cabe�alho e menu da p�gina html.
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
      echo ("<p> Voc� atingiu ".$_SESSION['resultado']." pontos</p>");
      
      if ($_SESSION['resultado']<= 28){
          echo ("<p> Voc� precisa tornar sua alimenta��o e seus h�bitos de vida"
                  . " mais saud�veis! D� mais aten��o � alimenta��o e atividade "
                  . "f�sica.</p>");
      }elseif ($_SESSION['resultado']>= 29 && $_SESSION['resultado']<= 42) {
          echo ("<p> Fique atento com sua alimenta��o e outros h�bitos como"
                  . " atividade f�sica e consumo de l�quidos.</p>");
       }elseif ($_SESSION['resultado']>43) {
            echo ("<p> Parab�ns! Voc� est� no caminho para o modo "
                    . "de vida saud�vel.</p>");
        }
        unset($_SESSION['erro']);
        
    ?>     
     
  </div>
    
</div>

    
<?php
    // Rodap� da p�gina html.
    require_once 'template/footer.php';
?>