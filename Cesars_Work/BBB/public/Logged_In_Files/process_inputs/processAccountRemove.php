<?php

// create short variable names
$firstName     = trim( preg_replace("/\t|\R/",' ',$_POST['firstName']) );
$lastName      = trim( preg_replace("/\t|\R/",' ',$_POST['lastName'])  );
$username      = trim( preg_replace("/\t|\R/",' ',$_POST['username'])  );

if( empty($firstName) ) $firstName = null;
if( empty($lastName)  ) $lastName  = null;
if( empty($username)  ) $username  = null;


if( ! empty($username) )  // Verify required fields are present
{
    require_once('Adaptation_exec.php');
    $conn = new mysqli(DB_SERVER3, DB_USER3, DB_PASS3, DB_NAME3);
    echo DB_USER3;
    if( mysqli_connect_error() == 0 )  // Connection succeeded
    {
        $query = "DELETE FROM Accounts WHERE Username = ?";
        $stmt = $conn->prepare($query);

        if($stmt->bind_param('s',$username)){
            $stmt->execute();
            header("Location: ../index.php?AccountRemoval=Success");
        } else {
            header("Location: ../index.php?AccountRemoval=Failed");
        }

    }
}

?>

