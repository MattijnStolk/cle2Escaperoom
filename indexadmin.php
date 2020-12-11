<?php

require_once "includes/database.php";

$query = "SELECT * FROM reserveringen";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array
$reserveringen = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reserveringen[] = $row;
}

//Close connection
mysqli_close($db);

print_r($reserveringen);
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

</body>
</html>
