<?php
//kijken of je bent ingelogd
//checken of er een ID is meegegeven
//reservering verwijderen
//header terug naar de indexadmin pagina

/** @var mysqli $db */
require_once "includes/database.php";

session_start();

//IF not logged in you'll be sent to login.php
if (!$_SESSION['username']) {
    header('Location: /cle2Escaperoom/login.php');
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM reserveringen WHERE id = '$id'";

    mysqli_query($db, $query) or die ('Error: '.mysqli_error($db));

    //Close connection
    mysqli_close($db);

    //Redirect to homepage after deletion & exit script
    header('Location: /cle2Escaperoom/indexAdmin.php');
    exit;


} else if (isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "SELECT * FROM reserveringen WHERE id = '$id'";
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

    if (mysqli_num_rows($result) == 1) {
        $reservation = mysqli_fetch_assoc($result);
    } else {
        //redirect when db returns no result
        header('Location: /cle2Escaperoom/indexAdmin.php');
        exit;
    }

} else {
    header('Location: /cle2Escaperoom/indexAdmin.php');
    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete - <?= $reservation['type'] ?></title>
</head>
<body>
<h2>Delete - <?= $reservation['type'] ?></h2>
<form action="" method="post">
    <p>
        Weet u zeker dat u de boeking van <?= $reservation['fname'] ?> <?= $reservation['lname'] ?> wilt verwijderen?
    </p>
    <p>Deze afsrpaak staat op <?= $reservation['date']?> om <?= $reservation['time']?></p>
    <p>Email : <?= $reservation['email']?></p>
    <p>Telefoonnummer : <?= $reservation['phone']?></p>

    <input type="hidden" name="id" value="<?= $reservation['id'] ?>"/>
    <input type="submit" name="submit" value="Verwijderen"/>
</form>
</body>
</html>
