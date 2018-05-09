<h1>Observer Role</h1>






<table style="border:1px solid black; border-collapse:collapse;">
    <tr>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th colspan="2" style="vertical-align:top; border:1px solid black; background: lightgreen;">Player</th>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th colspan="4" style="vertical-align:top; border:1px solid black; background: lightgreen;">Statistic Averages</th>
    </tr>
    <tr>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Address</th>

        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Games Played</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Time on Court</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Points Scored</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Number of Assists</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Number of Rebounds</th>
    </tr>


<?php

require('Address.php');
require('PlayerStatistic.php');
$conn = mysqli_connect(DB_SERVER2, DB_USER2, DB_PASS2, DB_NAME2);

$sql = "
select People.ID, People.Name_First, 
People.Name_Last, People.Street, People.City, People.State, 
People.Country, People.ZipCode,  

COUNT(Statistics.PlayerID),
AVG(Statistics.PlayingTimeMin),
AVG(Statistics.PlayingTimeSec),
AVG(Statistics.Points),
AVG(Statistics.Assists),
AVG(Statistics.Rebounds)

from People Left join Statistics on 
Statistics.PlayerID = People.ID
group by 
People.Name_Last,
People.Name_First,
People.ID
order by
People.Name_Last,
People.Name_First";



$stmt = $conn->prepare($sql);
//no params binding needed
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($ID,$Name_First, $Name_Last, $Street, $City, $State,
    $Country, $Zip, $GamesPlayed, $PlayingTimeMin, $PlayingTimeSec, $Points, $Assists, $Rebounds);

$fmt_style = 'style="vertical-align:top; border:1px solid black;"';
$stmt->data_seek(0);
$row_number = 0;

while( $stmt->fetch() ) {
// construct Address and PlayerStatistic objects supplying as constructor parameters the retrieved database columns
    $player = new Address([$Name_First, $Name_Last], $Street, $City, $State, $Country, $Zip);
    $stat = new PlayerStatistic([$Name_First, $Name_Last], [$PlayingTimeMin, $PlayingTimeSec], $Points, $Assists, $Rebounds);

// Emit table row data using appropriate getters from the Address and PlayerStatistic objects
    echo "      <tr>\n";
    echo "        <td  $fmt_style>" . ++$row_number . "</td>\n";
    echo "        <td  $fmt_style>" . $player->name() . "</td>\n";
    echo "        <td  $fmt_style>" . $player->street() . "<br/>"
        . $player->city() . ', ' . $player->state() . ' ' . $player->zip() . '<br/>'
        . $player->country() . "</td>\n";
    echo "        <td  $fmt_style>" . $GamesPlayed . "</td>\n";
    if ($GamesPlayed > 0) {
        echo "        <td  $fmt_style>" . $stat->playingTime() . "</td>\n";
        echo "        <td  $fmt_style>" . $stat->pointsScored() . "</td>\n";
        echo "        <td  $fmt_style>" . $stat->assists() . "</td>\n";
        echo "        <td  $fmt_style>" . $stat->rebounds() . "</td>\n";
    } else {
        echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
        echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
        echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
        echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
    }
    echo "      </tr>\n";
}

?>

</table>