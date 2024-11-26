<?php	
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	
?>
<?php

include('cfg.php');
include('showpage.php');
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
	<style>
		body 
		{
			font-family: Georgia, 'Times New Roman', Times, serif;
			padding: 0;
			margin: 30px;
			text-align:center;
			
		}
		table 
		{
			width: 100%;
			border-style: solid;
		}
		.menu 
		{
			background-color: gray;
			overflow:hidden;
		}
		td
		{
			text-align: center;
			background-color: lightgrey;
			color: black;
			padding: 10px;
		}
		.menu a {
			float: left;
			display: block;
			color: black;
			text-align: center;
			padding: 10px 16px;
			text-decoration: none;
		}
		.menu a:hover 
		{
			background-color: cyan;
		}
		img 
		{
			float: left;
			margin: 7px;
		}
		.image2
		{
			float: left;
		}
		.image3S
		{
			float: right;
		}
	</style>
</head>

<body>
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
	//<?php
	//if (empty($_GET['idp'])) {
	//	$strona = 'html/glowna.html';
	//} elseif ($_GET['idp'] == 'budynek1') {
	//	$strona = 'html/budynek1.html';
	//} elseif ($_GET['idp'] == 'budynek2') {
	//	$strona = 'html/budynek2.html';
	//} elseif ($_GET['idp'] == 'budynek3'){
	//	$strona = 'html/budynek3.html';
	//} elseif ($_GET['idp'] == 'budynek4'){
	//	$strona = 'html/budynek4.html';
	//} elseif ($_GET['idp'] == 'budynek5') {
	//	$strona = 'html/budynek5.html';
	//} elseif ($_GET['idp'] == 'budynek6') {
	//	$strona = 'html/budynek6.html';
	//}  elseif ($_GET['idp'] == 'filmy')   {
	//	$strona = 'html/filmy.html';
	//} else {
	//	
	//	$strona = 'html/glowna.html';
	//}


	//if (file_exists($strona)) {
        //include($strona);
	//}
	//else
	//{
	//	echo '<p>Podstrona nie istnieje.</p>';
	//}
	//?>

   <?php
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    $pageID = $_GET['idp'];

    if ($pageID == 'glowna'){
        echo PokazPodstrone(1);
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
		echo PokazPodstrone(1);
	}

    ?>


	
	<?php
	$nr_indeksu = '169396';
	$nrGrupy = '1';
	echo 'Autor: Patryk Zdziebłowski ' . $nr_indeksu . ' grupa ' . $nrGrupy . ' <br/><br/>';
	?>
</body>
