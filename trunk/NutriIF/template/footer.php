               </div>
               <div id="footer">
			<div class="container">
				<ul id="fmenu">
					<li><a href="index.php">Home</a></li>
                                        <?php
                                        if (isset($_SESSION['id'])) {
					echo '<li><a href="formRegistroAntropometrico.php">Cadastro Antropométrico</a></li>
					<li><a href="formCalculaPercentilIMCIdade.php">Cálculo de Percentil</a></li>
                                        <li><a href="formListarEntrevistado.php">Procurar Entrevistado</a></li>
                                        <li><a href="formCalculaVCT.php">Cálculo do VCT</a></li>
                                        <p><li><a href="relatorio.php">Relatório de Entrevistados</a></li>
                                        <li><a href="formPerfilAlimentarEntrevistado.php">Perfil Alimentar</a></li>';
                                        }        
                                        
                                        if (!isset($_SESSION['id'])) {
                                        echo '<li><a href="formLogin.php">Login</a></li></p>';
                                        }else{
                                        echo '<li><a href="logout.php">Logout</a></li></p>';   
                                        }
                                        ?>        
				</ul>
                                
				<div id="credits">
                                    <div id="centralizar"><img src="images/logoif.png">
                                    <img src="images/gpl3.png"></div>
                                    <div class="clear"></div>
                                    <div class="clear"></div>
                                    NUTRIF  2013</div>
			</div>
                        <div class="clear">
                            <!-- Vazio -->
                        </div>
		</div>
	</body>
</html>
