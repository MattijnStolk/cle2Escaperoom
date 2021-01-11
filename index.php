<?php
/** @var mysqli $db */
//connect to the db
require_once "includes/database.php";

$errors['temp'] = 'temp';


//check if the form is submitted
if (isset($_POST['submit'])) {



    $type           = mysqli_escape_string($db, $_POST['type']);
    $fname          = mysqli_escape_string($db, $_POST['fname']);
    $lname          = mysqli_escape_string($db, $_POST['lname']);
    $email          = mysqli_escape_string($db, $_POST['email']);
    $tel            = mysqli_escape_string($db, $_POST['tel']);
    $personAmount   = mysqli_escape_string($db, $_POST['personamount']);
    $bbq            = mysqli_escape_string($db, $_POST['bbq']);
    $note           = mysqli_escape_string($db, $_POST['note']);
    $date           = $_POST['date'];

    if ($type == 'proefduik'){
        $type = '';
        $proefduik = 'ja';
    } else {
        $proefduik  = mysqli_escape_string($db, $_POST['proefduik']);
    }

        print_r($_POST); echo "<br>";
}
if (isset($_POST['submit2'])){
    $email          = mysqli_escape_string($db, $_POST['email']);
    $time           = mysqli_escape_string($db, $_POST['time']);
    echo $email;
    echo "<br>";

    require_once 'includes/errorHandling.php';

    unset($errors['temp']);

    if (empty($errors)){
        $queryCreate = "INSERT INTO reserveringen (type, proefduik, fname, lname, email, phone, date, personamount, bbq, note, time)
                        VALUES ('$type', '$proefduik', '$fname', '$lname', '$email', '$tel', '$date', '$personAmount', '$bbq', '$note', '$time')";
        $result = mysqli_query($db, $queryCreate)
        or die('Error: '.$queryCreate .$db -> error);

        echo 'gegevens opgeslagen!';
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
<?php print_r($errors) ?>
<?php if (!empty($errors))//{ ?>
<!-- Hier komt de agenda met de becschikbare tijden -->
<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
    <div class="data-field">
        <label for="type">Wat wilt u boeken?</label>
        <select name="type" id="type">
            <option value="" hidden <?php if ($type == '') echo 'selected' ?>>Kies een optie!</option>
            <option value="escapepool" <?php if ($type == 'escapepool') echo 'selected' ?>>Escapepool</option>
            <option value="escapepod" <?php if ($type == 'escapepod') echo 'selected' ?>>Escapepod</option>
            <option value="proefduik" <?php if ($type == 'proefduik') echo 'selected' ?>>Alleen proefduik</option>
        </select>
    </div>
    <?php if (!$type == 'proefduik'){ ?>
    <div class="data-field">
        <label for="proefduik">wilt u een proefduik?</label>
        <select name="proefduik" id="proefduik">
            <option value="" hidden <?php if ($proefduik == '') echo 'selected' ?>>Kies een optie!</option>
            <option value="nee" <?php if ($proefduik == 'nee') echo 'selected' ?>>Nee</option>
            <option value="ja" <?php if ($proefduik == 'ja') echo 'selected' ?>>Ja</option>
        </select>
    </div>
    <?php } ?>
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
    <div class="calendar">
        <label  for  ="date" > Datum
            <input type="date"
                   name="date"
                   min="2020-01-01"
                   max="2020-12-31"
                   value="<?= isset($date)? $date:''?> ">
            <span class="errors><?= isset($errors['date'])? $errors['date'] : ''?>"
        </label>
    </div>
    <div class="data-field">
        <label for="personamount">Aantal personen</label>
        <input id="personamount" type="number" name="personamount" value="<?= (isset($personAmount) ? htmlentities($personAmount) : ''); ?>"/>
        <span><?= (isset($errors['personAmount']) ? $errors['personAmount'] : '') ?></span>
    </div>
    <div>
        <label for="bbq">wilt u een bbq?</label>
        <select name="bbq" id="bbq">
            <option value="" hidden <?php if ($bbq == '') echo 'selected' ?>>Kies een optie!</option>
            <option value="nee" <?php if ($bbq == 'nee') echo 'selected' ?>>Nee</option>
            <option value="ja" <?php if ($bbq == 'ja') echo 'selected' ?>>Ja</option>
        </select>
    </div>
    <label for="note">Heeft u toevoegingen?</label>
    <input id="note" type="text" name="note" value="<?= (isset($note) ? htmlentities($note) : ''); ?>"/>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
    <?php //} ?>

    <?php if (empty($errors) && isset($_POST['submit'])){ ?>
    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
        <div>
            <input step="" type="time">
        </div>
        <div class="data-submit">
            <input type="submit" name="submit2" value="Save2"/>
        </div>
    </form>
    <?php } ?>

    <?php if (empty($errors) && isset($_POST['submit2'])){ ?>

    <div>
        <p>
            je boeking is geslaagd!
        </p>
    </div>

    <?php } ?>
    <div>
        <p><a href="indexadmin.php">indexAdmin</a></p>
    </div>
</form>
</body>
</html>
