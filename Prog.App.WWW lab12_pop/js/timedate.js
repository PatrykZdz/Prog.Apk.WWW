// Funkcja pobierająca aktualną datę 
function gettheDate()
{
    Dni = new Date(); 
    TheDate = "" + (Dni.getMonth() +1) + " / " + Dni.getDate() + " / " +(Dni.getYear()-100); // Formatowanie daty: miesiąc, dzień, rok
    document.getElementById("data").innerHTML = TheDate;  // Wyświetlanie daty 
} 

var IdCzasu = null;
var timerRunning = false;

// Funkcja zatrzymująca zegar
function stopclock()
{
    if(timerRunning)
        clearTimeout(IdCzasu);
    timerRunning = false;
}

// Funkcja do rozpoczęcia pracy zegara 
function startclock()
{
    stopclock();
    gettheDate()
    showtime();
}

// Funkcja pokazująca bieżący czas 
function showtime()
{
    var now = new Date(); // Tworzenie obiektu z datą i czasem 
    var hours = now.getHours(); // Pobieranie aktualnej godziny 
    var minutes = now.getMinutes(); // Pobieranie aktualnych minut
    var seconds = now.getSeconds(); // Pobieranie aktualnych sekund 
    var timeValue = "" + ((hours >12) ? hours -12 :hours)  // Formatowanie godziny z format 24-godzinnego na 12-godzinny AM:PM
    timeValue +=((minutes <10 ) ? ":0" : ":") + minutes  // Formatowanie minut (Dodanie 0 dla minut < 10)
    timeValue +=((seconds <10)  ? ":0" : ":" ) + seconds // Formatowanie sekund (Dodanie 0 dla sekund < 10)
    timeValue +=(hours>=12) ? "P.M." : "A.M." // Dodanie AM/PM
    document.getElementById("zegarek").innerHTML = timeValue; // Wyświetlanie czasu 
    IdCzasu = setTimeout("showtime()",1000); // Odświeżanie funkcji za 1 sekundę 
    timerRunning = true;

}