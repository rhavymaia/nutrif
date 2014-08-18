<?php
    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabeçalho e menu da página html.
    require_once 'template/headerForm.php';
    require_once ('database/dao.class.php');
?>
    <div class="container">
    <div id="letras">
        <p>
        <h1>
            <?php
            echo TL_PESQUISAS;
            ?>
        </h1>
        </p>
    </div>
</div>

<div id="centralizar">
<div class="caixa_azul">
<form id="listarpesquisas" name="form1" method="post" action="formAnamnese.php">
         Selecione uma pesquisa:
        <?php
            $dao = new dao_class();
            $pesquisas = $dao->selecionarPesquisas();
        ?> 
           
             <input type="submit" value="Nova anamnese"> 
             
            <select name="pesquisa" id="pesq"> Selecione uma pesquisa:
                <?php
                   foreach ($pesquisas as $pesquisa){
                       echo("<option value='".$pesquisa['cd_pesquisa']."'>".$pesquisa['nm_pesquisa']."</option>");
                   }                  
                ?>
            </select>

</form>
</div>
</div>

<div class="clear">
    <!-- Vazio -->
</div>

<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
