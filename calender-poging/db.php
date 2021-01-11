<?php
// General settings
$host       = "sql.hosted.hro.nl";
$database   = "prj_2020_2021_cmgt_reservering";
$user       = "prj_2020_2021_cmgt_reservering";
$password   = "eiziavag";

$db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());;
