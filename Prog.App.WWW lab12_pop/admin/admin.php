<?php
// Dołaczenie pliku php odpowidzialnego za łączenie się z bazą 
include("../cfg.php");

session_start();

// Funkcja wyświetlająca formularz logowania się 
function FormularzLogowania($error = '') {
    $wynik = '
    <div class="logowanie">
      <h1 class="heading">Panel CMS:</h1>
      <div class="logowanie">
      '.($error ? '<p class="error">'.$error.'</p>' : '').'
        <form method="post" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
          <table class="logowanie">
            <tr><td class="log4_t">[email]</td><td><input type="text" name="login_email" class="logowanie" /></td></tr>
            <tr><td class="log4_t">[haslo]</td><td><input type="password" name="login_pass" class="logowanie" /></td></tr>
            <tr><td>&nbsp</td><td><input type="submit" name="x1_submit" class="logowanie" value="zaloguj" /></td></tr>
          </table>
        </form>
      </div>
    </div>
    ';

    echo $wynik;
}
/// Sprawdzanie czy dane do logowanie są prawidłowe
if(isset($_SERVER['REQUEST_URI']) && isset($_POST['login_email']) && isset($_POST['login_pass'])) {
    if($_POST['login_email'] === $login && $_POST['login_pass'] === $pass) {
      $_SESSION['login'] = true;
    } else {
        FormularzLogowania('Błąd logowania: Niepoprawne hasło lub login');
        exit();
    }
}


// Funkcja wyświetlająca listę podstron 
function listaPodstron($link) {
  if(!$_SESSION['login']) {
    FormularzLogowania('Wymagane zalogowanie aby mieć dostęp.');
    return;
  }
  // Wykonanie zapytanie SQL
  $result = $link->query("SELECT id, page_title FROM page_list LIMIT 10");

  echo "<a href='?add_new=true'><b>Dodaj nową podstronę</b></a>";
  echo "<table>";
  echo "<tr><th>ID</th><th>Tytuł</th><th>Akcje</th></tr>";

  while ($row = $result->fetch_array()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['page_title']}</td>
            <td>
                <a href='?edit_id={$row['id']}'><b>Edytuj</b></a> <b>//</b>
                <a href='?delete_id={$row['id']}'><b>Usuń</b></a>
            </td>
          </tr>";
}
echo "</table>";
}


// Funkcja do edytowanie podstrony 
function EdytujPodstrone($id,$link) {
  if(!$_SESSION['login']) {
    FormularzLogowania('Wymagane zalogowanie aby mieć dostęp.');
    return;
  }
  $id_clear = htmlspecialchars($id);
  $result = $link->query("SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1");


  $row = $result->fetch_assoc();
  $title = $row['page_title'];
  $content = $row['page_content'];
  $active = $row['status'];

  /// Formularz do edycji strony 
  echo "
    <h2>Edytuj podstronę</h2>
    <form method='post' action=''>
        <label for='page_title'><b>Tytuł:</b></label><br>
        <input type='text' name='page_title' id='page_title' value='".htmlspecialchars($title, ENT_QUOTES)."' required><br><br>

        <label for='page_content'><b>Treść:</b></label><br>
        <textarea name='page_content' id='page_content' rows='10' cols='50'>".htmlspecialchars($content, ENT_QUOTES)."</textarea><br><br>

        <label>
            <input type='checkbox' name='active' ".($active ? "checked" : "")."> Aktywna
        </label><br><br>

        <button type='submit' name='save_changes'>Zapisz</button>
    </form>
    ";

    if (isset($_POST['save_changes'])) {
      $new_title = $_POST['page_title'];
      $new_content = $_POST['page_content'];
      $new_active = isset($_POST['active']) ? 1 : 0;
  
      $stmt = $link->prepare("UPDATE page_list SET page_title = ?, page_content = ?, status = ? WHERE id = ? LIMIT 1");
      $stmt->bind_param("ssii", $new_title, $new_content, $new_active, $id_clear);

      
      if ($stmt->execute()) {
        header("Location: ?");
        exit();
      } else {
        echo "<p>Błąd w trakcie aktualizacji podstrony: " . $stmt->error . "</p>";
      }

  }
}
// Funkcja dodająca nową podstronę 
function DodajNowaPodstrone($link) {
  if (!$_SESSION['login']) {
      FormularzLogowania('Wymagane zalogowanie aby mieć dostęp.');
      return;
  }

  if (isset($_POST['save_new_page'])) {
    // Po dodanu podstrony należy zaktualizować bazę 
      $new_title = $_POST['page_title'];
      $new_content = $_POST['page_content'];
      $new_active = isset($_POST['active']) ? 1 : 0;
    // Przygotowanie zapytanie do wrzucenia nowej podstrony 
      $stmt = $link->prepare("INSERT INTO page_list (page_title, page_content, status) VALUES (?, ?, ?)");
      $stmt->bind_param("ssi", $new_title, $new_content, $new_active);

      //Wykonanie zapytania 
      if ($stmt->execute()) 
      { // Odświeżenie strony 
          header("Location: ?");
          // Zakończenie skryptu 
          exit();
      } else {
          echo "<p>Błąd w momencie dodawania podstrony: " . $stmt->error . "</p>";
      }

          $stmt->close();
      
  }
 // Formularz do dodanie nowej podstrony
  echo "
      <h2>Dodaj nową podstronę</h2>
      <form method='post' action=''>
          <label for='page_title'><b>Tytuł:</b></label><br>
          <input type='text' name='page_title' id='page_title' required><br><br>

          <label for='page_content'><b>Treść:</b></label><br>
          <textarea name='page_content' id='page_content' rows='10' cols='50' required></textarea><br><br>

          <label>
              <input type='checkbox' name='active'> Aktywna
          </label><br><br>

          <button type='submit' name='save_new_page'>Zapisz nową podstronę</button>
      </form>
  ";
}

