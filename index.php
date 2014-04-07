<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">     


		
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fi" lang="fi">       
  <head>    
	
    <title>Elokuvavuokraamo</title>       
    <meta http-equiv="content-type"       
        content="text/html; charset=ISO-8859"/>     
	<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
	<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
  </head>       
  <body>  
	<?php	
		$user = htmlspecialchars($_GET["username"]);

		
		?>
	<div class="container_16">
	<!--otsikko-->
	<div class="grid_16">
	<h1 id="branding"> Elokuvavuokraamo </h1>
	</div>
	<!--yl‰palkki-->
	<div class="clear"></div>
			<div class="grid_16">
				<ul class="nav main">
				


					<li><a href="http://mysqltest-juhotestaus.rhcloud.com/admin.php?username=<?php echo $user;?>">Tyˆvuorolistat</a></li>";
				
				</ul>
					
			</div>	

	<div class="box articles">
				<!--Vasen palkki-->
				<div class="grid_2">
					<h2>
						Kirjautuminen
					</h2>
					<!--Kirjautumisboxi-->
					<div class="block" id="forms">
						<form action="">
							<fieldset class="login">
								<legend>Kirjautuminen</legend>
								<p>
									<label>K‰ytt‰j‰nimi: </label>
									<input type="text" name="username" value="" />
								</p>
								
								<input class="confirm button" type="submit" value="Kirjaudu" />
							</fieldset>
							</form>
							<p>
				
							</div>
							<!-- Rekisterˆitymisboxi-->
					<div class="block" id="forms">
						<form action="register.php" method="post">
							<fieldset class="login">
								<legend>Luo uusi</legend>
								<p>
									<label>K‰ytt‰j‰nimi: </label>
									<input type="text" name="tunnus" value="">
								</p>
								<p>
									<label>Etunimi: </label>
									<input type="text" name="enimi" value="">
								</p>
								<p>
									<label>Sukunimi: </label>
									<input type="text" name="snimi" value="">
								</p>
								
								<input class="confirm button" type="submit" value="Kirjaudu">
							</fieldset>
							</form>
							</div>
				</div>
	<div class="grid_8">
					<h2>
						Vuokrattavat elokuvat
					</h2>
	<!--taulukko-->
    <p>     
      <?php
		
		
		//muodostetaan yhteys tietokantapalvelimeen
		$yhteys = mysql_connect("127.4.52.2:3306","$user") or die("Yhdist‰minen ei onnistunut!");

		//valitaan tietokanta "testidb"
		mysql_select_db("testidb", $yhteys) or die("Tietokantaa ei lˆytynyt!");

		//t‰h‰n tulevat tietokantakyselyt!
		
		//haetaan kaikki tietueet
		$kysely = "SELECT * FROM elokuva";
		//suoritetaan kysely
		$haku = mysql_query($kysely, $yhteys);
		
		?>
		<form method="post" action = "reservation.php">
		
		<?php
		echo "<table border>";
		echo "<tr><th><b>nimi</b></th><th><b>tyyli</b></th><th><b>lukum‰‰r‰</b></th><th><b>Varaa</b></th></tr>";
		//k‰yd‰‰n tavarat l‰pi
		for ($i = 0; $i < mysql_num_rows($haku); $i++) {
		//haetaan nimi, hinta ja m‰‰r‰ muuttujiin
		$elokuva = mysql_result($haku, $i, "elokuva");
		$tyylilaji = mysql_result($haku, $i, "tyylilaji");
		$lukum‰‰r‰ = mysql_result($haku, $i, "lukum‰‰r‰");

		//tulostetaan taulukon rivi jos lukum‰‰r‰ != 0
		if ($lukum‰‰r‰ != 0) {
			echo "<tr><td>$elokuva</td><td>$tyylilaji</td><td>$lukum‰‰r‰</td><td><input type=\"checkbox\" name=\"checkbox[$i]\"></td></tr>";
			}
		}
		
		echo "</table>";
		mysql_close($yhteys);
		?>
		<input type="hidden" value="<?php echo $user?>" name="userinfo">
		<input type="submit" value="Varaa">
		</form>
		
		
		</p>
	 
		
	</div>
	<div class="grid_6">
					<h2>
						Omat tiedot
					</h2>
					<p>
					<?php
						
											//muodostetaan yhteys tietokantapalvelimeen
						$yhteyskaksi = mysql_connect("127.4.52.2:3306","$user") or die("Yhdist‰minen ei onnistunut!");

						//valitaan tietokanta "testidb"
						mysql_select_db("testidb", $yhteyskaksi) or die("Tietokantaa ei lˆytynyt!");
						
						
						//haetaan kaikki tietueet
						$kyselykaksi = "SELECT * FROM kayttajat";
						//suoritetaan kysely
						$hakukaksi = mysql_query($kyselykaksi, $yhteyskaksi);
						
						echo "<table border>";
						echo "<tr><td><b>Tunnus</b></td><td><b>Etunimi</b></td><td><b>Sukunimi</b></td></tr>";
						//k‰yd‰‰n k‰ytt‰j‰t l‰pi
						for ($b = 0; $b < mysql_num_rows($hakukaksi); $b++) {
						//haetaan nimi, hinta ja m‰‰r‰ muuttujiin
						$tunnus = mysql_result($hakukaksi, $b, "Tunnus");
						$etunimi = mysql_result($hakukaksi, $b, "Etunimi");
						$sukunimi = mysql_result($hakukaksi, $b, "Sukunimi");

						//tulostetaan taulukon rivi jos lukum‰‰r‰ != 0
						if ($tunnus == $user) {
							echo "<tr><td>$tunnus</td><td>$etunimi</td><td>$sukunimi</td></tr>";
							}
						}
						echo "</table>";
						mysql_close($yhteyskaksi);
						?>
						</p>
					<h2>
						Vuokratut
					</h2>
					<?php
						
											//muodostetaan yhteys tietokantapalvelimeen
						$yhteyskolme = mysql_connect("127.4.52.2:3306","$user") or die("Yhdist‰minen ei onnistunut!");

						//valitaan tietokanta "testidb"
						mysql_select_db("testidb", $yhteyskolme) or die("Tietokantaa ei lˆytynyt!");
						
						
						//haetaan kaikki tietueet
						$kyselykolme = "SELECT * FROM varatut";
						//suoritetaan kysely
						$hakukolme = mysql_query($kyselykolme, $yhteyskolme);
						?>
						<form method="post" action = "returnal.php">
						<?php
						echo "<table border>";
						echo "<tr><td><b>Elokuva</b></td><td><b>Tunnus</b></td><td><b>Lukum‰‰r‰</b></td><b><td>Palauta</td></b></tr>";
						//k‰yd‰‰n k‰ytt‰j‰t l‰pi
						for ($y = 0; $y < mysql_num_rows($hakukolme); $y++) {
						//haetaan nimi, hinta ja m‰‰r‰ muuttujiin
						$elokuvakaksi = mysql_result($hakukolme, $y, "elokuva");
						$tunnuskaksi= mysql_result($hakukolme, $y, "Tunnus");
						$lukum‰‰r‰kaksi = mysql_result($hakukolme, $y, "lukum‰‰r‰");

						//tulostetaan taulukon rivi jos lukum‰‰r‰ != 0
						if ($tunnuskaksi == $user) {
							echo "<tr><td>$elokuvakaksi</td><td>$tunnuskaksi</td><td>$lukum‰‰r‰kaksi</td><td><input type=\"checkbox\" name=\"check[$y]\"></td></tr>";
							}
						}
						echo "</table>";
						mysql_close($yhteyskolme);
						?>
						<input type="hidden" value="<?php echo $user?>" name="userinfo">
						<input type="submit" value="Palauta">
						</form>
						</p>
				</div>
	</div>
  </body>       
</html>