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
<?php
      echo ("<p>Resultado: ".$_SESSION['resultado']."</p>");
?>
<?php
    // Rodap� da p�gina html.
    require_once 'template/footer.php';
?>