// Funkcja usuwająca podstronę 
function UsunPodstrone($id, $link) {
  if (!$_SESSION['login']) {
      FormularzLogowania('Wymagane zalogowanie aby mieć dostęp.');
      return;
  }
  // Przygotowanie zapytania do usunięcia podstrony 
  $stmt = $link->prepare("DELETE FROM page_list WHERE id = ? LIMIT 1");
  $stmt->bind_param("i", $id); 
  //Wykonanie zapytania 
  if ($stmt->execute()) {
  // Odświeżenie strony 
      header("Location: ?");
      // Zakończenie skryptu 
      exit();
  } else {
      echo "<p>Błąd podczas usuwania podstrony: " . $stmt->error . "</p>";
  }
  $stmt->close();
}


// Sprawdzenie czy użytkownik jest zalogowany 
if ($_SESSION['login']) {
  if (isset($_GET['edit_id'])) {
      EdytujPodstrone($_GET['edit_id'], $link);
  } elseif (isset($_GET['add_new'])) {
      DodajNowaPodstrone($link);
  } elseif (isset($_GET['delete_id'])) {
      UsunPodstrone($_GET['delete_id'], $link);
  } else {
      listaPodstron($link);
  }
} else {
  FormularzLogowania();
}
// Funkcja wyświetlająca kategorie i podkategorie
function PokazKategorie($link)
{
  if(empty($_SESSION['login']))
  {
    return;
  }


  $pokazKategorie = isset($_POST['pokazKategorie']);

  /// Pobranie kategorii z bazy danych, postortowanych według matki i ID 
  $zapytanie = "SELECT * FROM kategoria ORDER BY matka, id";
  $wynik = $link->query($zapytanie);

  if(!$wynik)
  {
    die("Bład zapytania: " . $link->error);
  }

  $kategorie = [];
  while($row = $wynik->fetch_assoc())
  {
    $kategorie[$row['matka']][] = $row;
  }
  // Przycisk do wyświetlenie kategorii 
  echo "<h1> Pokaż kategorie </h1>";
  echo "<form method = 'post' action = ''>
          <button type = 'submit' name='pokazKategorie' > Pokaż </button>
        </form>
  ";

  if($pokazKategorie)
  {
    echo "<h2>KATEGORIE</h2>";
    
    // Pętla po głownych kategoriach 
    if(isset($kategorie[0])){
      echo "<ul>";
      foreach ($kategorie[0] as $kategoria)
      {
        echo "<li>" . htmlspecialchars($kategoria['nazwa'], ENT_QUOTES) . "</li>";
        // Jeśli dana kategoria posiada podkategorie, zostają one wyświetlone 
        if(isset($kategorie[$kategoria['id']]))
        {
          echo "<ul>";
          foreach($kategorie[$kategoria['id']] as $podkategoria)
          {
            echo "<li>" . htmlspecialchars($podkategoria['nazwa'], ENT_QUOTES) . "</li>";
    
          }
          echo "</ul>";
        }
      }
      echo "</ul>";
    } else {
        echo "<p> Brak kategorii głownych </p>";
    }
  }
}

