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
		$kyselyekstra = "SELECT * FROM varatut";
		$kyselyauth = "SELECT * FROM kayttajat";
		
		//suoritetaan kyselyt
		$hakuvara = mysql_query($kyselyvara, $yhteys);
		$ekstrahaku =mysql_query($kyselyekstra, $yhteys);
		$hakuauth = mysql_query($kyselyauth, $yhteys);
		
		$user = $_POST['userinfo'];
		
		
		for ($y = 0; $y < mysql_num_rows($hakuauth); $y++) {
		
						$tunnuskaksi= mysql_result($hakuauth, $y, "Tunnus");
						
						//Jos tietokannasta löytyy samanniminen käyttäjä niin toteutetaan
						if ($tunnuskaksi == $user) {
		foreach($_POST['check'] as $key=>$value)
		{
		if($value=="on")
		{
			$elokuvavara = mysql_result($ekstrahaku, $key, "elokuva");

			echo $user;
			echo $elokuvavara;

			if (!mysql_query("UPDATE elokuva SET lukumäärä=(lukumäärä+1) WHERE elokuva='$elokuvavara'"))
		{
			die('Error: ' . mysql_error($yhteys));
		}
		
			if (!mysql_query("DELETE FROM varatut WHERE elokuva='$elokuvavara' AND tunnus='$user'"))
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