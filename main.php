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

        <a href="cron_rozliczenia.php" class="myButton">CRON</a>

    </div>
</div>

<?php
echo $_SESSION['alert'];
session_unset($_SESSION['alert']);


?>
<table class="tabela2" cellspacing='0'>
    <tr>
        <th>id</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>PESEL</th>
        <th>Data rozliczenia</th>
        <th>Cron</th>
        <th>CRM Off</th>
        <th>Samba Off</th>
        <th>Usuń</th>
    </tr>

    <?php
    $zapytanie = "SELECT * FROM rozliczenia ORDER BY r_id DESC;";
    $wynik = $db13->query($zapytanie);
    $ilosc = $wynik->num_rows;
    $licznik = $ilosc;
    for ($i = 0; $i < $ilosc; $i++)
    {
    $tablica = $wynik->fetch_assoc();
        echo "
            <tr>
        <td>".$licznik."</td>
        <td>".$tablica['r_imie']."</td>
        <td>".$tablica['r_nazwisko']."</td>
        <td>".$tablica['r_pesel']."</td>
        <td>".$tablica['r_data']."</td>
        <td><img src=\"img/".$tablica['r_status'].".png\" width=\"25px\" height=\"25px\"></td>";

        $pesel = $tablica['r_pesel'];
        $zapytanie_status = "SELECT * FROM pracownicy_ewidencja WHERE pesel LIKE $pesel";
        $wynik_status = $db2->query($zapytanie_status);
        $tablica_status = $wynik_status->fetch_assoc();
        if ($tablica_status['czy_pracuje'] == 1) {
            $ikona = "no";
        } else {
            $ikona = "ok";
        }
        echo"
        <td><img src=\"img/".$ikona.".png\" width=\"25px\" height=\"25px\"></td>
        <td><img src=\"img/".$tablica['r_samba'].".png\" width = \"25px\" height = \"25px\" ></td >
        
        ";
        $licznik = $licznik-1;




        if ($tablica['r_status']==no)    {
         echo "<td><a href=\"del.php?id=".$tablica['r_id']."\" class=\"myButton2\">Usuń</a></td>";
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