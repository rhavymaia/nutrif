<?php
    require_once 'template/headerForm.php';
?>

    <form action ="trataFormCadastroNutricionista.php" method="post">
        Nome: <input type ="text" name="nm_nutricionista" ></br>
        Institui��o: <input type ="text" name="instituicao" ></br>
        CRN: <input type="text" name="crn">
        
    </form>

<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>