/// Funkcja dodawająca nową kategorię 
function DodajKategorie($link)
{
  if(empty($_SESSION['login']))
  {
    return;
  }

  if(isset($_POST['dodaj']))
  {
    $matka = mysqli_real_escape_string($link, $_POST['matka']);
    $nazwa = mysqli_real_escape_string($link, $_POST['nazwa']);
    /// Zapytanie do dodanie nowej kategorii
    $zapytanieDodaj = "INSERT INTO kategoria (matka, nazwa) VALUES ('$matka', '$nazwa')";

    /// Sprawdzenie, czy zapytanie się powiodło 
    if(mysqli_query($link, $zapytanieDodaj))
    {
      echo "<p> Kategoria dodana </p>";
    }
    else
    {
      echo "<p> Błąd przy dodaniu Kategorii: " . mysqli_error($link) . "</p>";
    }
  }

  /// Formularz do dodawania kategorii 
  echo "
  <h2> Dodaj Kategorię </h2>
  <form method = 'post' action='' >
    <label for ='matka' > Matka: </label><br>
    <input type ='number' name='matka' id = 'matka' required><br>
    
    <label for = 'nazwa'>Nazwa kategorii: </label><br>
    <textarea name ='nazwa' id = 'nazwa' row ='5' cols='40' required> </textarea><br>
    
    <button type='submit' name='dodaj' > Dodaj Kategorię</button>
  </form>
  ";

}

/// Funkcja usuwająca kategorię
function UsunKategorie($link)
{
  if(empty($_SESSION['login']))
  {
    return;
  }

  if(isset($_POST['Usun_kategorie']) && !empty($_POST['kategoria_id']))
  {
    $id = mysqli_real_escape_string($link, $_POST['kategoria_id']);

    /// Sprawdzenie czy kategoria ma podkategorie, nie można jej usunąć
    $zapytanieKategoria = "SELECT id FROM kategoria WHERE matka = '$id'";
    $wynikKategorii = mysqli_query($link,$zapytanieKategoria);
    
    if(mysqli_num_rows($wynikKategorii) > 0)
    {
      echo "<p> Nie można usunąć kategorii, która posiada podkategorie. Usuń podkategorie. </p>";
      return;
    }

    /// Zapytanie do usunięcia 
    $zapytanieUsuwanie = "DELETE FROM kategoria WHERE id = '$id'";
    /// Sprawdzenie, czy zapytanie się powiodło 
    if(mysqli_query($link, $zapytanieUsuwanie))
    {
      echo "<p> Kategoria o ID $id została usunięta. </p>"; 
    }
    else
    {
      echo "<p> Błąd przy usuwaniu kategorii: " . mysqli_error($link) . "</p>";
    }

  }
  /// Formularz do usuwanie kategorii 
  echo "
  <h2> Usuń Kategorię </h2>
  <form method = 'post' action=''>
    <label for = 'kategoria_id'> ID Kategorii: </label>
    <input type ='text' name='kategoria_id'> <br>
    <input type ='submit' name='Usun_kategorie' value='Usuń Kategorię'>
  </form>
  ";

}
/// Funkcja do edycji kategorii 
function EdytujKategorie($link)
{
  if(empty($_SESSION['login']))
  {
    return;
  }
  
  if(isset($_POST['zapisz']) && !empty($_POST['kategoria_id']) && !empty($_POST['nowa_nazwa']))
  {
    $id = mysqli_real_escape_string($link, $_POST['kategoria_id']);
    $nowa_nazwa = mysqli_real_escape_string($link, $_POST['nowa_nazwa']);

    /// Zapytanie do Edycji
    $zapytanieEdycja = "UPDATE kategoria SET nazwa = '$nowa_nazwa' WHERE id = '$id'";

    /// Sprawdzenie, czy zapytanie się powiodło 
    if(mysqli_query($link, $zapytanieEdycja))
    {
      echo "<p> Kategoria o ID $id została zmieniona. </p>";
    }
    else
    {
      echo "<p> Błąd edycji: " . mysqli_error($link) . "</p>";
    }
  }

  /// Formularz do edytowania kategorii
  echo "
  <h2> Edytuj Kategorię </h2>
  <form method ='post' action=''>
    <label for='kategoria_id'>ID Kategorii: </label><br>
    <input type='number' name='kategoria_id' id='kategoria_id' required> <br><br>
    
    <label for='nowa_nazwa'>Nowa nazwa: </label><br>
    <input type = 'text' name ='nowa_nazwa' id='nowa_nazwa' required> <br><br>
    
    <button type ='submit' name='zapisz' > Zapisz</button>
  </form>
  ";


}
/// Wywołanie funkcji do obsługi Kategorii 
PokazKategorie($link);
DodajKategorie($link);
UsunKategorie($link);
EdytujKategorie($link);


