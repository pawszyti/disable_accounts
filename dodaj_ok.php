<?php
session_start();
if (isset($_POST['pesel']) && ($_POST['data'])){
    require_once ('config/config.php');
    $pesel = $_POST['pesel'];
    $data = $_POST['data'];
    $zapytanie = "SELECT * FROM pracownicy_ewidencja WHERE pesel LIKE $pesel";
    $wynik = $db2->query($zapytanie);
    $ilosc = $wynik->num_rows;

    for ($i = 0; $i < $ilosc; $i++) {
        $tablica = $wynik->fetch_assoc();
    }
    $r_imie =  $tablica['imie'];
    $r_nazwisko =  $tablica['nazwisko'];
    $r_status = "no";
    $_SESSION['alert'] = $tablica['imie'];

    $zapytanie_in = "INSERT INTO `rozliczenia` (`r_id`,`r_imie`,`r_nazwisko`,`r_pesel`,`r_data`,`r_status`) VALUES (NULL,'$r_imie', '$r_nazwisko','$pesel','$data','$r_status')";
    $wynik_in = $db13->query($zapytanie_in);
    header('location: dodaj.php');


}
else
{
    $_SESSION['alert'] = "Nie wypełniłeś wszystkich pól";
    header('location: dodaj.php');
}




?>