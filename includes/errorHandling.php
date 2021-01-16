<?php
$errors = [];
if ($fname == "") {
    $errors['fname'] = 'Voornaam mag niet leeg zijn.';
}
if ($lname == "") {
    $errors['lname'] = 'Achternaam mag niet leeg zijn.';
}
if ($email == "") {
    $errors['email'] = 'E-mail mag niet leeg zijn.';
}
if (!is_numeric($personAmount) || $personAmount == "") {
    $errors['personAmount'] = 'aantal pesonen mag niet leeg zijn en moet een nummer zijn.';
}
if ($personAmount < 0 || $personAmount > 6){
    $errors['personAmount'] = 'Aantal personen moet binnen 1 en 6 zitten. ';
}
if (!is_numeric($tel) || $tel == ""){
    $errors['tel'] = 'Telefoonnummer mag niet leeg zijn en moeten cijfers zijn.';
};