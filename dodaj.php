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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        } );
    </script>
</head>
<body>

<div class="menu_first">
    <div class="menu_second">



        <a href="#" class="myButton"><----</a>


        <span class="tytul">Rozliczenia</span>


    </div>
</div>
<form action="dodaj_ok.php" method="post" id="dodaj">
<table class="tabela2" cellspacing='0'>
    <tr>

        <th style="text-align: center">PESEL</th>
        <th>Data rozliczenia</th>

    </tr>

<tr>
    <th><input type="text" name="pesel" maxlength=11 onkeyup="this.value=this.value.replace(/\D/g,'')"> </th>
    <th><input type="text" id="datepicker" name="data"></th>
    <th><a class="myButton2" onclick="document.forms['dodaj'].submit();">Dodaj</a></th>
</tr>


</table>

    <?php echo $_SESSION['alert'];
    session_unset($_SESSION['alert']);


    ?>

</form>
</body>
</html>