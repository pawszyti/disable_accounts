<?php
$db13_host = '192.168.1.13';
$db13_name = 'skrypt';
$db13_user = 'skrypt';
$db13_pass = 'pawel098!';

@ $db13 = new mysqli($db13_host,$db13_user,$db13_pass,$db13_name);

if (mysqli_connect_errno()) {
    echo "Error: ".$db13->connect_errno;
    exit;
}
$db13-> query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'"); //dodanie kodowania utf-8

$db2_host = '192.168.1.3';
$db2_name = 'hr';
$db2_user = 'skrypt';
$db2_pass = 'pawel098!';

@ $db2 = new mysqli($db2_host,$db2_user,$db2_pass,$db2_name);
if (mysqli_connect_errno()) {
    echo "Error: ".$db2->connect_errno;
    exit;
}
$db2-> query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
