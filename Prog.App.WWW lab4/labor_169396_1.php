<?php

    $nr_indeksu = '169396';
    $nrGrupy ='1';

    echo 'Patryk Zdziebłowski '.$nr_indeksu.' grupa '.$nrGrupy.'<br><br>';
    echo 'Zastosowanie metody include() <br>';

?>

<?php
    echo 'Zadanie 2 a)<br>' ;

    include 'vars.php';
    require_once 'vars.php';
    
    echo "$color $fruit<br>";   
?>

<?php 
    echo 'Zadanie 2 b)  <br>';
    echo 'if, else if , else :<br> ';
    $a = 30;
    $b = 20;

    if($a > $b)
    {
         echo 'a is bigger than b<br><br>';
    }
    else if ($a < $b)
    {
        echo 'a is smaller than b<br><br>';
    }
    else 
    {
         echo 'a is equal b<br><br>';
    }
    echo 'switch: <br>';

    $zmienna = 30;
    switch($zmienna) 
    {
        case 10:
            echo 'zmienna = 10 <br><br>';
            break;
        case 20:
            echo 'zmienna = 20 <br><br>';
            break;
        case 30:
            echo 'zmienna = 30 <br><br>';
            break;
    }


?>


<?php 
   echo "Zadanie 2 c)<br>";
   echo "for : ";
   for ($i = 1; $i < 20; $i++)
   {
        echo $i . ' ';
   }
   echo '<br>';
   echo 'while : ';
   $x = 0;
   while($x != 10)
   {
    echo $x++ . ' ';
   }
   echo '<br><br>';

?>

<?php
echo '_GET:<br/>';
if (isset($_GET['name'])) {
    echo $_GET['name'];
}
echo '<br/>';



echo '_SESSION:<br/>';
session_start();
$_SESSION['name'] = 'Zbyszek';
echo $_SESSION['name'];
echo '<br/>';

echo '_POST:<br/>';
if (isset($_POST['name'])) {
    echo $_POST['name'];
}
echo '<br/>';
?>


<form action="#" method="get">
    Name: <input type="text" name="name" /><br>
    <input type="submit" value="Submit" name="sub">
</form>