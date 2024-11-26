<?php

function PokazPodstrone($id)
{
    $id_clear = htmlspecialchars($id);
    $connection = mysqli_connect("localhost", "root", "", "moja_strona");

    if (mysqli_connect_errno()) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }
    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    mysqli_close($connection);
    if(empty($row['id'])) {
        $web = '[nie_znaleziono_strony]';
    } else {
        $web = $row['page_content'];
    }
    return $web;
}

?>
