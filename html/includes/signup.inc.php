<?php
ini_set('error_reporting', E_ALL);
if(isset($_POST['signup-submit'])){
    require "dbh.inc.php";

    //get input from form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password-repeat'];


    //regulate entered data
    if(empty($username) || empty($email) || empty($fname) || empty($lname) || empty($age) || empty($password) || empty($passwordRepeat)) {

        header("Location: ../createAccount.php?error=emptyFields&");
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../createAccount.php?error=invaildUsername&");
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../createAccount.php?error=invaildpassword&");
        exit();
    }
    else if($password !== $passwordRepeat) {
        header("Location: ../createAccount.php?error=passwordsdontmatch&");
        exit();
    }
    else if(strlen($username) < 6) {
        header("Location: ../createAccount.php?error=usernametooshort&");
        exit();
    }
    else if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $password)) {
        header("Location: ../createAccount.php?error=passwordrequirements&");
        exit();
    }
    else if(strlen($password) < 8) {
        header("Location: ../createAccount.php?error=passwordtooshort&");
        exit();
    }
    else{
        //prepare statement | Checking if player exists
        $sql = "SELECT player_username FROM PLAYERS WHERE player_username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../createAccount.php?error=sqlerror1");
            exit();
        }
        else{
            //execute statement
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            //If the player exists
            if($resultCheck > 0){
                header("Location: ../createAccount.php?error=usernametaken");
                exit();
            }
            else{
                //prepared statement | Adding player
                $sql = "INSERT INTO PLAYERS (player_username,player_pass,player_fname,player_lname,player_email,player_age,player_created) VALUES (?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../createAccount.php?error=sqlerror2");
                    exit();
                }
                else{
                    //Hash the password
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

                    //Execute insert statement
                    mysqli_stmt_bind_param($stmt, "sssssss", $username, $hashedPass, $fname, $lname, $email, $age, date("Y/m/d"));
                    mysqli_stmt_execute($stmt);

                    //Take user to the login page
                    header("Location: ../login.php?signup=success");
                    exit();
                }
            }
        }

    }
    //close connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../createAccount.php");
    exit();
}
