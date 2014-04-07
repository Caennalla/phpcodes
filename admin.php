<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">     


		
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fi" lang="fi">       
  <head>    
	
    <title>Työvuorolistat</title>       
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
	<!--yläpalkki-->
	<div class="clear"></div>
			<div class="grid_16">
				<ul class="nav main">
					<li>
						<li><a href="http://mysqltest-juhotestaus.rhcloud.com/index.php?username=<?php echo $user;?>">Vuokraamo</a></li>					
					</li>
					
				</ul>
				</div>	
				
	<div class="grid_10">
					<h2>
						Työvuorolista
					</h2>
	<!--taulukko-->
    <p>     
      <?php
		
		
		//muodostetaan yhteys tietokantapalvelimeen
		$yhteys = mysql_connect("127.4.52.2:3306","$user") or die("Yhdistäminen ei onnistunut!");

		//valitaan tietokanta "testidb"
		mysql_select_db("testidb", $yhteys) or die("Tietokantaa ei löytynyt!");

	
		//haetaan kaikki tietueet
		
		$kysely = "SELECT * FROM tyovuorot";
		$kyselykaksi = "SELECT * FROM tyontekijat";
		//suoritetaan kyselyt
		
		$haku = mysql_query($kysely, $yhteys);
		$hakukaksi = mysql_query($kyselykaksi, $yhteys);
		
		echo "<table border>";
		echo "<tr><th><b>Etunimi</b></th><th><b>Sukunimi</b></th><th><b>Työpäivä</b></th></tr>";
		//käydään listat läpi
		
		for ($i = 0; $i < mysql_num_rows($haku); $i++) {
		//haetaan päivämäärä ja tunnus
		$paivamaara = mysql_result($haku, $i, "pvm");
		$tunnus = mysql_result($haku, $i, "Tunnus");
		
			//Haetaan sukunimi tunnukselle
			for ($z = 0; $z < mysql_num_rows($hakukaksi); $z++) {
			$etunimi = mysql_result($hakukaksi, $z, "Etunimi");
			$sukunimi = mysql_result($hakukaksi, $z, "Sukunimi");
			
			if ($etunimi == $tunnus)
			{
				$sukunimitaulu = $sukunimi;
			}
		
		
			}
		//tulostetaan taulukko

			echo "<tr><td>$tunnus</td><td>$sukunimitaulu</td><td>$paivamaara</td></tr>";
			
		}
		
		echo "</table>";
		mysql_close($yhteys);
		
		?>		
		
		</p>
	 
		
	</div>
	<div class="grid_6">
					
					<h2>
						Työntekijät
					</h2>
					<p>
					<?php
						
											//muodostetaan yhteys tietokantapalvelimeen
						$yhteyskolme = mysql_connect("127.4.52.2:3306","$user") or die("Yhdistäminen ei onnistunut!");

						//valitaan tietokanta "testidb"
						mysql_select_db("testidb", $yhteyskolme) or die("Tietokantaa ei löytynyt!");
						
						
						//haetaan kaikki tietueet
						$kyselykolme = "SELECT * FROM tyontekijat";
						//suoritetaan kysely
						$hakukolme = mysql_query($kyselykolme, $yhteyskolme);
					
						echo "<table border>";
						echo "<tr><td><b>Etunimi</b></td><td><b>Sukunimi</b></td></tr>";
						//käydään työntekijät
						for ($y = 0; $y < mysql_num_rows($hakukolme); $y++) {
						//haetaan etunimi ja sukunimi
						$enimi = mysql_result($hakukolme, $y, "Etunimi");
						$snimi= mysql_result($hakukolme, $y, "Sukunimi");
					

							echo "<tr><td>$enimi</td><td>$snimi</td></tr>";
						}
						echo "</table>";
						mysql_close($yhteyskolme);
						?>
					
						</p>
				</div>
	</div>
  </body>       
</html>