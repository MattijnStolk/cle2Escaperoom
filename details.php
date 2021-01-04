<?php
/** @var mysqli $db */
// redirect when url does not contain a id
if(!isset($_GET['id'])) {
    // redirect to index.php
    header('Location: indexAdmin.php');
    exit;
}

//Require database in this file
require_once "includes/database.php";

//Retrieve the GET parameter from the 'Super global'
$id = $_GET['id'];

$query = "SELECT * FROM reserveringen WHERE id = " . mysqli_escape_string($db, $id);
$result = mysqli_query($db, $query)
or die ('Error: ' . $query . mysqli_error($db));

if(mysqli_num_rows($result) == 1)
{
    $reservationsInfo = mysqli_fetch_assoc($result);
}
else {
    //redirect when db returns no result
    header('Location: index.php');
    exit;
}

if ($reservationsInfo['type'] == ""){
    $typeAfspraak = 'Alleen proefduik';
} else if ($reservationsInfo['type'] == "escapepool" && $reservationsInfo['proefduik'] == 'ja'){
    $typeAfspraak = 'Escapepool en Proefduik';
} else if ($reservationsInfo['type'] == "escapepool" && $reservationsInfo['proefduik'] == 'nee'){
    $typeAfspraak = 'Escapepool';
} else if ($reservationsInfo['type'] == "escapepod" && $reservationsInfo['proefduik'] == 'ja'){
    $typeAfspraak = 'Escapepod en Proefduik';
} else if ($reservationsInfo['type'] == "escapepod" && $reservationsInfo['proefduik'] == 'nee'){
    $typeAfspraak = 'Escapepod';
}

print_r($reservationsInfo);
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
    <title>Details reservation</title>
</head>
<body>
    <ul>
        <li>id:  <?= $reservationsInfo['id'] ?></li>
        <li>Voornaam:   <?= $reservationsInfo['fname'] ?></li>
        <li>Achternaam: <?= $reservationsInfo['lname'] ?></li>
        <li>Welke afspraak: <?= $typeAfspraak ?></li>
    </ul>

    <p><a href="http://localhost/cle2Escaperoom/indexAdmin.php">return to indexAdmin</a></p>
</body>
</html>
