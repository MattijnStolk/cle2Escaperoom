<?php

require_once "includes/database.php";


$bbq = 1;
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
        <input id="fname" type="text" name="fname" value="<?= (isset($fname) ? $fname : ''); ?>"/>
        <span><?= (isset($errors['fname']) ? $errors['fname'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="lname">Achternaam</label>
        <input id="lname" type="text" name="lname" value="<?= (isset($lname) ? $lname : ''); ?>"/>
        <span><?= (isset($errors['lname']) ? $errors['lname'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?= (isset($email) ? $email : ''); ?>"/>
        <span><?= (isset($errors['email']) ? $errors['email'] : '') ?></span>
    </div>
    <div class="data-field">
        <p>agenda met beschikbare datum en tijden</p>
    </div>
    <div class="data-field">
        <label for="personamount">Aantal personen</label>
        <input id="personamount" type="number" name="personamount" value="<?= (isset($personamount) ? $personamount : ''); ?>"/>
        <span><?= (isset($errors['personamount']) ? $errors['personamount'] : '') ?></span>
    </div>
    <div>
        <?php if ($bbq == 0) $bbq = '';
        else $bbq = 'checked'?>
        <label for="bbq">wilt u een bbq?</label>
        <input id="bbq" type="checkbox" name="bbq" <?= $bbq ?>>
        <span><?= (isset($errors['bbq']) ? $errors['bbq'] : '') ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
</body>
</html>
