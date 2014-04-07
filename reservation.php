<html>
<body>

<?php
		//muodostetaan yhteys tietokantapalvelimeen
		$yhteys = mysql_connect("127.4.52.2:3306","VaraUser", "Varaus") or die("Yhdistäminen ei onnistunut!");
		//valitaan tietokanta "testidb"
		mysql_select_db("testidb", $yhteys) or die("Tietokantaa ei löytynyt!");
		echo terve;
		//haetaan kaikki tietueet
		$kyselyvara = "SELECT * FROM elokuva";
		$kyselyauth = "SELECT * FROM kayttajat";
		
		//suoritetaan kyselyt
		$hakuvara = mysql_query($kyselyvara, $yhteys);
		$hakuauth = mysql_query($kyselyauth, $yhteys);
		
		//tallennetaan muuttujaan edelliseltä sivulta saatu tieto
		$user = $_POST['userinfo'];
		//varauskoodi
		$koodi = "UPDATE elokuva SET lukumäärä=$uusiluku WHERE elokuva=$elokuvavara";
		
		//Tarkistetaan että käyttäjä joka tekee varausta löytyy tietokannasta
		
		for ($y = 0; $y < mysql_num_rows($hakuauth); $y++) {
		
						$tunnuskaksi= mysql_result($hakuauth, $y, "Tunnus");
						
						//Jos tietokannasta löytyy samanniminen käyttäjä niin toteutetaan
						if ($tunnuskaksi == $user) {
		
		
		// Tällä tehdään varaus
		foreach($_POST['checkbox'] as $key=>$value)
		{
		if($value=="on")
		{
			$elokuvavara = mysql_result($hakuvara, $key, "elokuva");
			$tyylilajivara = mysql_result($hakuvara, $key, "tyylilaji");
			$lukumäärävara = mysql_result($hakuvara, $key, "lukumäärä");
			$uusiluku = ($lukumäärävara - 1);
			
			echo $user;
			
			echo $elokuvavara;
			echo $uusiluku;
			if (!mysql_query("UPDATE elokuva SET lukumäärä=$uusiluku WHERE elokuva='$elokuvavara'"))
		{
			die('Error: ' . mysql_error($yhteys));
		}
		
			if (!mysql_query("INSERT INTO varatut VALUES('$elokuvavara','$user','1')"))
		{
			die('Error: ' . mysql_error($yhteys));
		}
		
		}
		
		}

		}
    }		
		
	mysql_close($yhteys);
	
	header('Location:index.php?username='.$user);
	?>
</body>
</html>