<?php

function PokazKontakt() 
{
    $show = '<form method="POST" action="">
    <b>Temat</b> : <input type="text" name="temat" required><br><br>
    <b>Treść</b> :<textarea name="tresc" rows="10" cols="65" required>Wiadomość</textarea><br><br>
    <b>Adres e-mail</b>:<input type="email" name="email" required><br><br>
    <input type="submit" name="formularzKontakt" value="Wyślij">
    </form>';

    return $show;
}

function WyslijMailaKontakt($odbiorca) {
    if(empty($_POST['temat']) ||  empty($_POST['tresc']) || empty($_POST['email'])) 
    {
        echo '[nie_wypelniles_pola]';
        echo PokazKontakt();
    } 
    else 
    {
        $mail['subject'] = $_POST['temat'];
        $mail['body'] = $_POST['tresc'];
        $mail['sender'] = $_POST['email'];
        $mail['reciptient'] = $odbiorca;

        $header = "From: Formularz kontaktowy <".$mail['sender'].">\n";
        $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
        $header .= "X-Sender: <".$mail['sender'].">\n";
        $header .= "X-Mailer: PRapWWW mail 1.2\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <".$mail['sender'].">\n";

        mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);

        echo '[wiadomosc_wyslana]';
    }
}


function PrzypomnijHaslo($odbiorca, $pass) 
{
    $mail['subject'] = "Przypomnienie hasla";
    $mail['body'] = "Twoje haslo to: ".$pass;
    $mail['reciptient'] = $odbiorca;

    $header = "From: Formularz kontaktowy <email@gmail.com>\n";
    $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\n";
    $header .= "X-Mailer: PHP/".phpversion()."\n";
    $header .= "X-Priority: 3\n";

    mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);

    echo '[wysłano_przypomnienie]';
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['formularzKontaktowy'])) {
        WyslijMailaKontakt("patryczekpatryczek@gmail.com ");
    }
    elseif(isset($_POST['przypomnijHaslo'])) {
        PrzypomnijHaslo("patryczekpatryczek@gmail.com", $pass);
    }

} 
else 
{
    echo '<h2>Wyślij maila</h2>';
    echo PokazKontakt();

    echo '
    <h2>Przypomnij hasło</h2>
    <form method="POST" action="">
    <b>email</b>:<input type="email" name="email" required><br><br>
    <input type="submit" name="przypomnijHaslo" value="Przypomnij swoje hasło">
    </form>';

}

?>