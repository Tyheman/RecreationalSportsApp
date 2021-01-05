<?php
    session_start();
    $page = 'invitation';
    include '../includes/dbh.inc.php';  
?>

<!DOCTYPE html>
<!--Invitations Page | UI for users to accept group invitations -->
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Player Dashboard - Play Spontaneous</title>
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
      <div class="container">
         <div class="columns">
            <?php
               include 'includes/verticalNav.inc.php';
            ?>
            <div class="column is-9 has-text-centered">
                <a class="title is-bold is-medium is-size-2 is-size-4-touch is-family-monospace">
                    View Group Invitations
                </a>
                <br/>
                <?php
                    //retrieves the group invites that have been sent to the logged in player
                    $playerID = $_SESSION['player_ID'];
                    $sql = "SELECT * FROM GROUP_INVITES WHERE player_ID = $playerID";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck > 0){
                        echo '<div class="column">
                        <div class="card events-card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Group
                                </p>
                                <p class="card-header-title level-right has-text-right">
                                    Action
                                </p>
                            </header>
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                    <tbody>';
                        //displays all of the group invitations
                        while($row = mysqli_fetch_assoc($result)){
                            //get the group name, sport, and group leader name of each group
                            $groupID = $row['group_ID'];
                            $sqlInner = "SELECT GROUPS.group_id, GROUPS.group_name, GROUPS.group_primarysport, PLAYERS.player_username FROM GROUPS JOIN PLAYERS ON PLAYERS.player_ID = GROUPS.player_ID WHERE group_id = $groupID;";
                            $resultInner = mysqli_query($conn, $sqlInner);
                            $resultCheckInner = mysqli_num_rows($resultInner);
                            if($resultCheckInner > 0){
                                while($row = mysqli_fetch_assoc($resultInner)){
                                    echo '<tr><td class="has-text-left">';
                                    echo $row['group_name']. ' | '. $row['group_primarysport']. ' | '. $row['player_username'];
                                    echo '</td><td class="level-right">';
                                    echo '<form method="post">';
                                    echo '<button name="join_group" value="';
                                    echo $groupID;
                                    echo '" tpye="submit">Join Group</button>';
                                    echo '</form>';
                                    echo '</td></tr>';
                                }
                            }
                        }
                        echo '</tbody></table></div></div></div></div>';
                    }
                    else {
                        echo 'No Current Group Invitations';
                    }
                ?>
            </div>
         </div>
      </div>
      <?php
        if(isset($_POST["join_group"]))
        {
            //Selected Group_ID
            $selectedGroup = $_POST["join_group"];
            
            //Add players informtion into official PLAYER_GROUPS table
            $sql = "DELETE FROM GROUP_INVITES WHERE player_ID = $playerID AND group_ID = $selectedGroup";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: dashboard.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_execute($stmt);
            }


            //Add players informtion into official PLAYER_GROUPS table
            $sql = "INSERT INTO PLAYER_GROUPS (player_ID, group_ID) VALUES ($playerID, $selectedGroup)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: dashboard.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_execute($stmt);
                header("Location: dashboard.php?");
                exit();
            }
            

        }

      ?>
      <script async type="text/javascript" src="../js/bulma.js"></script>
   </body>
</html>       