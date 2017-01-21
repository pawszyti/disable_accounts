<?php
$db13_host = '192.168.1.13';
$db13_name = 'skrypt';
$db13_user = 'skrypt';
$db13_pass = 'pawel098!';
$db13 = new mysqli($db13_host,$db13_user,$db13_pass,$db13_name);
$db13-> query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");

$db2_host = '192.168.1.3';
$db2_name_hr = 'hr';
$db2_name_capital = 'capital';
$db2_name_centrum = 'centrum';
$db2_user = 'skrypt';
$db2_pass = 'pawel098!';
$db2_hr = new mysqli($db2_host,$db2_user,$db2_pass,$db2_name_hr);
$db2_capital = new mysqli($db2_host,$db2_user,$db2_pass,$db2_name_capital);
$db2_centrum = new mysqli($db2_host,$db2_user,$db2_pass,$db2_name_centrum);

//$db2_hr-> query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");

if (mysqli_connect_errno())
{
    echo "error";
    exit();
}

$dzis = date('Y-m-d');
$zapytanie = "SELECT * FROM rozliczenia WHERE r_status LIKE 'no' AND r_data LIKE '$dzis'";

if ($wynik = $db13->query($zapytanie)) {
    $ilosc = $wynik->num_rows;

    for ($i = 0; $i < $ilosc; $i++) {
        $tablica = $wynik->fetch_assoc();
        $pesel = $tablica['r_pesel'];
        $login = $tablica['r_login'];
        $script="/usr/local/bin/kasowanie_kont/samba_off.sh $login";
        $message = shell_exec($script);
        echo $message;


        $zapytanie_hr = "UPDATE pracownicy_ewidencja SET czy_pracuje=0, status=0 WHERE pesel LIKE '$pesel'";

        if($db2_hr->query($zapytanie_hr)) {
            $zapytanie_capital = "UPDATE cash_users SET czy_aktywne='n'WHERE pesel LIKE '$pesel'";
            if ($db2_capital->query($zapytanie_capital))
            {
                $zapytanie_centrum = "UPDATE uzytkownicy_ewidencja SET status=0 WHERE pesel LIKE '$pesel'";
                if ($db2_centrum->query($zapytanie_centrum)){
                    $zapytanie_13 = "UPDATE rozliczenia SET r_status='ok' WHERE r_pesel LIKE '$pesel'";
                    if ($db13->query($zapytanie_13)){
                        echo "Cron wykonany dla ".$login."<br />";
                    }
                    else
                    {
                        echo "UPDATE 1.13 error";
                    }
                }
                else
                {
                    echo "UPDATE error centrum";
                }

            }
            else
            {
                echo "UPDATE error capital";
            }
        }
        else
        {
            echo "UPDATE error hr";
        }
    }
}
else {
    echo "Select 1.13 error";
}

//ssh -n root@192.168.1.4 "samba-tool user enable $LOGIN" 2>/dev/null


?>




