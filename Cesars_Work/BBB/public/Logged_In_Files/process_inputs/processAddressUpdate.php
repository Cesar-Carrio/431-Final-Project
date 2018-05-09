<?php

// create short variable names
$firstName     = trim( preg_replace("/\t|\R/",' ',$_POST['firstName']) );
$lastName      = trim( preg_replace("/\t|\R/",' ',$_POST['lastName'])  );
$street        = trim( preg_replace("/\t|\R/",' ',$_POST['street'])    );
$city          = trim( preg_replace("/\t|\R/",' ',$_POST['city'])      );
$state         = trim( preg_replace("/\t|\R/",' ',$_POST['state'])     );
$country       = trim( preg_replace("/\t|\R/",' ',$_POST['country'])   );
$zipCode       = trim( preg_replace("/\t|\R/",' ',$_POST['zipCode'])   );
$position      = trim( preg_replace("/\t|\R/",' ',$_POST['position'])  );
$teamID        = trim( preg_replace("/\t|\R/",' ',$_POST['teamID'])    );

if( empty($firstName) ) $firstName = null;
if( empty($lastName)  ) $lastName  = null;
if( empty($street)    ) $street    = null;
if( empty($city)      ) $city      = null;
if( empty($state)     ) $state     = null;
if( empty($country)   ) $country   = null;
if( empty($zipCode)   ) $zipCode   = null;
if( empty($position)  ) $position  = null;
if( empty($teamID)    ) $teamID    = null;


if( ! empty($lastName) ) // Verify required fields are present
{

    require_once('Adaptation_user.php');
    $conn = new mysqli(DB_SERVER3, DB_USER3, DB_PASS3, DB_NAME3);
    if( mysqli_connect_error() == 0 )  // Connection succeeded
    {
        $query = "insert into People (TeamID, Name_First, Name_Last, Street, City, State, Country, ZipCode, PersonType) 
                  values
                  (?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
       if ($stmt->bind_param('dssssssss',$teamID ,$firstName, $lastName, $street, $city, $state, $country, $zipCode,$position)){
           $stmt->execute();
           header("Location: ../index.php?input=success");
       } else {
           header("Location: ../index.php?input=success");
       }


    }
}


?>
