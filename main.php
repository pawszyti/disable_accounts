<?php
session_start();
require_once ('config/config.php');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Paweł Szymczyk" />
    <title>Rozliczenia użytkowników</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="menu_first">
    <div class="menu_second">



        <a href="dodaj.php" class="myButton">Dodaj</a>


<span class="tytul">Rozliczenia</span>


    </div>
</div>

<table class="tabela2" cellspacing='0'>
    <tr>
        <th>id</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>PESEL</th>
        <th>Data rozliczenia</th>
        <th>W kolejce</th>
        <th>Włączono w CRM</th>
        <th>Usuń</th>
    </tr>

    <?php
    $zapytanie = "SELECT * FROM rozliczenia;";
    $wynik = $db13->query($zapytanie);
    $ilosc = $wynik->num_rows;

    for ($i = 0; $i < $ilosc; $i++)
    {
    $tablica = $wynik->fetch_assoc();
        echo "
            <tr>
        <td>".$tablica['r_id']."</td>
        <td>".$tablica['r_imie']."</td>
        <td>".$tablica['r_nazwisko']."</td>
        <td>".$tablica['r_pesel']."</td>
        <td>".$tablica['r_data']."</td>
        <td><img src=\"img/".$tablica['r_status'].".png\" width=\"25px\" height=\"25px\"></td>";

        $pesel = $tablica['r_pesel'];
        $zapytanie_status = "SELECT * FROM pracownicy_ewidencja WHERE pesel LIKE $pesel";
        $wynik_status = $db2->query($zapytanie_status);
        $ilosc_status = $wynik_status->num_rows;

    for ($j = 0; $j < $ilosc; $j++) {
        $tablica_status = $wynik_status->fetch_assoc();
    }

if ($tablica_status['czy_pracuje'] == 0){
        $ikona="no";
}
else{
    $ikona="ok";
}


        echo"
        <td><img src=\"img/".$ikona.".png\" width=\"25px\" height=\"25px\"></td>
        ";
        if ($tablica['r_status']==no)    {
         echo "<td><a href=\"#\" class=\"myButton2\">Usuń</a></td>";
        }
        else
        {
            echo "<td> </td>";
        }
        echo" </tr>";
    }


    ?>




</table>


</body>
</html>