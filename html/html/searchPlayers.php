<?php
    session_start();
    $page = 'manage';
    include '../includes/dbh.inc.php';

    //gets the group id from the group name in the URL
    $groupName = $_GET['groupname'];
    $sql = "SELECT group_ID FROM GROUPS WHERE group_name = '$groupName'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $groupID = $row['group_ID'];
        }
    }
    else {
        header("Location: dashboard.php?error=groupError");
        exit();
    }
?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Manage Teams - Play Spontaneous</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
      <!-- Bulma Version 0.9.0-->
      <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
      <link rel="stylesheet" type="text/css" href="../css/admin.css">
   </head>
   <body>
      <?php
         include 'includes/header.inc.php';
      ?>
      <!-- END NAV -->
      <div class="container">
        <div class="columns">
            <?php
               include 'includes/verticalNav.inc.php';
            ?>
            <div class="column is-9 has-text-centered">
                <a class="title is-bold is-medium is-size-2 is-size-4-touch is-family-monospace">
                    Search for Players
                </a>
                <form method="POST">
                        <div class="columns is-vcentered is-multiline is-mobile mt-2">
                            <div class="column is-two-fifths">
                                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                                    Enter Username
                                </a>
                            </div>
                            <div class="column is-three-fifths field">
                                <div class="control">
                                    <input name="search" class="input is-medium is-rounded" type="text" placeholder="Player Username" autocomplete="Username" required />
                                </div>
                            </div>
                        </div>
                        <button name="search-submit" class="button is-block is-fullwidth is-primary is-medium is-rounded has-background-info" type="submit">
                            Search
                        </button>
                </form>
                <?php
                //search for players
                ini_set('error_reporting', E_ALL);
                if(isset($_POST['search-submit'])){
                    include '../includes/dbh.inc.php';

                    //gets the input from the search from
                    $searched = mysqli_real_escape_string($conn, $_POST['search']);

                    //searches and displays users who meet search criteria
                    //Players who have active invites or are on the team are excluded
                    $playerUsername = $_SESSION['username'];
                    $sql = "SELECT PLAYERS.player_username FROM PLAYERS LEFT JOIN PLAYER_GROUPS ON PLAYERS.player_ID = PLAYER_GROUPS.player_ID LEFT JOIN GROUP_INVITES ON PLAYERS.player_ID = GROUP_INVITES.player_ID WHERE ((GROUP_INVITES.group_ID IS NULL OR GROUP_INVITES.group_ID != $groupID) AND (PLAYER_GROUPS.group_ID IS NULL OR PLAYER_GROUPS.group_ID != $groupID)) AND PLAYERS.player_username LIKE '%$searched%' AND PLAYERS.player_username !='$playerUsername' GROUP BY PLAYERS.player_username";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck > 0){
                        echo '<div class="column">
                        <div class="card events-card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Player
                                </p>
                                <p class="card-header-title level-right has-text-right">
                                    Action
                                </p>
                            </header>
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                    <tbody>';
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<tr><td class="has-text-left">';
                            echo $row['player_username'];
                            echo '</td><td class="level-right">';
                            echo '<form method="post">';
                            echo '<button name="add_player" value="';
                            echo $row['player_username'];
                            echo '" tpye="submit">Add Player</button>';
                            echo '</form>';
                            echo '</td></tr>';
                        }
                            echo '</tbody></table></div></div></div></div>';
                    }
                    else {
                        echo '0 Results';
                    }
                }
                ?>
            </div>
        </div> 
      </div>
      <?php

        //Sends players an invite if requested
        if(isset($_POST["add_player"]))
        {
            //Selected Players Username
            $selectedPlayer = $_POST["add_player"];

            //Retrieve Player ID from Player Username
            $sql = "SELECT player_ID FROM PLAYERS WHERE player_username = '$selectedPlayer'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $newPlayerID = $row['player_ID'];
                }
            }
            else {
                header("Location: dashboard.php?error=groupError");
                exit();
            }


            //Insert players information into temporary invitation table
            $sql = "INSERT INTO GROUP_INVITES (player_ID, group_ID) VALUES ($newPlayerID, $groupID)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: dashboard.php?error=sqlerror");
                exit();
            }
            else{
                //Executes statement and returns group leader to the management screen
                mysqli_stmt_execute($stmt);
                header("Location: manageTeam.php?groupname=$groupName");
                exit();
            }
            

        }

      ?>
      <script async type="text/javascript" src="../js/bulma.js"></script>   
   </body>
</html>