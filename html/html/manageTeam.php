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
<!--CreateTeam Page | UI for group leaders to manage their team -->
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
      <div class="container">
        <div class="columns">
            <?php
               include 'includes/verticalNav.inc.php';
            ?>
            <div class="column is-9 has-text-centered">
                <section class="hero is-info welcome is-small mb-2">
                  <div class="hero-body">
                     <div class="container">
                        <h1 class="title brand-text is-bold is-medium is-family-monospace">
                           Manage Group | <?php echo $groupName?>
                        </h1>
                     </div>
                  </div>
               </section>
               <hr class="solid" style="border-top: 3px solid #bbb;"></hr>
                <section class="info-tiles">
                    <div class="tile is-ancestor has-text-centered">
                        <div class="tile is-parent">
                            <article class="tile is-child box has-background-grey-lighter">
                                <?php
                                    echo '<a class="title" href="createEvent.php?groupname=';
                                    echo $groupName;
                                    echo '">Setup Event</a>';
                                ?>
                            </article>
                        </div>
                    </div>
                </section>
                <section class="info-tiles">
                    <div class="tile is-ancestor has-text-centered">
                        <div class="tile is-parent">
                            <article class="tile is-child box has-background-grey-lighter">
                                <?php
                                    echo '<a class="title" href="searchPlayers.php?groupname=';
                                    echo $groupName;
                                    echo '">Invite Players</a>';
                                ?>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article class="tile is-child box has-background-grey-lighter">
                                <a class="title" href="#">Remove Players</a>
                            </article>
                        </div>
                    </div>
                </section>
                <div class="columns">
                    <?php

                        //shows the events that the group leader has established
                        ini_set('error_reporting', E_ALL);
                        $sql = "SELECT * FROM EVENTS WHERE group_ID = $groupID";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0){
                            echo '<div class="column is-6">
                            <div class="card events-card">
                                <header class="card-header">
                                    <p class="card-header-title">
                                        Events
                                    </p>
                                    <p href="#" class="card-header-icon has-text-link" aria-label="more options">
                                    <span class="icon">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    </span>
                                    </p>
                                </header>
                                <div class="card-table">
                                    <div class="content">
                                        <table class="table is-fullwidth is-striped">
                                        <tbody>';
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<tr><td width="5%"><i class="fa fa-calendar-o"></i></td><td>';
                                echo $row['event_name'];
                                echo '</td><td width="10%">';
                                echo '<form method="post">';
                                echo '<button name="view_event" class="button is-rounded is-link modal-button" id="showModal" style="height:2.5vh" value="';
                                echo $row['event_ID'];
                                echo '">Info</button>';
                                echo '</form>';
                                echo '</td></tr>';
                            }
                            echo '</tbody></table></div></div><footer class="card-footer"><a href="#" class="card-footer-item">View All</a></footer></div></div>';
                        }
                        else{
                            echo '<div class="column is-6">
                            <div class="card events-card">
                                <header class="card-header">
                                    <p class="card-header-title">
                                        Events
                                    </p>
                                    <p href="#" class="card-header-icon has-text-link" aria-label="more options">
                                    <span class="icon">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    </span>
                                    </p>
                                </header>
                                <div class="card-table">
                                    <div class="content">
                                        <table class="table is-fullwidth is-striped">
                                        <tbody>';
                            echo '<tr><td width="5%"><i class="fa fa-calendar-o"></i></td><td>';
                            echo 'No Events Scheduled';
                            echo '</td></tr>';
                            echo '</tbody></table></div></div><footer class="card-footer"></footer></div></div>';
                        }

                    ?>
                    <?php
                    //shows the players that are currently in the group
                    ini_set('error_reporting', E_ALL);
                    $sql = "SELECT * FROM PLAYER_GROUPS WHERE group_ID = $groupID";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck > 0){
                        echo '<div class="column is-6">
                            <div class="card events-card">
                                <header class="card-header">
                                    <p class="card-header-title">
                                        Players
                                    </p>
                                    <p class="card-header-icon has-text-link" aria-label="more options">
                                    <span class="icon">
                                    <i class="fa fa-street-view" aria-hidden="true"></i>
                                    </span>
                                    </p>
                                </header>
                                <div class="card-table">
                                    <div class="content">
                                        <table class="table is-fullwidth is-striped">
                                        <tbody>';
                        while($row = mysqli_fetch_assoc($result)){
                            $currentPlayerID = $row['player_ID'];
                            $sqlInner = "SELECT player_username FROM PLAYERS WHERE player_ID = $currentPlayerID";
                            $resultInner = mysqli_query($conn, $sqlInner);
                            $resultCheckInner = mysqli_num_rows($resultInner);
                            if($resultCheckInner > 0){
                                while($row = mysqli_fetch_assoc($resultInner)){
                                    echo '<tr><td width="5%"><i class="fa fa-user-o"></i></td><td>';
                                    echo $row['player_username'];
                                    echo '</td></tr>';
                                }

                            }
                        }
                            echo '</tbody></table></div></div><footer class="card-footer"><a href="#" class="card-footer-item">View All</a></footer></div></div>';
                    }
                    else {
                        echo '<div class="column is-6">
                        <div class="card events-card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Players
                                </p>
                                <p class="card-header-icon has-text-link" aria-label="more options">
                                <span class="icon">
                                <i class="fa fa-street-view" aria-hidden="true"></i>
                                </span>
                                </p>
                            </header>
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                    <tbody>';
                        echo '<tr><td width="5%"><i class="fa fa-user-o"></i></td><td>';
                        echo 'No Active Players';
                        echo '</td></tr>';
                        echo '</tbody></table></div></div><footer class="card-footer"></footer></div></div>';
                    }
                    ?>
                </div>
            </div>
        </div> 
      </div>
      <?php
      //shows more event information
      if(isset($_POST['view_event']))
      {
        
        //Fetch which event was clicked
        $selectedEvent = $_POST["view_event"];

        //retrieve information for that clicked event
        $sqlModal = "SELECT * FROM EVENTS WHERE event_ID = $selectedEvent;";
        $resultModal = mysqli_query($conn, $sqlModal);
        $resultCheckModal = mysqli_num_rows($resultModal);
        if($resultCheckModal > 0){
            while($row = mysqli_fetch_assoc($resultModal)){
                $eventName = $row['event_name'];
                $eventLocation = $row['event_location'];
                $eventDateTime = $row['event_datetime'];
            }
        }
        
        //Present clickec event information
        echo '<div class="column">
        <div class="card events-card">
            <header class="card-header">
                <p class="card-header-title">';
        echo $groupName;
        echo '</p><p class="card-header-title level-right has-text-right">';
        
        echo $eventName;
        echo ' | ';
        echo $eventLocation;
        echo ' | ';
        echo $eventDateTime;
        echo '</p>
            </header>
            <div class="card-table">
                <div class="content">
                    <table class="table is-fullwidth is-striped">
                    <tbody>';
        $sqlModalInfo = "SELECT ACCEPTED_EVENTS.event_ID, ACCEPTED_EVENTS.group_ID, ACCEPTED_EVENTS.player_ID, ACCEPTED_EVENTS.accepted, PLAYERS.player_username FROM ACCEPTED_EVENTS INNER JOIN PLAYERS WHERE ACCEPTED_EVENTS.event_ID = $selectedEvent AND ACCEPTED_EVENTS.group_ID = $groupID AND ACCEPTED_EVENTS.player_ID = PLAYERS.player_ID GROUP BY ACCEPTED_EVENTS.player_ID;";
        $resultModalInfo = mysqli_query($conn, $sqlModalInfo);
        $resultCheckInfo = mysqli_num_rows($resultModalInfo);
        if($resultCheckInfo > 0){
            while($row = mysqli_fetch_assoc($resultModalInfo)){
                echo '<tr><td width="5%"><i class="fa fa-bell-o"></i></td><td>';
                echo $row['player_username'];
                echo '</td><td class="level-right"><p>';
                if($row['accepted'] == "NO"){
                    echo 'Declined Event';
                }
                else{
                    echo 'Accepted Event';
                }
                echo '</p></td></tr>';
            }
            echo '</tbody></table></div></div></div></div>';
        }
        else {
            echo '0 Results';
        }

      }

      ?>
      <script async type="text/javascript" src="../js/bulma.js"></script>   
   </body>
</html>