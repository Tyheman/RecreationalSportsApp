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
            $_SESSION['tempGroupID'] = $row['group_ID'];
            $_SESSION['tempGroupName'] = $groupName;
        }
    }
    else {
        header("Location: dashboard.php?error=groupError");
        exit();
    }
?>

<!DOCTYPE html>
<!--CreateEvent Page | UI for users to create events for their team -->
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
                    Setup New Event
                </a>
                <form action="includes/createNewEvent.inc.php" method="POST">
                        <div class="columns is-vcentered is-multiline is-mobile mt-2">
                            <div class="column is-two-fifths">
                                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                                    Event Name
                                </a>
                            </div>
                            <div class="column is-three-fifths field">
                                <div class="control">
                                    <input name="event_name" class="input is-medium is-rounded" type="text" placeholder="Enter Name of Event" autocomplete="event" required />
                                </div>
                            </div>
                            <div class="column is-two-fifths">
                                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                                    Event Location
                                </a>
                            </div>
                            <div class="column is-three-fifths field">
                                <div class="control">
                                    <input name="event_location" class="input is-medium is-rounded" type="text" placeholder="Enter Event Location" autocomplete="event" required />
                                </div>
                            </div>
                            <div class="column is-two-fifths">
                                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                                    Event Date/Time
                                </a>
                            </div>
                            <div class="column is-three-fifths field">
                                <div class="control">
                                    <input name="event_datetime" class="input is-medium is-rounded" type="datetime-local" placeholder="Date Time" autocomplete="event" required />
                                </div>
                            </div>
                        </div>
                        <button name="event-submit" class="button is-block is-fullwidth is-primary is-medium is-rounded has-background-info" type="submit">
                            Setup
                        </button>
                </form>
            </div>
        </div> 
      </div>
      <script async type="text/javascript" src="../js/bulma.js"></script>
   </body>
</html>