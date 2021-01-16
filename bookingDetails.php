<?php
if (!isset($_GET['time'])){
    header('Location: index.php');
}

/** @var mysqli $db */
//connect to the db
require_once "includes/database.php";

$errors['temp'] = 'temp';

$time = mysqli_escape_string($db, $_GET['time']);
$date = mysqli_escape_string($db, $_GET['date']);
$type = mysqli_escape_string($db, $_GET['type']);

$firstSubmit = false;

//check if the form is submitted
if (isset($_POST['submit']) || $firstSubmit == true) {
    $firstSubmit = true;

    $fname = mysqli_escape_string($db, $_POST['fname']);
    $lname = mysqli_escape_string($db, $_POST['lname']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $tel = mysqli_escape_string($db, $_POST['tel']);
    $personAmount = mysqli_escape_string($db, $_POST['personamount']);
    $bbq = mysqli_escape_string($db, $_POST['bbq']);
    $note = mysqli_escape_string($db, $_POST['note']);

    require_once 'includes/errorHandling.php';

    unset($errors['temp']);

    if (empty($errors)) {
        $queryCreate = "INSERT INTO reserveringen (type, fname, lname, email, phone, date, personamount, bbq, note, time)
                        VALUES ('$type', '$fname', '$lname', '$email', '$tel', '$date', '$personAmount', '$bbq', '$note', '$time')";
        $result = mysqli_query($db, $queryCreate)
        or die('Error: ' . $queryCreate . $db->error);

        header('Location: bookingSucces.php');
    }
}

if (!isset($proefduik)){
    $proefduik = '';
}
if (!isset($type)){
    $type = '';
}
if (!isset($bbq)){
    $bbq = '';
}

//close the db connection
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
<h1>Boeken <?= $type ?></h1>
<!-- Hier komt de agenda met de becschikbare tijden -->
<?php if (!empty($errors) || isset($_POST['submit'])) { ?>
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
        <label for="tel">Telefoonnummer</label>
        <input id="tel" type="tel" name="tel" value="<?= (isset($tel) ? htmlentities($tel) : ''); ?>"/>
        <span><?= (isset($errors['tel']) ? $errors['tel'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="personamount">Aantal personen</label>
        <input id="personamount" type="number" min="0" max="6" name="personamount" value="<?= (isset($personAmount) ? htmlentities($personAmount) : ''); ?>"/>
        <span><?= (isset($errors['personAmount']) ? $errors['personAmount'] : '') ?></span>
    </div>
    <div>
        <label for="bbq">wilt u een bbq?</label>
        <select name="bbq" id="bbq">
            <option value="" hidden <?php if ($bbq == '') echo 'selected' ?>>Kies een optie!</option>
            <option value="0" <?php if ($bbq == '0') echo 'selected' ?>>Nee</option>
            <option value="1" <?php if ($bbq == '1') echo 'selected' ?>>Ja</option>
        </select>
    </div>
        <label for="note">Heeft u toevoegingen?</label>
        <input id="note" type="text" name="note" value="<?= (isset($note) ? htmlentities($note) : ''); ?>"/>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Opslaan"/>
    </div>
    <?php } ?>
</form>
    <div>
        <p><a href="indexadmin.php">indexAdmin</a></p>
        <p><a href="login.php">Login</a></p>
    </div>
</body>
</html>