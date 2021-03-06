<?php
session_start();
if (isset($_POST['pesel']) && ($_POST['data'])){
    require_once ('config/config.php');
    $pesel = $_POST['pesel'];
    $data = $_POST['data'];
    $dzis = date('Y-m-d');
    if ($dzis>$data) {
        $_SESSION['alert'] = " <div class=\"alert\">
        <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
        Data nie może być starsza niż obecna
        </div>";
        header('location: dodaj.php');
        exit();
    }
    else {
        $zapytanie = "SELECT * FROM pracownicy_ewidencja WHERE pesel LIKE $pesel";
        $wynik = $db2->query($zapytanie);
        $ilosc = $wynik->num_rows;

        if ($ilosc<1) {
            $_SESSION['alert'] = " <div class=\"alert\">
            <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
            Nie znaleziono takiego nr pesel
            </div>";
            header('location: dodaj.php');
            exit();
        }
        else {
            $zapytanie2 = "SELECT * FROM rozliczenia WHERE r_pesel LIKE $pesel";
            $wynik2 = $db13->query($zapytanie2);
            $ilosc2 = $wynik2->num_rows;
            if ($ilosc2>0)
            {
                $_SESSION['alert'] = " <div class=\"alert\">
                <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                Podany pesel znajduje się już na liście
                </div>";
                header('location: dodaj.php');
                exit();
            }
            else {
                for ($i = 0; $i < $ilosc; $i++) {
                    $tablica = $wynik->fetch_assoc();
                }
                $r_imie = $tablica['imie'];
                $r_nazwisko = $tablica['nazwisko'];
                $r_status = "no";
                $r_login = str_replace(".", "", $tablica['login']);
                $r_samba = "no";

                $zapytanie_in = "INSERT INTO `rozliczenia` (`r_id`,`r_imie`,`r_nazwisko`,`r_login`,`r_pesel`,`r_data`,`r_status`,`r_samba`) VALUES (NULL,'$r_imie', '$r_nazwisko','$r_login','$pesel','$data','$r_status','$r_samba')";
                $wynik_in = $db13->query($zapytanie_in);
                $_SESSION['alert'] = " <div class=\"alert2\">
                <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                Dodano do listy użytkownika ".$r_imie." ".$r_nazwisko." 
                </div>";
                header('location: main.php');
            }
        }
    }
}
else {
    $_SESSION['alert'] = " <div class=\"alert\">
    <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
    Pola nie mogą być puste
    </div>";
    header('location: dodaj.php');
    exit();
}

