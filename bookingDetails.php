<?php
if (!isset($_GET['time'])){
    header('Location: calendar.php');
}

$time = $_GET['time'];
$date = $_GET['date'];
$type = $_GET['type'];

echo $time; echo '<br>';
echo $date; echo '<br>';
echo $type; echo '<br>';