/// Funkcja do Pokazywania Produktów
function PokazProdukty($link)
{
  if(empty($_SESSION['login']))
  {
    return;
  }

  $pokazProdukty = isset($_POST['pokazProdukty']);

  /// Formularz do wyświetlania produktów 
  echo "<h1> Pokaż Produkty </h1>";
  echo "<form method = 'post' action=''>
          <button type='submit' name='pokazProdukty'>Pokaż</button>
        </form>";

  if ($pokazProdukty)
  {
    $wynik = $link->query("SELECT * FROM produkty ORDER BY id");
    
    if(!$wynik)
    {
      die("Bład: " . $link->error);
    }


    /// Wyswietlanie informacji o produktach 
    echo "<h2> Lista Produktów </h2>";
    echo "<table border='1'>
            <tr>
              <th> ID </th>
              <th> Tytuł </th>
              <th> Opis </th>
              <th> Data utworzenia </th>
              <th> Data modyfikacji </th>
              <th> Data wygaśnięcia </th>
              <th> Cena Netto </th>
              <th> Podatek </th>
              <th> Ilość Sztuk </th>
              <th> Status Dostępności </th>
              <th> Kategoria </th>
              <th> Gabaryt </th>
              <th> Zdjęcie </th>
            </tr>";
      $dzisiaj = date('Y-m-d');
      while($row = $wynik->fetch_assoc())
      {
        /// Sprawdzenie dostępności produktu 
        $CzyDostepny = "Niedostępny";

        if ($row['ilosc_dostepnych_sztuk_w_magazynie'] > 0
        && $row['data_wygasniecia'] > $dzisiaj)
        {
            $CzyDostepny = "Dostępny";
        }
        /// Wyświetlanie danych w tabeli
        echo "<tr>
                <td> {$row['id']} </td>
                <td> {$row['tytul']} </td>
                <td> {$row['opis']} </td>
                <td> {$row['data_utworzenia']} </td>
                <td> {$row['data_modyfikacji']} </td>
                <td> {$row['data_wygasniecia']} </td>
                <td> {$row['cena_netto']} </td>
                <td> {$row['podatek_vat']} </td>
                <td> {$row['ilosc_dostepnych_sztuk_w_magazynie']} </td>
                <td>{$CzyDostepny}</td>
                <td> {$row['kategoria']} </td>
                <td> {$row['gabaryt_produktu']} </td>
                <td>";
        if(!empty($row['zdjecie']))
        {
          echo "<img src = '{$row['zdjecie']}' alt='Zdjęcie' width='75' height='75'>";
        }
        else
        {
          echo "Brak Zdjęcia";
        }
        echo "</td>
            </tr>";
    }
    echo "</table>";
  }
}

