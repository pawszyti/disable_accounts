<?php
session_start();
require('config/config.php');
$id = $_GET['id'];
$zapytanie = "DELETE FROM rozliczenia WHERE r_id=$id";
$db13->query($zapytanie);
header('location: main.php');
?>