<?php
/** @var mysqli $db */
require_once "includes/database.php";

session_start();

//IF not logged in you'll be sent to login.php
if (!$_SESSION['username']) {
    header('Location: login.php');
}

//connect with the reservervations table
$queryReservations = "SELECT * FROM reserveringen";
$resultReservations = mysqli_query($db, $queryReservations);

$reservations = [];
while ($row = mysqli_fetch_assoc($resultReservations)) {
    $reservations[] = $row;
}

//connect with the availabletimes table


//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/adminstyles.css">
    <title>Document</title>
</head>
<body>
    <p><a href="availableTimes.php?type=escapepod">Beschikbare tijden Escapepod</a></p>
    <p><a href="availableTimes.php?type=escapepool">Beschikbare tijden Escapepool</a></p>
    <p><a href="availableTimes.php?type=proefduik">Beschikbare tijden proefduik</a></p>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Naam</th>
                    <th>Type </th>
                    <th>proefduik</th>
                    <th>Email</th>
                    <th>datum</th>
                    <th>tijd</th>
                    <th>aantal personen</th>
                    <th>bbq?</th>
                    <th>Details</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan="9">&copy; Reserveringen</td>
            </tr>
            </tfoot>
    <!--Hier komt in plaats van de tabel een calender met de dagen waar afspraken staan, als op de datum klikt krijg je een
        lijst met de afspraak + achternaam + telnummer + knop naar details pagina.        -->
            <tbody>
            <?php foreach ($reservations as $reservation) {
                if ($reservation['bbq'] == 0) {$reservation['bbq'] = 'nee';} else {$reservation['bbq'] = 'ja';}?>
                <tr>
                    <td><?= $reservation['id'] ?></td>
                    <td><?= $reservation['fname'] ?> <?= $reservation['lname'] ?></td>
                    <td><?= $reservation['type'] ?></td>
                    <td><?=$reservation['proefduik']?></td>
                    <td><?= $reservation['email'] ?></td>
                    <td><?= $reservation['date'] ?></td>
                    <td><?= $reservation['time'] ?></td>
                    <td><?= $reservation['personamount'] ?></td>
                    <td><?= $reservation['bbq'] ?></td>
                    <td><a href="details.php/?id=<?=$reservation['id']?>">details</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
<p><a href="logout.php">Logout</a></p>
</body>
</html>
