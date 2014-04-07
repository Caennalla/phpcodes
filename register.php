<html>
<body>

<?php
	//muodostetaan yhteys tietokantapalvelimeen
		$yhteys = mysql_connect("127.4.52.2:3306","adminMbkj2Uu", "NKHkwxKDudzI") or die("Yhdistäminen ei onnistunut!");
	//valitaan tietokanta "testidb"
		mysql_select_db("testidb", $yhteys) or die("Tietokantaa ei löytynyt!");
	//luodaan käyttäjätili
	
	if ($_POST[tunnus] == "" || $_POST[enimi] == "" || $_POST[snimi] == "")
	{
	echo "Rekisteröinti epäonnistui, ole hyvä ja kokeile uudestaan. ";
	echo "<a href=http://mysqltest-juhotestaus.rhcloud.com/index.php>Takaisin</a>";
	}
	else {
	
		$sql = "INSERT INTO kayttajat VALUES('$_POST[tunnus]','$_POST[enimi]','$_POST[snimi]')";
		$createuser = "CREATE USER '$_POST[tunnus]'@'127.4.52.2:3306'";
		
		if (!mysql_query($sql))
		{
			die('Järjestelmässä on jo tämän niminen käyttäjä, kokeile muuta tunnusta');
		}
		
		if (!mysql_query($createuser))
		{
			die('Error: ' . mysql_error($yhteys));
		}
		
	mysql_close($yhteys);
	
	header('Location:index.php');
	}
?>
</body>
</html>