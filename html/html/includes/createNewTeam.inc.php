<?php
session_start();
ini_set('error_reporting', E_ALL);
if(isset($_POST['team-submit'])){
    require "../../includes/dbh.inc.php";

    //Gets form information
    $groupName = $_POST['group-name'];
    $other = $_POST['other-input'];
    $selected = $_POST['ddselect'];

    //if the other option is selected than fetch that information as well
    if($selected == "Other"){
        if($other != NULL){
            $selected = $other;
        }
        else{
            header("Location: ../createTeam.php?error=invaildActivity");
            exit();
        }
    }
 

    //Reglautes data
    if(empty($groupName) || empty($selected)) {

        header("Location: ../createTeam.php?error=emptyFields");
        exit();
    }
    else if(!preg_match("/^([a-zA-Z' ]+)$/", $groupName)) {
        header("Location: ../createTeam.php?error=invaildGroupName");
        exit();
    }
    else if($selected == "Select a Recreational Sport/Activity") {
        header("Location: ../createTeam.php?error=invaildActivity");
        exit();
    }
    else{
        
        //Prepare statement | gets the group name
        $sql = "SELECT group_name FROM GROUPS WHERE group_name=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../createTeam.php?error=sqlerror1");
            exit();
        }
        else{
            //Execites statement
            mysqli_stmt_bind_param($stmt, "s", $groupName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            //Checks to make sure the group username is unique
            if($resultCheck > 0){
                header("Location: ../createTeam.php?error=groupnametaken");
                exit();
            }
            else{
                //prepare insert statement
                $sql = "INSERT INTO GROUPS (group_name,group_primarysport,player_ID,group_created) VALUES (?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../createTeam.php?error=sqlerror2");
                    exit();
                }
                else{
                    //Insert group into database
                    $playerID = $_SESSION['player_ID'];
                    mysqli_stmt_bind_param($stmt, "ssss", $groupName, $selected, $playerID, date("Y/m/d"));
                    mysqli_stmt_execute($stmt);
                    //returns user to dashboard
                    header("Location: ../dashboard.php?signup=success");
                    exit();
                }
            }
        }

    }
    //closes statements and removes session ID's
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    unset($_SESSION["groud_ID"]);
}
else{
    header("Location: ../createTeam.php");
    exit();
}
