<?php
// Funkcja do wyświetlania zawartości strony 
function PokazPodstrone($id)
{
    
    $id_clear = htmlspecialchars($id);
    // Nawiązenie połączenie z bazą danych
    $connection = mysqli_connect("localhost", "root", "", "moja_strona");
    
    // Sprawdznie czy połączenie się powiodło 
    if (mysqli_connect_errno()) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }
    // Zapytania SQL 
    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    // Wykonanie zapytania SQL
    $result = mysqli_query($connection, $query);
    // Pobranie wyniku zapytania
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // Zamknięcie połączenie z bazą danych 
    mysqli_close($connection);

    // Sprawdzenie czy istnieje strona o danym ID
    if(empty($row['id'])) {
        $web = '[nie_znaleziono_strony]';
    } else {
        $web = $row['page_content'];
    }
    // Zwrócenie zawartości strony 
    return $web;
}

?>
