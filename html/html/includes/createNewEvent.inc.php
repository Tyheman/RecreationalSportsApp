<?php
session_start();
ini_set('error_reporting', E_ALL);
if(isset($_POST['event-submit'])){
    require "../../includes/dbh.inc.php";

    //Gets form information
    $eventName = $_POST['event_name'];
    $eventLocation = $_POST['event_location'];
    $eventDateTime = $_POST['event_datetime'];

    //gets session IDs
    $tempGroupID = $_SESSION['tempGroupID'];
    $tempGroupName = $_SESSION['tempGroupName'];

    //Reglautes data
    if(empty($eventName) || empty($eventLocation) || empty($eventDateTime)) {

        header("Location: ../dashboard.php?error=emptyFields&");
        exit();
    }
    else if(!preg_match("/^([a-zA-Z' ]+)$/", $eventName)) {
        header("Location: ../dashboard.php?error=invaildEventName");
        exit();
    }
    else if(!preg_match("/^([a-zA-Z0-9' ]+)$/", $eventLocation)) {
        header("Location: ../dashboard.php?error=invaildEventLocationName");
        exit();
    }
    else{
        
        //Prepares statement
        $sql = "SELECT event_name FROM EVENTS WHERE event_name=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../dashboard.php?error=sqlerror1");
            exit();
        }
        else{
            //executes statement
            mysqli_stmt_bind_param($stmt, "s", $eventName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            //Insert statement | Insert data into Events table
            $sql = "INSERT INTO EVENTS (event_name,event_location,event_datetime,group_ID) VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../dashboard.php?error=sqlerror2");
                exit();
            }
            else{
                //Executes insert statement
                $playerID = $_SESSION['player_ID'];
                mysqli_stmt_bind_param($stmt, "ssss", $eventName, $eventLocation, $eventDateTime, $tempGroupID);
                mysqli_stmt_execute($stmt);
                //returns user to the manage team page
                header("Location: ../manageTeam.php?groupname=$tempGroupName");
                exit();
            }
            
        }

    }

    //closes statements and removes session ID's
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    unset($_SESSION['tempGroupName']);
    unset($_SESSION['tempGroupID']);
}
else{
    header("Location: ../dashboard.php");
    exit();
}

