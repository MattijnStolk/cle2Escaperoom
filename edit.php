<?php
/** @var mysqli $db */
require_once "includes/database.php";

session_start();

//IF not logged in you'll be sent to login.php
if (!$_SESSION['username']) {
    header('Location: /cle2Escaperoom/login.php');
}
if(!isset($_GET['id'])) {
    header('Location: /cle2Escaperoom/indexAdmin.php');
    exit;
}

if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'

    $id = mysqli_escape_string($db, $_POST['id']);
    $type = mysqli_escape_string($db, $_POST['type']);
    $fname = mysqli_escape_string($db, $_POST['fname']);
    $lname = mysqli_escape_string($db, $_POST['lname']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $phone = mysqli_escape_string($db, $_POST['phone']);
    $date = mysqli_escape_string($db, $_POST['date']);
    $time = mysqli_escape_string($db, $_POST['time']);
    $phone = mysqli_escape_string($db, $_POST['phone']);
    $personAmount = mysqli_escape_string($db, $_POST['personamount']);
    $bbq = mysqli_escape_string($db, $_POST['bbq']);
    $personBBQ = mysqli_escape_string($db, $_POST['personBBQ']);
    $note = mysqli_escape_string($db, $_POST['note']);

    if ($personBBQ == '' || $personBBQ == ' '){
        $personBBQ = 0;
    }

    $reservation = [
            'id' => $id,
            'type' => $type,
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'phone' => $phone,
            'date' => $date,
            'time' => $time,
            'personamount' => $personAmount,
            'bbq' => $bbq,
            'bbqperson' => $personBBQ,
            'note' => $note,
    ];

    require_once 'includes/errorHandling.php';

    if (empty($errors)){
        //Update the record in the database
        $query = "UPDATE reserveringen
                  SET fname = '$fname', lname = '$lname', email = '$email', phone = '$phone', date = '$date', personamount = '$personAmount', bbq = '$bbq', bbqperson = '$personBBQ', note = '$note'
                  WHERE id = '$id'";
        $result = mysqli_query($db, $query) or die('Error: ' . $query . $db->error);;
    }
} else if (isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $id = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM reserveringen WHERE id = " . mysqli_escape_string($db, $id);
    $result = mysqli_query($db, $query) or die('Error: ' . $query . $db->error);;
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
    <title>Edit</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="type">type</label>
        <select name="type" id="type">
            <option value="proefduik" <?php if ($reservation['type'] == 'proefduik') echo 'selected' ?>>Proefduik</option>
            <option value="escapepod" <?php if ($reservation['type'] == 'escapepod') echo 'selected' ?>>Esacpepod</option>
            <option value="escapepool" <?php if ($reservation['type'] == 'escapepool') echo 'selected' ?>>Escapepool</option>
        </select>
    </div>
    <div class="data-field">
        <label for="fname">voornaam</label>
        <input id="fname" type="text" name="fname" value="<?= isset($fname) ? htmlentities($fname) : htmlentities($reservation['fname'])?>"/>
        <span class="errors"><?= isset($errors['fname']) ? $errors['fname'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="lname">achternaam</label>
        <input id="lname" type="text" name="lname" value="<?= isset($lname) ? htmlentities($lname) : htmlentities($reservation['lname'])?>"/>
        <span class="errors"><?= isset($errors['lname']) ? $errors['lname'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="email">Email</label>
        <input id="email" type="text" name="email" value="<?= isset($email) ? htmlentities($email) : htmlentities($reservation['email'])?>"/>
        <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="tel">telefoonnummer</label>
        <input id="tel" type="tel" name="phone" value="<?= isset($phone) ? htmlentities($phone) : htmlentities($reservation['phone'])?>"/>
        <span><?= (isset($errors['phone']) ? $errors['phone'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="date">Datum</label>
        <input id="date" type="date" name="date" value="<?=($reservation['date'])?>"/>
        <span class="errors"><?= isset($errors['date']) ? $errors['date'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="time">Tijd</label>
        <input id="time" type="time" name="time" value="<?=($reservation['time'])?>"/>
        <span class="errors"><?= isset($errors['time']) ? $errors['time'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="personamount">Aantal personen</label>
        <input id="personamount" type="number" min="1" max="6" name="personamount" value="<?= htmlentities($reservation['personamount']) ?>"/>
        <span class="errors"><?= (isset($errors['personAmount']) ? $errors['personAmount'] : '') ?></span>
    </div>
    <div>
        <label for="bbq">wilt u een bbq?</label>
        <select name="bbq" id="bbq">
            <option value="" hidden <?php if ($reservation['bbq'] == '') echo 'selected' ?>>Kies een optie!</option>
            <option value="0" <?php if ($reservation['bbq'] == '0') echo 'selected' ?>>Nee</option>
            <option value="1" <?php if ($reservation['bbq'] == '1') echo 'selected' ?>>Ja</option>
        </select>
    </div>
    <?php if ($bbq = 1){ ?>
        <div id="bbqPersons">
            <label for="personBBQ">Met hoeveel personen wilt u komen bbq?</label>
            <input type="number" id="personBBQ" name="personBBQ" min="0" max="12" value="<?= $reservation['bbqperson'] ?>">
            <span><?= (isset($errors['personBBQ']) ? $errors['personBBQ'] : '') ?></span>
        </div>
    <?php } ?>
    <div class="data-field">
        <label for="note">toevoegingen</label>
        <input id="note" type="text" name="note" value="<?= htmlentities($reservation['note']) ?>"/>
        <span class="errors"><?= (isset($errors['personAmount']) ? $errors['personAmount'] : '') ?></span>
    </div>
    <div class="data-submit">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>"/>
        <input type="submit" name="submit" value="Save"/>
    </div>

</form>
<div>
    <a href="./indexadmin.php">go back to index admin</a>
</div>
</body>
</html>
