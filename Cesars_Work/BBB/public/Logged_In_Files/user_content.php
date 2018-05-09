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
?>


<h1>User Role</h1>

<table style="width: 100%; border:0px solid black; border-collapse:collapse;">
    <tr>
        <th style="width: 40%;">Name and Address</th>
        <th style="width: 60%;">Statistics</th>
    </tr>
    <tr>
        <td style="vertical-align:top; border:1px solid black;">
            <!-- FORM to enter Name and Address -->
            <form action="process_inputs/processAddressUpdate.php" method="post">
                <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
                    <tr>
                        <td style="text-align: right; background: lightblue;">First Name</td>
                        <td><input type="text" name="firstName" value="" size="35" maxlength="250"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Last Name</td>
                        <td><input type="text" name="lastName" value="" size="35" maxlength="250"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Street</td>
                        <td><input type="text" name="street" value="" size="35" maxlength="250"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">City</td>
                        <td><input type="text" name="city" value="" size="35" maxlength="250"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">State</td>
                        <td><input type="text" name="state" value="" size="35" maxlength="100"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Country</td>
                        <td><input type="text" name="country" value="" size="20" maxlength="250"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Zip</td>
                        <td><input type="text" name="zipCode" value="" size="10" maxlength="10"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Coach or Player</td>
                        <td><input type="text" name="position" value="" size="10" maxlength="10"/> <i>Capitalize first letter!</i></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Team ID</td>
                        <td><input type="text" name="teamID" value="" size="10" maxlength="10" placeholder="eg..1,2,3"/></td>
                    </tr>

                    <tr>
                        <td colspan="2" style="text-align: center;"><input type="submit" value="Add Name and Address" /></td>
                    </tr>
                </table>
            </form>
        </td>

        <td style="vertical-align:top; border:1px solid black;">
            <!-- FORM to enter game statistics for a particular player -->
            <form action="process_inputs/processStatisticUpdate.php" method="post">
                <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
                    <tr>
                        <td style="text-align: right; background: lightblue;">Name (Last, First)</td>
                        <!--            <td><input type="text" name="name" value="" size="50" maxlength="500"/></td>  -->
                        <td><select name="name_ID" required>
                                <option value="" selected disabled hidden>Choose player's name here</option>
                                <?php
                                // for each row of data returned,
                                //   construct an Address object providing first and last name
                                //   emit an option for the pull down list such that
                                //     the displayed name is retrieved from the Address object
                                //     the value submitted is the unique ID for that player
                                // for example:
                                //     <option value="101">Duck, Daisy</option>
                                $stmt->data_seek(0);
                                while( $stmt->fetch() )
                                {
                                    $player = new Address([$Name_First, $Name_Last]);
                                    echo "<option value=\"$ID\">".$player->name()."</option>\n";
                                }
                                ?>
                            </select></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Playing Time (min:sec)</td>
                        <td><input type="text" name="time" value="" size="5" maxlength="5"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Points Scored</td>
                        <td><input type="text" name="points" value="" size="3" maxlength="3"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Assists</td>
                        <td><input type="text" name="assists" value="" size="2" maxlength="2"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Rebounds</td>
                        <td><input type="text" name="rebounds" value="" size="2" maxlength="2"/></td>
                    </tr>

                    <tr>
                        <td style="text-align: right; background: lightblue;">Game ID</td>
                        <td><input type="text" name="GameID" value="" size="2" maxlength="2" placeholder="eg.1,2"/></td>
                    </tr>

                    <tr>
                        <td colspan="2" style="text-align: center;"><input type="submit" value="Add Statistic" /></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>

<br>


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