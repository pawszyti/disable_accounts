<?php
session_start();
require('config/config.php');
$id = $_GET['id'];

$zapytanie2 = "SELECT * FROM rozliczenia WHERE r_id=$id";
$wynik2 = $db13->query($zapytanie2);
$ilosc2 = $wynik2->num_rows;
if ($ilosc2<1)
{
    $_SESSION['alert'] = " <div class=\"alert\">
    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
    Nie ma takiego użytkownika 
    </div>";
    header('location: main.php');
    exit();
}
else
{
$tablica2 = $wynik2->fetch_assoc();
$_SESSION['alert'] = " <div class=\"alert2\">
<span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
Usunięto poprawnie z listy użytkownika ".$tablica2['r_imie']." ".$tablica2['r_nazwisko']." 
</div>";
$zapytanie = "DELETE FROM rozliczenia WHERE r_id=$id";
$db13->query($zapytanie);
header('location: main.php');
}
?>