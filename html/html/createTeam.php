<?php
    session_start();
    $page = 'create';
?>

<!DOCTYPE html>
<!--CreateTeam Page | UI for users to create new teams -->
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Create a Team - Play Spontaneous</title>
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
                    Create a New Group
                </a>
                <p class="mb-5"></p>
                <form action="includes/createNewTeam.inc.php" method="POST">
                    <div class="columns is-vcentered is-multiline is-mobile">
                        <div class="column is-one-fifth">
                            <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                                Group Name
                            </a>
                        </div>
                        <div class="column is-four-fifths field">
                            <div class="control">
                                <input name="group-name" class="input is-medium is-rounded" type="text" placeholder="Group Name" autocomplete="groupname" required />
                            </div>
                        </div>
                        <div class="column is-one-fifth field">
                            <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                                Primary Sport
                            </a>
                        </div>
                        <div class="ml-3 field is-one-fifths">
                            <div class="control is-one-fifths field">
                                <div class="select">
                                    <select name="ddselect" id="ddselect" onchange="ddselected();">
                                        <option>Select a Recreational Sport/Activity</option>
                                        <option value="Baseball/Softball">Baseball/Softball</option>
                                        <option value="Basketball">Basketball</option>
                                        <option value="Billiards/playing pool">Billiards/playing pool</option>
                                        <option value="Bowling">Bowling</option>
                                        <option value="Cards">Cards</option>
                                        <option value="Checkers">Checkers</option>
                                        <option value="Chess">Chess</option>
                                        <option value="Dancing">Dancing</option>
                                        <option value="Fishing">Fishing</option>
                                        <option value="Golf">Golf</option>
                                        <option value="Pickleball">Pickleball</option>
                                        <option value="Shuffleboard">Shuffleboard</option>
                                        <option value="Skiing/Snowboard">Skiing/Snowboard</option>
                                        <option value="Sky Diving">Sky Diving</option>
                                        <option value="Surfboarding">Surfboarding</option>
                                        <option value="Swimming">Swimming</option>
                                        <option value="Table Tennis">Table Tennis</option>
                                        <option value="Touch Football">Touch Football</option>
                                        <option value="Volleyball">Volleyball</option>
                                        <option value="Weightlifting">Weightlifting</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <script type="text/javascript">
                                        function ddselected()
                                        {
                                            var selected = document.getElementById("ddselect").value;
                                            if (selected == "Other") {
                                                document.getElementById("otherField").className = "column is-one-fifths field";
                                                document.getElementById("inputOther").disabled = false;
                                            }
                                            else{
                                                document.getElementById("otherField").className = "column is-one-fifths field is-hidden";
                                                document.getElementById("inputOther").disabled = true;
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div id="otherField" class="column is-one-fifths field is-hidden">
                            <div class="control">
                                <input name="other-input" id="inputOther" class="input is-medium is-rounded" type="text" placeholder="Other Sport/Activity" autocomplete="groupname" required />
                            </div>
                        </div>
                        <br />
                    </div>
                    <button name="team-submit" class="button is-block is-fullwidth is-primary is-medium is-rounded has-background-info" type="submit">
                        Create Team
                    </button>
                </form>
            </div>
        </div>  
      </div>
      <script async type="text/javascript" src="../js/bulma.js"></script>   
   </body>
</html>