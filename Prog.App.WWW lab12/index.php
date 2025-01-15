<?php	
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// po tym fragmenice kodu następuje dynamiczne ładownie stron 

// Dołączanie plików php
include('cfg.php'); // Nawiązywanie połączenia z bazą danych
include('showpage.php'); // Pokazanie treści stron
?>
<!DOCTYPE html>

<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="pl" />
	<meta name="Author" content="Patryk Zdziebłowski" />
	<script src="js/kolorujtlo.js" type="text/javascript"></script>
	<script src="js/timedate.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/style.css" />

	<title>Największe budynki świata</title>

</head>

<body>
	<!-- Uruchomienie funkcji startclock(zegar i data)przy załadowaniu strony -->
	<body onload="startclock()">
		<div id="zegarek"></div>
		<div id="data"></div>

	<FORM METHOD ="POST" NAME = "background">
		<INPUT TYPE = "button" VALUE="żółty" ONCLICK = "changeBackground('#FFF000')">
		<INPUT TYPE = "button" VALUE="czarny" ONCLICK = "changeBackground('#000000')">		
		<INPUT TYPE = "button" VALUE="biały" ONCLICK = "changeBackground('#FFFFFF')">
		<INPUT TYPE = "button" VALUE="zielony" ONCLICK = "changeBackground('#00FF00')">
		<INPUT TYPE = "button" VALUE="niebieski" ONCLICK = "changeBackground('#0000FF')">
		<INPUT TYPE = "button" VALUE="pomarańczowy" ONCLICK = "changeBackground('#FF8000')">
		<INPUT TYPE = "button" VALUE="szary" ONCLICK = "changeBackground('c0c0c0')">
		<INPUT TYPE = "button" VALUE="czerwony" ONCLICK = "changeBackground('#FF0000')">
	</FORM>
	<!-- Menu nawigacyjne do podstron -->
	<div class="menu">
			<a href="index.php?idp=glowna">Strona główna</a>
			<a href="index.php?idp=budynek1">Top 1</a>
			<a href="index.php?idp=budynek2">Top 2</a>
			<a href="index.php?idp=budynek3">Top 3</a>
        	<a href="index.php?idp=budynek4">Top 4</a>
        	<a href="index.php?idp=budynek5">Top 5</a>
			<a href="index.php?idp=budynek6">Kontakt</a>
			<a href="index.php?idp=filmy">Filmy</a>
	</div>
   <?php
    $pageID = $_GET['idp'];

    if ($pageID == 'glowna'){
        echo PokazPodstrone(1);     /// Wywołanie funkcji PokazPodstrone na podstawie wartosci parametru 'idp'
    }elseif ($pageID == 'budynek1'){
        echo PokazPodstrone(2);
    }elseif ($pageID == 'budynek2'){
        echo PokazPodstrone(3);
    }elseif ($pageID == 'budynek3'){
        echo PokazPodstrone(4);
    }elseif ($pageID == 'budynek4'){
        echo PokazPodstrone(5);
    }elseif ($pageID == 'budynek5'){
        echo PokazPodstrone(6);
    }elseif ($pageID == 'budynek6'){
		echo PokazPodstrone(7);
	}elseif ($pageID == 'filmy'){
		echo PokazPodstrone(8);
	}else
	{
		echo PokazPodstrone(1); // Wyświetlanie strony głownej 
	}

    ?>
	
	<?php
	$nr_indeksu = '169396';
	$nrGrupy = '1';
	echo 'Autor: Patryk Zdziebłowski ' . $nr_indeksu . ' grupa ' . $nrGrupy . ' <br/><br/>';
	?>
</body>
