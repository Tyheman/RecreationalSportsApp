<?php
ini_set('error_reporting', E_ALL);
if(isset($_POST['login-submit'])){
    require "dbh.inc.php";

    //get input from form
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];

    //regulate entered data
    if(empty($user) || empty($pwd)){
        
        header("Location: ../../index.html?error=emptyfields&");
        exit();
    }
    else {
        //prepare statment | Check if player exists
        $sql = "SELECT * FROM PLAYERS WHERE player_username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../index.html?error=sqlerror");
            exit();
        }
        else {
            //execute statement
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            //If the player exists
            if($row = mysqli_fetch_assoc($result)){
                //verify the entered password
                $pwdCheck = password_verify($pwd, $row['player_pass']);
                if($pwdCheck == false) {
                    header("Location: ../login.php?error=incorrectpassword&");
                    exit();
                }
                else if($pwdCheck == true){
                    //start the session and set session variables
                    session_start();
                    $_SESSION['player_ID'] = $row['player_ID'];
                    $_SESSION['username'] = $row['player_username'];
                    $_SESSION['fname'] = $row['player_fname'];
                    $_SESSION['lname'] = $row['player_lname'];
                    $_SESSION['email'] = $row['player_email'];
                    $_SESSION['created'] = $row['player_created'];

                    //send user to the dashboard
                    header("Location: ../html/dashboard.php?success=userlogin");
                    exit();
                }
                else {
                    header("Location: ../login.php?error=incorrectpassword&");
                    exit();
                }
            }
            else {
                header("Location: ../login.php?error=nouserfound&");
                exit();
            }
        }
    }

}
else{
    header("Location: ../login.php");
    exit();
}