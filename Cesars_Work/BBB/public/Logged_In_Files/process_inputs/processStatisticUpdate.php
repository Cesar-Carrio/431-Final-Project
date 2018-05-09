<?php

// create short variable names
$name       = (int) $_POST['name_ID'];  // Database unique ID for player's name
$time       = trim( preg_replace("/\t|\R/",' ',$_POST['time']) );
$points     = (int) $_POST['points'];
$assists    = (int) $_POST['assists'];
$rebounds   = (int) $_POST['rebounds'];
$gameID     = (int) $_POST['GameID'];

if( empty($name)     ) $name      = null;
// see below for $time processing
if( empty($points)   ) $points    = null;
if( empty($assists)  ) $assists   = null;
if( empty($rebounds) ) $rebounds  = null;
if( empty($gameID)   )   $gameID  = null;

$time = explode(':', $time); // convert string to array of minutes and seconds
if( count($time) >= 2 )
{
    $minutes = (int)$time[0];
    $seconds = (int)$time[1];
}
else if( count($time) == 1 )
{
    $minutes = (int)$time[0];
    $seconds = null;
}
else
{
    $minutes = null;
    $seconds = null;
}


if( ! empty($name) )  // Verify required fields are present
{
    require_once('Adaptation_user.php');
    $conn = new mysqli(DB_SERVER3, DB_USER3, DB_PASS3, DB_NAME3);
    if( mysqli_connect_error() == 0 )  // Connection succeeded
    {
        $query = "insert into Statistics (PlayerID, GameID, PlayingTimeMin, PlayingTimeSec, Points, Assists, Rebounds) values
                  (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);

        if($stmt->bind_param('ddddddd', $name, $gameID, $minutes, $seconds, $points, $assists, $rebounds)){
            $stmt->execute();
            header("Location: ../index.php?StatInput=Success");
        } else {
            header("Location: ../index.php?StatInput=Failed");
        }

    }
}

?>

