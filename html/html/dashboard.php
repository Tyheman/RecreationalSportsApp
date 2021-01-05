<?php
    session_start();
    $page = 'dashboard';  
    include '../includes/dbh.inc.php'; 

?>

<!DOCTYPE html>
<!-- Dashboard Page | Shows player information regarding upcoming events and events they have to accept -->
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
            <div class="column is-9">
               <section class="hero is-info welcome is-small mb-2">
                  <div class="hero-body">
                     <div class="container">
                     <?php
                     //Error Messages
                        if(isset($_GET['error']))
                        {
                           if($_GET['error'] == "invaildEventLocationName") {
                              echo '<div class="notification is-danger"> Invalid Event Location</div>';
                           }
                           else if($_GET['error'] == "invaildEventName") {
                              echo '<div class="notification is-danger"> Invalid Event Name</div>';
                           }
                           else if($_GET['error'] == "sqlerror1") {
                              echo '<div class="notification is-danger"> Error Executing Database Query</div>';
                           }
                           else if($_GET['error'] == "sqlerror2") {
                              echo '<div class="notification is-danger"> Error Executing Database Query</div>';
                           }
                           else if($_GET['error'] == "invaildActivity") {
                              echo '<div class="notification is-danger"> Invalid Activity</div>';
                           }
                           else if($_GET['error'] == "invaildGroupName") {
                              echo '<div class="notification is-danger"> Invalid Group Name</div>';
                           }
                           else if($_GET['error'] == "groupnametaken") {
                              echo '<div class="notification is-danger"> Group Name ia already taken</div>';
                           }
                           else if($_GET['error'] == "cannotaccept") {
                              echo '<div class="notification is-danger"> Issue Accepting Event</div>';
                           }
                        }
                     ?>
                        <h1 class="title">
                           Hello, <?php echo $_SESSION['username']; ?>
                        </h1>
                        <h2 class="subtitle">
                           I hope you are having a great day!
                        </h2>
                     </div>
                  </div>
               </section>
               <?php
                     $playerID = $_SESSION['player_ID'];
                     echo '<div class="columns">';

                     //Shows the events they player has accpeted
                     $sql = "SELECT EVENTS.event_ID, EVENTS.event_name, EVENTS.event_location, EVENTS.event_datetime, ACCEPTED_EVENTS.group_ID, ACCEPTED_EVENTS.player_ID, ACCEPTED_EVENTS.accepted FROM EVENTS INNER JOIN ACCEPTED_EVENTS ON EVENTS.event_ID = ACCEPTED_EVENTS.event_ID AND ACCEPTED_EVENTS.player_ID = $playerID AND ACCEPTED_EVENTS.accepted = 'YES' ORDER BY EVENTS.event_datetime ASC;";
                     $result = mysqli_query($conn, $sql);
                     $resultCheck = mysqli_num_rows($result);
                     if($resultCheck > 0){
                        echo '<div class="column is-6">
                           <div class="card events-card">
                              <header class="card-header">
                                 <p class="card-header-title">
                                    Upcoming Events
                                 </p>
                                 <a href="#" class="card-header-icon" aria-label="more options">
                                 <span class="icon">
                                 <i class="fa fa-angle-down" aria-hidden="true"></i>
                                 </span>
                                 </a>
                              </header>
                              <div class="card-table">
                                 <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                       <tbody>';
                           while($row = mysqli_fetch_assoc($result)){
                              echo '<tr><td width="5%"><i class="fa fa-bell-o"></i></td><td>';
                              echo $row['event_name']. ' | '. $row['event_location']. ' | '. $row['event_datetime'];
                              echo '</td>';
                              echo '<td td width="10%">';
                              echo '</td></tr>';
                           }
                           echo '</tbody></table></div></div><footer class="card-footer"><a href="#" class="card-footer-item">View All</a></footer></div></div>';
                     }
                     else {
                        echo '<div class="column is-6">
                        <div class="card events-card">
                           <header class="card-header">
                              <p class="card-header-title">
                              Upcoming Events
                              </p>
                              <a href="#" class="card-header-icon" aria-label="more options">
                              <span class="icon">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                              </span>
                              </a>
                           </header>
                           <div class="card-table">
                              <div class="content">
                                 <table class="table is-fullwidth is-striped">
                                    <tbody>
                                       <tr>
                                          <td width="5%"><i class="fa fa-bell-o"></i></td>
                                          <td>No Upcoming Events</td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>';
                     }

                     //Shows the events they player could accept
                     $sql = "SELECT EVENTS.event_ID, EVENTS.event_name, EVENTS.event_location, EVENTS.event_datetime, ACCEPTED_EVENTS.group_ID, ACCEPTED_EVENTS.player_ID, ACCEPTED_EVENTS.accepted FROM EVENTS INNER JOIN ACCEPTED_EVENTS ON EVENTS.event_ID = ACCEPTED_EVENTS.event_ID AND ACCEPTED_EVENTS.player_ID = $playerID AND ACCEPTED_EVENTS.accepted = 'NO' ORDER BY EVENTS.event_datetime ASC;";
                     $result = mysqli_query($conn, $sql);
                     $resultCheck = mysqli_num_rows($result);
                     if($resultCheck > 0){
                        echo '<div class="column is-6">
                           <div class="card events-card">
                              <header class="card-header">
                                 <p class="card-header-title">
                                    Event Invitations
                                 </p>
                                 <a href="#" class="card-header-icon" aria-label="more options">
                                 <span class="icon">
                                 <i class="fa fa-angle-down" aria-hidden="true"></i>
                                 </span>
                                 </a>
                              </header>
                              <div class="card-table">
                                 <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                       <tbody>';
                           while($row = mysqli_fetch_assoc($result)){
                              echo '<tr><td width="5%"><i class="fa fa-bell-o"></i></td><td>';
                              echo $row['event_name']. ' | '. $row['event_location']. ' | '. $row['event_datetime'];
                              echo '</td>';
                              echo '<td td width="10%"><form method="post">';
                              echo '<button name="accept_event" class="button is-small is-primary" id="showModal" style="height:2.5vh" value="';
                              echo $row['event_ID'];
                              echo '|';
                              echo $row['group_ID'];
                              echo '">Accept</button>';
                              echo '</form>';
                              echo '</td></tr>';
                           }
                           echo '</tbody></table></div></div><footer class="card-footer"><a href="#" class="card-footer-item">View All</a></footer></div></div>';
                     }
                     else {
                     echo '<div class="column is-6">
                        <div class="card events-card">
                           <header class="card-header">
                              <p class="card-header-title">
                                 Event Invitations
                              </p>
                              <a href="#" class="card-header-icon" aria-label="more options">
                              <span class="icon">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                              </span>
                              </a>
                           </header>
                           <div class="card-table">
                              <div class="content">
                                 <table class="table is-fullwidth is-striped">
                                    <tbody>
                                       <tr>
                                          <td width="5%"><i class="fa fa-bell-o"></i></td>
                                          <td>No Event Invitations</td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>';
                     }
                     echo '</div>';
                     
                  
               ?>
               
            </div>
         </div>
      </div>
      <?php
         //if the player accepted an event, the page is updated
         if(isset($_POST['accept_event']))
         {
            $str = $_POST["accept_event"];
            $breakdown = explode("|",$str);
            $currEventID = $breakdown[0];
            $currGroupID = $breakdown[1];

            $sql = "UPDATE ACCEPTED_EVENTS SET accepted = 'YES' WHERE event_ID = $currEventID AND group_ID = $currGroupID AND player_ID = $playerID";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                  header("Location: dashboard.php?error=cannotaccept");
                  exit();
            }
            else{
                  mysqli_stmt_execute($stmt);
                  header("Location: dashboard.php?$currEventID=accepted");
                  exit();
            }
         }
      ?>
      <script async type="text/javascript" src="../js/bulma.js"></script>
   </body>
</html>