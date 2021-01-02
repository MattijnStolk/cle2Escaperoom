<?php

require_once "includes/database.php";

//connect with the reservervations table
$queryReservations = "SELECT * FROM reserveringen";
$resultReservations = mysqli_query($db, $queryReservations);

$reservations = [];
while ($row = mysqli_fetch_assoc($resultReservations)) {
    $reservations[] = $row;
}

//connect with the admin table
$queryAdmin = "SELECT * FROM admin";
$resultAdmin= mysqli_query($db, $queryAdmin);

$admin = [];
while ($row1 = mysqli_fetch_assoc($resultAdmin)) {
    $admin[] = $row1;
}
//check if the user is an admin

//connect with the availabletimes table
$queryTimes = "SELECT * FROM availabletimes";
$resultTimes = mysqli_query($db, $queryTimes);

$availableTimes = [];
while ($row2 = mysqli_fetch_assoc($resultTimes)){
    $availableTimes[] = $row2;
}

print_r($admin);
echo "<br>";
print_r($availableTimes);

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
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Naam</th>
                <th>Email</th>
                <th>datum</th>
                <th>tijd</th>
                <th>aantal personen</th>
                <th>bbq?</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="9">&copy; Reserveringen</td>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($reservations as $reservation) { ?>
            <tr>
                <td><?= $reservation['id'] ?></td>
                <td><?= $reservation['fname'] ?> <?= $reservation['lname'] ?></td>
                <td><?= $reservation['email'] ?></td>
                <td><?= $reservation['date'] ?></td>
                <td><?= $reservation['time'] ?></td>
                <td><?= $reservation['personamount'] ?></td>
                <td><?= $reservation['bbq'] ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
