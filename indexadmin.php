<?php

require_once "includes/database.php";

$query = "SELECT * FROM reserveringen";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array
$reserveringen = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reserveringen[] = $row;
}

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
        <?php foreach ($reserveringen as $reservering) { ?>
                <?php if ($reservering['bbq'] == 0) $reservering['bbq'] = 'nee';
                        else $reservering['bbq'] = 'ja'?>
            <tr>
                <td><?= $reservering['id'] ?></td>
                <td><?= $reservering['fname'] ?> <?= $reservering['lname'] ?></td>
                <td><?= $reservering['email'] ?></td>
                <td><?= $reservering['date'] ?></td>
                <td><?= $reservering['time'] ?></td>
                <td><?= $reservering['personamount'] ?></td>
                <td><?= $reservering['bbq'] ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
