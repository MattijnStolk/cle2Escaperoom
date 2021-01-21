<?php

if (!isset($_GET['day'])){
    header('Location: index.php');
}

/** @var mysqli $db */
//connect to the DB
require_once 'includes/database.php';

$year = $_GET['year'];
$month = $_GET['month'];
$day = $_GET['day'];

$dateQuery = "$year-$month-$day";




$query = "SELECT * FROM availabletimes WHERE date = '$dateQuery' AND open = '1'";
$result = mysqli_query($db, $query)
    or die('Error: Er zijn geen beschikbare tijden open op deze datum.');

if (mysqli_num_rows($result) == 1) {
    $availableTimes = [];
    while ($row = mysqli_fetch_assoc($result)){
        $availableTimes[] = $row;
    }} else {
       die('Er zijn geen beschikbare tijden open op die datum!');
    }



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TIJD KIEZEN</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Datum</th>
        <th>Tijd</th>
        <th>Type</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <!--Hier komt in plaats van de tabel een calender met de dagen waar afspraken staan, als op de datum klikt krijg je een
        lijst met de afspraak + achternaam + telnummer + knop naar details pagina.        -->
    <tbody>
    <?php foreach ($availableTimes as $times) { ?>
        <tr>
            <td><?= $times['date'] ?></td>
            <td><?= $times['time'] ?></td>
            <td><?= $times['type'] ?></td>
            <td><a href="bookingDetails.php?date=<?=$times['date']?>&time=<?=$times['time']?>&type=<?=$times['type']?>">reserveren!</a></td>

        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
