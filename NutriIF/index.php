<?php
// Cabeçalho e menu da página html.
require_once 'template/header.php';
require_once 'validate/erro.php';
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/coin-slider.css" />
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-georgia.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/coin-slider.min.js"></script>

<div id="centralizar">
    <div id="content">
        <div class="inside">
            <div class="slider">
                <div id="coin-slider"> 
                    <img src="images/slide1.jpg" width="960" height="360" alt="" />
                    <img src="images/slide2.jpg" width="960" height="360" alt="" />
                    <img src="images/slide3.jpg" width="960" height="360" alt="" />
                </div>
                <div class="clear"></div>
            </div>
            <p> 
                Software para obter o perfil alimentar e antropométrico, 
                individual e coletivo, dos estudantes do Instituto Federal 
                de Educação, Ciência e Tecnologia da Paraíba, campus Campina 
                Grande, a fim de auxiliar o nutricionista na definição da 
                quantidade calórica média das refeições do Restaurante Estudantil. 
            </p>
        </div>
    </div>
</div>
 

<div id="centralizar">
    <div id="content">
        <a href="formCadastrarAluno.php">
        <input name="" type="button" 
               value="Cadastre-se já"></a>
    </div>
</div>
 
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
