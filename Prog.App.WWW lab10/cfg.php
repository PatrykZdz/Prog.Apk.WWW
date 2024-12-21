<?php
    // Dane do łączenia z bazą danych 
    $dbhost = 'localhost';   
    $dbuser = 'root';        
    $dbpass = '';            
    $baza = 'moja_strona';  

   
    // Dane logowania 
    $login = 'admin';
    $pass = 'haslo';

    // Nawiązywanie połączenia z bazą danych 
    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $baza);

    // Sprawdznie czy połączenie jest poprawne 
    if(!$link) echo '<b> przerwane połacznie </b>';
    // Sprawdzenie czy baza została wybrana prawidłowo 
    if(!mysqli_select_db($link, $baza)) echo 'nie wybrano bazy';
?>