function DodajProdukt($link)
{
  if(empty($_SESSION['login']))
  {
    return;
  }

  if(isset($_POST['dodajProdukt']))
  {
    /// Pobieranie danych z formularza
    $tytul = mysqli_real_escape_string($link, $_POST['tytul']);
    $opis = mysqli_real_escape_string($link, $_POST['opis']);
    $data_utworzenia = date('Y-m-d H:i:s');
    $data_modyfikacji = $data_utworzenia;
    $data_wygasniecia = mysqli_real_escape_string($link, $_POST['data_wygasniecia']);
    $cena_netto = mysqli_real_escape_string($link, $_POST['cena_netto']);
    $podatek_vat = mysqli_real_escape_string($link, $_POST['podatek_vat']);
    $ilosc = mysqli_real_escape_string($link,$_POST['ilosc']);
    $status = mysqli_real_escape_string($link,$_POST['status_dostepnosci']);
    $kategoria = mysqli_real_escape_string($link,$_POST['kategoria']);
    $gabaryt_produktu = mysqli_real_escape_string($link,$_POST['gabaryt_produktu']);
    $zdjecie = mysqli_real_escape_string($link, $_POST['zdjecie']);


    //// Zapytanie SQL do dodanie produktu
    $zapytanie = "INSERT INTO produkty (tytul,opis,data_utworzenia,data_modyfikacji,
    data_wygasniecia,cena_netto,podatek_vat,ilosc_dostepnych_sztuk_w_magazynie,status_dostepnosci,
    kategoria,gabaryt_produktu,zdjecie) VALUES ('$tytul', '$opis', '$data_utworzenia', '$data_modyfikacji', '$data_wygasniecia',
    '$cena_netto', '$podatek_vat', '$ilosc' , '$status', '$kategoria', '$gabaryt_produktu', '$zdjecie')";

    /// Wykonanie zapytania
    if(mysqli_query($link,$zapytanie))
    {
      echo "<p> Produkt został dodany </p>";
    }
    else{
      echo "<p> Błąd przy dodowaniu: " . mysqli_error($link) . "</p>";
    }
  }
  /// Fomularz dodawanie produktu
  echo "
  <h2> Dodaj Produkt </h2>
  <form method ='post' action=''>
      <label for= 'tytul'>Tytuł:</label><br>
      <input type='text' name='tytul' required><br><br>
      <label for ='opis'> Opis:</label><br>
      <textarea name='opis' required> </textarea><br><br>
      <label for='data_wygasniecia'>Data wygaśnięcia:</label><br>
      <input type='date' name='data_wygasniecia' required><br><br>
      <label for='cena_netto'>Cena Netto:</label><br>
      <input type='number' step='0.01' name='cena_netto' required><br>
      <label for='podatek_vat'>Podatek VAT:</label><br>
      <input type='number' step='0.01' name='podatek_vat' required><br><br>
      <label for='ilosc'>Ilość: </label><br>
      <input type='number' name='ilosc' required><br><br>
      <label for='status_dostepnosci'>Status Dostępności:</label><br>
      <input type = 'text' name='status_dostepnosci' required><br><br>
      <label for='kategoria'>Kategoria:</label><br>
      <input type='text' name='kategoria' required><br><br>
      <label for='gabaryt_produktu'>Gabaryt Produkty:</label><br>
      <input type ='text' name='gabaryt_produktu' required><br><br>
      <label for='zdjecie' >Link do Zdjęcia<br>
      <input type ='text' name='zdjecie'><br><br>
      <button type = 'submit' name='dodajProdukt'>Dodaj Produkt</button>
  </form>";
}


