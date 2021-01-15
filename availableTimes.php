<?php
session_start();

//IF not logged in you'll be sent to login.php
if (!$_SESSION['username']) {
    header('Location: login.php');
}

if (!isset($_GET['type'])){
    header('Location: indexAdmin.php');
}

/** @var mysqli $db */
require_once "includes/database.php";

$type = mysqli_escape_string($db, $_GET['type']);

$queryTimes = "SELECT * FROM availabletimes WHERE type = '$type'";
$resultTimes = mysqli_query($db, $queryTimes);

$availableTimes = [];
while ($row = mysqli_fetch_assoc($resultTimes)){
    $availableTimes[] = $row;
}

if (isset($_POST['submit'])){
    print_r($_POST);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?= $type ?>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>tijd</th>
                <th>datum</th>
                <th>type</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($availableTimes as $slots) { ?>
            <tr>
                <td><?= $slots['id'] ?></td>
                <td><?= $slots['date'] ?></td>
                <td><?= $slots['time'] ?></td>
                <td><?= $slots['type'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if ($type == 'escapepod') { ?>
    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
        <input type="checkbox" name="timesA[]" value="10">
        <input type="checkbox" name="timesA[]" value="12">
        <input type="checkbox" name="timesA[]" value="14">
        <input type="checkbox" name="timesA[]" value="16">
        <input type="checkbox" name="timesA[]" value="18">
        <input type="checkbox" name="timesA[]" value="20">
        <input type="checkbox" name="timesA[]" value="22">
        <input type="submit" value="Save" name="submit">
    </form>
    <?php } ?>
    <?php if($type == 'escapepool') { ?>
    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
        <input type="checkbox" name="timesA[]" value="9">
        <input type="checkbox" name="timesA[]" value="11">
        <input type="checkbox" name="timesA[]" value="13">
        <input type="checkbox" name="timesA[]" value="15">
        <input type="checkbox" name="timesA[]" value="17">
        <input type="checkbox" name="timesA[]" value="19">
        <input type="checkbox" name="timesA[]" value="21">
        <input type="submit" value="Save" name="submit">
    </form>
    <?php } ?>
</body>
</html>
