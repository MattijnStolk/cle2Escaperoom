<?php
/** @var mysqli $db */
//connect to the db
require_once 'includes/database.php';

session_start();

$login = false;

if (isset($_SESSION['username'])) {
    $login = true;
    header('Location: indexAdmin.php');
}

if (isset($_POST['submit'])) {
    $username = mysqli_escape_string($db, $_POST['username']);
    $password = mysqli_escape_string($db, $_POST['password']);

    if ($username == '') {
        $errors['username'] = 'email can not be empty';
    }
    if ($password == '') {
        $errors['password'] = 'password can not be empty';
    }

    if (empty($errors)) {
        $query = "SELECT * FROM admin WHERE username = '$username'";
        $result = mysqli_query($db, $query)
        or die ('Error: ' . $query);


        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            print_r($user);
            if (password_verify($password, $user['password'])) {
                $login = true;
                $_SESSION['username'] = $username;
                header('Location: indexAdmin.php');
            }
            if (isset($errors['nologin'])) {
                unset($errors['nologin']);
            }
        } else {
            if ($login == false) {
                $errors['wrongPassOrMail'] = 'je moet wel het goede invullen knaap2';
            }
        }

    }
}

if (isset($_POST['logout'])) {
    echo 'uitgelogd';
    session_unset();
    session_destroy();
}

//inloggen via login pagina
//ALS je bij de indexadmin komt zonder session['username']
//DAN wordt je terug gestuurd naar de login pagina (header:login.php)
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h1>Login</h1>


<form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
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
        <input type="submit" name="submit" value="Login"/>
    </div>
</form>

<p><a href="index.php">Terug naar de index.</a></p>
<p><a href="register.php">Create user</a></p>
</body>
</html>