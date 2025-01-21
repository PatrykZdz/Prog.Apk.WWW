<?php
session_start();
/// Funkcja dodająca produkt do koszyka 
function DodajKoszyk($id, $ilosc)
{
    /// Dołaczenie pliku bazy danych 
    include('cfg.php');
    if(!isset($_SESSION['koszyk']))
    {
        $_SESSION['koszyk'] = [];
    }

    if(isset($_SESSION['koszyk'][$id]))
    {
        $_SESSION['koszyk'][$id]['Ilosc'] += $ilosc;
    }
    else
    {
        $zapytanie = $link->prepare("SELECT id, tytul, cena_netto, podatek_vat, zdjecie FROM
        produkty WHERE id = ? LIMIT 5");
        $zapytanie->bind_param("i",$id);
        $zapytanie->execute();
        $wynik = $zapytanie->get_result();

        if($wynik->num_rows > 0)
        {
            $produkt = $wynik->fetch_assoc();
            $_SESSION['koszyk'][$id] = [
                'Nazwa' => $produkt['tytul'],
                'Cena' => $produkt['cena_netto'],
                'Vat' => $produkt['podatek_vat'],
                'Ilosc' => $ilosc,
                'Zdjecie' => $produkt['zdjecie']
            ];
        }
    }
}

/// Funkcja PokazKoszyk: Wyświetla zawartość koszyka w formie tabeli.
function PokazKoszyk()
{
    if(!isset($_SESSION['koszyk']) || empty($_SESSION['koszyk']))
    {
        echo "<p> Pusty Koszyk </p>";
        return;
    }

    echo "<table border = '1'>
            <tr> 
                <th>Zdjecie</th>
                <th>Nazwa</th>
                <th>Cena Netto</th>
                <th>VAT</th>
                <th>Ilosc</th>
                <th>Cena brutto</th>
                <th>Akcje</th>
            </tr>";

    $PelnaCena = 0;
    foreach ($_SESSION['koszyk'] as $id => $rzecz)
    {
        $CenaBrutto = $rzecz['Cena'] * (1 + $rzecz['Vat']/100) * $rzecz['Ilosc'];
        $PelnaCena += $CenaBrutto;
        $zdjecie = $rzecz['Zdjecie'];

        echo "<tr>
                <td><img src ='{$zdjecie}' alt ='Brak Zdjecia' style = 'width:100px; height:100px;'></td> 
                <td>{$rzecz['Nazwa']}</td>
                <td>{$rzecz['Cena']} PLN</td>
                <td>{$rzecz['Vat']}%</td>
                <td>
                    <form method='post' style='display:inline;'>
                        <input type='number' name='ilosc' value='{$rzecz['Ilosc']}' min='1' style='width: 60px;'>
                        <input type='hidden' name='action' value='update'>
                        <input type='hidden' name='product_id' value='$id'>
                        <button type='submit'>Zmień</button>
                    </form>
                </td>
                <td>" . number_format($CenaBrutto,2) . " PLN</td>
                <td>
                    <form method='post' style='display:inline;'>
                        <input type='hidden' name='action' value='remove'>
                        <input type='hidden' name='product_id' value='$id'>
                        <button type='submit'>Usuń</button>
                    </form>
                </td>
            </tr>";
    }

    echo "<tr>
            <td colspan = '4'><strong> Pełna Cena Brutto: </strong></td>
            <td colspan = '2'>" . number_format($PelnaCena, 2) . " PLN</td>
    </tr>
    </table>";
}
/// Funkcja wyświetla wszystkie produkkty w bazie danych 
function PokazProdukty()
{
    include('cfg.php');
    $wynik = $link->query("SELECT id, tytul, cena_netto, podatek_vat, zdjecie FROM produkty");
    
    if($wynik->num_rows>0)
    {
        echo "<div style = 'display: flex; flex-wrap: wrap;'>";
        while ($produkt = $wynik->fetch_assoc())
        {
            $CenaBrutto = $produkt['cena_netto'] * (1 + $produkt['podatek_vat']/100);
            $zdjecie = $produkt['zdjecie'];
            echo "<div style ='border: 1px solid #ccc; margin: 10px; padding: 10px; width: 200px'>
                <img src ='{$zdjecie}' alt = 'Brak Zdjecia' style ='width: 100%; height: 50%;'>
                <h3>{$produkt['tytul']}</h3>
                <p>Cena Netto: {$produkt['cena_netto']} PLN </p>
                <p>Cena Brutto: " . number_format($CenaBrutto,2) . " PLN</p>
                <form method ='post'>
                    <input type ='hidden' name ='action' value='add'>
                    <input type= 'hidden' name ='product_id' value='{$produkt['id']}'>
                    <input type= 'number' name= 'ilosc' value='1' min='1'>
                    <button type ='submit'>Dodaj do koszyka</button>
                </form>
            </div>";
        }
        echo "</div>";
    }
    else
    {
        echo "<p> Brak produktów w Bazie Danych. </p>";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $action = $_POST['action'] ?? '';
    $produktId = ($_POST['product_id']?? 0);
    $ilosc = ($_POST['ilosc'] ?? 1);

    if($action === 'add')
    {
        DodajKoszyk($produktId,$ilosc);
    }
    elseif($action === 'remove')
    {
        unset($_SESSION['koszyk'][$produktId]);
    }
    elseif($action === 'update')
    {
        if(isset($_SESSION['koszyk'][$produktId]))
        {   // Ustawiamy minimalną ilość na 1
            $_SESSION['koszyk'][$produktId]['Ilosc'] = max(1, $ilosc);  
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sklep Internetowy</title>
    <style>
        body {font-family: Arial, sans-serif; margin: 20px;}
        table {width: 100%; border-collapse: collapse;}
        table, th, td {border: 1px solid #ccc;}
        th, td {padding: 10px; text-align: left;}
        .produkt-karta {margin: 10px;}
    </style>
</head>
<body>
    <h1> Sklep Internetowy </h1>
    
    <h2> Produkty </h2>
    <?php
        PokazProdukty();
    ?>

    <h2> Koszyk </h2>
    <?php 
        PokazKoszyk();
    ?>
</body>
</html>
