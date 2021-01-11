<?php
function build_calander($month, $year) {
    //array met dagen
    
    $daysOfWeek = array('Z','M', 'D','W', 'D', 'V', 'Z');

    //wat is de eerste dag van de maand
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    //hoeveel dagen heeft de maand
    $numberDays = date('t', $firstDayOfMonth);

    //welke maand?
    $dateComponents = getdate($firstDayOfMonth);
    
    $monthName = $dateComponents['month'];

    //tabels maken
    $calendar = '<table class = "calandar">';
    $calendar .= "<caption>$monthName $year</caption>";
    $calendar .= "<tr>";

    //tabel headers AKA dagen etc
    foreach($daysOfWeek as $day){
        $calendar .= "<th class='header'>$day</th>";
    }

    // initiate de dag teller, begin met dag 1
    $currentDay = 1;

    $daysOfWeek = $dateComponents['wday'];

    //calander mag maar 7 colums (dagen)
    if($daysOfWeek > 0) {
        $calendar .= "<td colspan='$daysOfWeek'>&nbsp;</td>";
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while($currentDay <= $numberDays){
        //zevende column, zaterdag, begitn een nieuwe row

         if($daysOfWeek == 7){
                $daysOfWeek =0;
                $calendar .= "</tr><tr>";
         }

         $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

         $date = "$year-$month-$currentDayRel";
         $calendar .= "<td class='day' rel='$date'>$currentDay</td";

      
         $currentDay++;
         $daysOfWeek++;
    }
    //laaste week van de maand fixen

    if($daysOfWeek !=7){
        $remainingDays = 7 - $daysOfWeek;
        $calendar .= "<td colspan='$remainingDays'>&nbsp;<td>";
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";
    
    return $calendar;

}
?>

<?php

$dateComponents = getdate();

$month = $dateComponents['mon'];
$year = $dateComponents['year'];

echo build_calander($month, $year);
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