function EdytujProdukt($link)
{
  if(empty($_SESSION['login']))
  {
    return;
  }

  if(isset($_POST['szukajProdukt']))
  {
    $id = mysqli_real_escape_string($link, $_POST['produkt_id']);

    /// Zapytanie do bazy danych 
    $zapytanie = $link->prepare("SELECT * FROM produkty WHERE id = ?");
    $zapytanie->bind_param("i", $id);
    $zapytanie->execute();
    $wynik = $zapytanie->get_result();

    /// Sprawdzenie czy produkt istnieje 
    if($wynik->num_rows === 0)
    {
      echo "Produkt o danym ID nie istnieje";
      return;
    }
    $produkt = $wynik->fetch_assoc();
  }
  
  // Obsługa zapisu zmian  w produkcie 
  if(isset($_POST['zapiszProdukt']))
  {
    /// Pobranie danych z formularza
    $id = $_POST['produkt_id'];
    $tytul = $_POST['tytul'];
    $opis = $_POST['opis'];
    $data_modyfikacji = date('Y-m-d H:i:s');
    $data_wygasniecia = $_POST['data_wygasniecia'];
    $cena_netto = $_POST['cena_netto'];
    $podatek_vat = $_POST['podatek_vat'];
    $ilosc = $_POST['ilosc'];
    $status_dostepnosci = $_POST['status_dostepnosci'];
    $kategoria = $_POST['kategoria'];
    $gabaryt_produktu = $_POST['gabaryt_produktu'];
    $zdjecie = $_POST['zdjecie'];

    /// Zapytanie do zmiany danych produktu
    $zapytanieAktualizacja = $link->prepare("UPDATE produkty SET tytul = ?, opis = ?,
    data_modyfikacji = ?, data_wygasniecia = ?, cena_netto=?, podatek_vat = ?,
    ilosc_dostepnych_sztuk_w_magazynie = ?, status_dostepnosci = ?, kategoria = ?,
    gabaryt_produktu = ?, zdjecie = ? WHERE id = ?");

    $zapytanieAktualizacja->bind_param(
      "ssssdiissssi",
      $tytul,
      $opis,
      $data_modyfikacji,
      $data_wygasniecia,
      $cena_netto,
      $podatek_vat,
      $ilosc,
      $status_dostepnosci,
      $kategoria,
      $gabaryt_produktu,
      $zdjecie,
      $id
    );

    /// Wykonanie zapytania i informacja 
    if($zapytanieAktualizacja->execute())
    {
      echo "Produkt został zmieniony";
    }
    else
    {
      echo "Bład przy zmianie produktu";
    }
  }

  /// Wyswietlanie formularza wyszukiwania produktu o danym ID
  if(!isset($produkt))
  {
    echo "
    <h2> Wyszukaj Produkt do Edycji </h2>
    <form method ='post' action=''>
        <label for='produkt_id'> ID Produktu: </label>
        <input type ='number' name='produkt_id' required>
        <button type = 'submit' name='szukajProdukt'>Szukaj Produktu</button>
    </form>";
    return;
  }

  /// Wyświetlenie formularza do edycji produktu 
  echo"
  <h2>Edytuj Produkt</h2>
  <form method='post' action=''>
      <input type='hidden' name='produkt_id' value='{$produkt['id']}'>
      <label for ='tytul'>Tytuł:</label>
      <input type ='text' name='tytul' value='" . htmlspecialchars($produkt['tytul'], ENT_QUOTES) ."' required><br>
      <label for='opis'>Opis:</label>
      <textarea name='opis'>" . htmlspecialchars($produkt['opis'],ENT_QUOTES) . "</textarea><br>
      <label for ='data_wygasniecia'>Data Wygaśnięcia:</label>
      <input type ='date' name='data_wygasniecia' value='" . htmlspecialchars($produkt['data_wygasniecia'], ENT_QUOTES) ."' required><br>
      <label for ='cena_netto'>Cena Netto:</label>
      <input type ='number' step='0.01' name='cena_netto' value'" . htmlspecialchars($produkt['cena_netto'], ENT_QUOTES)."'required><br>
      <label for = 'podatek_vat'>Podatek VAT:</label>
      <input type = 'number' step='0.01' name ='podatek_vat' value='" .htmlspecialchars($produkt['podatek_vat'], ENT_QUOTES) ."'required><br>
      <label for ='ilosc'>Ilość:</label>
      <input type = 'number' name='ilosc' value='" . htmlspecialchars($produkt['ilosc_dostepnych_sztuk_w_magazynie'], ENT_QUOTES)."'required><br>
      <label for ='status_dostepnosci'>Status Dostępności:</label>
      <input type='text' name='status_dostepnosci' value='" . htmlspecialchars($produkt['status_dostepnosci'],ENT_QUOTES)."' required><br>
      <label for='kategoria'>Kategoria:</label>
      <input type='text' name='kategoria' value='" . htmlspecialchars($produkt['kategoria'],ENT_QUOTES) ."' required><br>
      <label for='gabaryt_produktu'>Gabaryt Produktu:</label>
      <input type ='text' name='gabaryt_produktu' value='" . htmlspecialchars($produkt['gabaryt_produktu'], ENT_QUOTES) ."' required><br>
      <laber for ='zdjecie'>Zdjecie':</label>
      <input type ='text' name='zdjecie' value'" . htmlspecialchars($produkt['zdjecie'], ENT_QUOTES) ."'><br>
      <button type ='submit' name='zapiszProdukt'>Zapisz Zmiany</button>
  </form>";
}

function UsunProdukt($link)
{
  if(empty($_SESSION['login']))
  {
    return;
  }
  ///Obsługa usuwania produktu 
  if(isset($_POST['usunProdukt']) && !empty($_POST['produkt_id']))
  {
    $id = mysqli_real_escape_string($link, $_POST['produkt_id']);
    /// Zapytanie usuwające 
    $zapytanie = "DELETE FROM produkty WHERE id = $id";

    if(mysqli_query($link,$zapytanie))
    {
      echo "<p> Produkt został usunięty";
    }
    else
    {
      echo "<p> Bład przy usuwaniu: " . mysqli_error($link) . "</p>";
    }
  }
  /// Wyświetlenie formularza do usunięcia produktu 
  echo "
  <h2> Usuń Produkt </h2>
  <form method ='post' action=''
    <label for ='produkt_id'>ID Produktu: </label><br>
    <input type = 'number' name='produkt_id' required><br><br>
    <button type = 'submit' name ='usunProdukt'>Usuń Produkt </button>
  </form>";
}

/// Wywołanie funkcji do obsługi produkty 
PokazProdukty($link);
DodajProdukt($link);
EdytujProdukt($link);
UsunProdukt($link);


?>