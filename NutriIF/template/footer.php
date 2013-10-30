               </div>
               <div id="footer">
			<div class="container">
				<ul id="fmenu">
					<li><a href="index.php">Home</a></li>
                                        <?php
                                        if (isset($_SESSION['id'])) {
					echo '<li><a href="formRegistroAntropometrico.php">Cadastro Antropométrico</a></li>
					<li><a href="formCalculaPercentilIMCIdade.php">Cálculo de Percentil</a></li>
                                        <li><a href="formListagem.php">Listagem</a></li><li><a href="relatorio.php">Relatório</a></li>';
                                        }        
                                        
                                        if (!isset($_SESSION['id'])) {
                                        echo '<li><a href="login.php">Login</a></li>';
                                        }else{
                                        echo '<li><a href="logout.php">Logout</a></li>';   
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
