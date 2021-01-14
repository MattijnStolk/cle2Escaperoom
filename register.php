<?php
/** @var mysqli $db */
require_once 'includes/database.php';

if (isset($_POST['submit'])){
    $username = mysqli_escape_string($db, $_POST['username']);
    $password = mysqli_escape_string($db, $_POST['password']);


    if ($username == ''){
        $errors['username'] = 'Username mag niet leeg zijn';
    }
    if ($password == ''){
        $errors['password'] = 'Password mag niet leeg zijn';
    }

    if (empty($errors)){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO admin (username, password)
                          VALUES ('$username', '$hashedPassword')";
        $result = mysqli_query($db, $query)
        or die('Error: '.$db -> error);

        if ($result) {
            header('Location: login.php');
            exit;
        } else {
            echo 'er ging iets mis';
        }
    }
}

mysqli_close($db);
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
    <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?> ">
        <div>
            <label for="username">Gebruikersnaam: </label>
            <input id="username" type="text" name="username"/>
            <span class="errors"><?= isset($errors['username']) ? $errors['username'] : '' ?></span>
        </div>
        <div>
            <label for="password">Wachtwoord:</label>
            <input id="password" type="password" name="password"/>
            <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
        </div>
        <div>
            <input type="submit" name="submit" value="Register"/>
        </div>
    </form>
</body>
</html>