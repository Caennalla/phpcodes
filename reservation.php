<html>
<body>

<?php
		//muodostetaan yhteys tietokantapalvelimeen
		$yhteys = mysql_connect("127.4.52.2:3306","VaraUser", "Varaus") or die("Yhdist�minen ei onnistunut!");
		//valitaan tietokanta "testidb"
		mysql_select_db("testidb", $yhteys) or die("Tietokantaa ei l�ytynyt!");
		echo terve;
		//haetaan kaikki tietueet
		$kyselyvara = "SELECT * FROM elokuva";
		$kyselyauth = "SELECT * FROM kayttajat";
		
		//suoritetaan kyselyt
		$hakuvara = mysql_query($kyselyvara, $yhteys);
		$hakuauth = mysql_query($kyselyauth, $yhteys);
		
		//tallennetaan muuttujaan edelliselt� sivulta saatu tieto
		$user = $_POST['userinfo'];
		//varauskoodi
		$koodi = "UPDATE elokuva SET lukum��r�=$uusiluku WHERE elokuva=$elokuvavara";
		
		//Tarkistetaan ett� k�ytt�j� joka tekee varausta l�ytyy tietokannasta
		
		for ($y = 0; $y < mysql_num_rows($hakuauth); $y++) {
		
						$tunnuskaksi= mysql_result($hakuauth, $y, "Tunnus");
						
						//Jos tietokannasta l�ytyy samanniminen k�ytt�j� niin toteutetaan
						if ($tunnuskaksi == $user) {
		
		
		// T�ll� tehd��n varaus
		foreach($_POST['checkbox'] as $key=>$value)
		{
		if($value=="on")
		{
			$elokuvavara = mysql_result($hakuvara, $key, "elokuva");
			$tyylilajivara = mysql_result($hakuvara, $key, "tyylilaji");
			$lukum��r�vara = mysql_result($hakuvara, $key, "lukum��r�");
			$uusiluku = ($lukum��r�vara - 1);
			
			echo $user;
			
			echo $elokuvavara;
			echo $uusiluku;
			if (!mysql_query("UPDATE elokuva SET lukum��r�=$uusiluku WHERE elokuva='$elokuvavara'"))
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