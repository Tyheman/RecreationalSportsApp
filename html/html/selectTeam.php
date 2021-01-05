<?php
    session_start();
    $page = 'manage';
    include '../includes/dbh.inc.php';
?>

<!DOCTYPE html>
<!--SelectTeam Page | UI for users to select one of their teams to manage -->
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
                <section class="container cards-container">
                    <div class="columns is-centered is-multiline">
                        <div class="column is-8 is-narrow">
                        <article class="message">
                            <div class="message-header has-background-info has-text-centered">
                                <!-- Make a header using the `name` property from the current season in the loop -->
                                <p class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                                    Select a Group
                                </p>
                            </div>
                            <div class="message-body">
                            <div class="board-item">
                                <?php
                                    //fetches all of the groups the player has created
                                    $player = $_SESSION['player_ID'];
                                    $sql = "SELECT * FROM GROUPS WHERE player_ID = $player;";
                                    $result = mysqli_query($conn, $sql);
                                    $resultCheck = mysqli_num_rows($result);
                                    if($resultCheck > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo '<div class="board-item-content"><span class><a href="manageTeam.php?groupname=';
                                            echo $row['group_name'];
                                            echo '" style=" text-decoration: none;" class="is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">';
                                            echo $row['group_name'];
                                            echo '</a></span></div>';
                                        }
                                    }
                                    else {
                                        echo '0 Results';
                                    }
                                ?>
                            </div>
                            </div>
                        </article>
                        </div>
                    </div>
                </section>
            </div>
        </div> 
      </div>
      <script async type="text/javascript" src="../js/bulma.js"></script>   
   </body>
</html>