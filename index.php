<?php
//connect to the db
require_once "includes/database.php";


//check if the form is submitted
if (isset($_POST['submit'])) {
    $fname = mysqli_escape_string($db, $_POST['fname']);
    $lname = mysqli_escape_string($db, $_POST['lname']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $personAmount = mysqli_escape_string($db, $_POST['personamount']);
    $bbq = mysqli_escape_string($db, $_POST['bbq']);
    $date = date("Y-m-d"); //TIJDELIJK!
    $time = date("H:i:s"); //TIJDELIJK!

        print_r($_POST); echo "<br>";

    require_once 'includes/errorHandling.php';

    if (empty($errors)){
        $queryCreate = "INSERT INTO reserveringen (fname, lname, email, date, time, personamount, bbq)
                        VALUES ('$fname', '$lname', '$email', '$date', '$time', '$personAmount', '$bbq')";
        $result = mysqli_query($db, $queryCreate)
        or die('Error: '.$queryCreate .$db -> error);

        echo 'gegevens opgeslagen!';
    }

}

$bbq = "";
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Escapepool Reserveren</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<!-- Hier komt de agenda met de becschikbare tijden -->
<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
    <div class="data-field">
        <label for="fname">Voornaam</label>
        <input id="fname" type="text" name="fname" value="<?= (isset($fname) ? htmlentities($fname) : ''); ?>"/>
        <span><?= (isset($errors['fname']) ? $errors['fname'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="lname">Achternaam</label>
        <input id="lname" type="text" name="lname" value="<?= (isset($lname) ? htmlentities($lname) : ''); ?>"/>
        <span><?= (isset($errors['lname']) ? $errors['lname'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?= (isset($email) ? htmlentities($email) : ''); ?>"/>
        <span><?= (isset($errors['email']) ? $errors['email'] : '') ?></span>
    </div>
    <div class="data-field">
        <p>agenda met beschikbare datum en tijden</p>
    </div>
    <div class="data-field">
        <label for="personamount">Aantal personen</label>
        <input id="personamount" type="number" name="personamount" value="<?= (isset($personAmount) ? htmlentities($personAmount) : ''); ?>"/>
        <span><?= (isset($errors['personAmount']) ? $errors['personAmount'] : '') ?></span>
    </div>
    <div>
        <label for="bbq">wilt u een bbq?</label>
        <select name="bbq" id="bbq">
            <option value="nee" <?php if ($bbq == 'nee'|| $bbq == "") echo 'selected' ?>>Nee</option>
            <option value="ja" <?php if ($bbq == 'ja') echo 'selected' ?>>Ja</option>
        </select>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
</body>
</html>
